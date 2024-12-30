<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartsItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function showCheckoutStep($step)
    {
        if (!$this->isValidStep($step)) {
            abort(404);
        }

        if ($step == 3 && !$this->userHasOrder()) {
            return redirect()->route('checkout.step', ['step' => 2])
                ->with('error', 'You must create an order before proceeding to step 3.');
        }

        $cartData = $this->getCartData();

        return view('checkout', [
            'step' => $step,
            'cart' => $cartData['cartItems'],
            'totalPrice' => $cartData['totalPrice'],
        ]);
    }

    public function processStep(Request $request, $step)
    {
        if (!$this->isValidStep($step)) {
            abort(404);
        }

        $stepProcessors = [
            1 => 'processStepOne',
            2 => 'processStepTwo',
        ];

        try {
            $nextStep = isset($stepProcessors[$step])
                ? $this->{$stepProcessors[$step]}($request)
                : $step + 1;

            return $nextStep > 3
                ? redirect()->route('checkout.process', ['step' => 3])
                : redirect()->route('checkout.process', ['step' => $nextStep]);
        } catch (Exception $e) {
            Log::error("Error processing step {$step}: " . $e->getMessage());
            return redirect()->route('checkout.step', ['step' => $step])
                ->with('error', 'An error occurred. Please try again.');
        }
    }

    private function processStepOne(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'note' => 'nullable|string|max:255',
            'payment' => 'required|string|in:Bank Transfer,COD,Paypal',
        ]);

        session(['checkout' => $validated]);

        Log::info('Step 1 processed successfully', ['user_id' => Auth::id(), 'session_data' => session('checkout')]);

        return 2;
    }

    private function processStepTwo(Request $request)
    {
        $checkoutData = session('checkout');
        $cartData = $this->getCartData();


        if (!$checkoutData) {
            Log::error('Checkout data missing in session.');
            throw new Exception('Checkout data not found in session.');
        }

        Log::debug('Checkout data', ['checkout_data' => $checkoutData]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $checkoutData['first_name'],
            'last_name' => $checkoutData['last_name'],
            'email' => $checkoutData['email'],
            'country' => $checkoutData['country'],
            'address' => $checkoutData['address'],
            'phone' => $checkoutData['phone'],
            'note' => $checkoutData['note'],
            'payment' => $checkoutData['payment'],
            'total_price' => $cartData['totalPrice'],
        ]);

        if (!$order) {
            Log::error('Failed to create order', ['user_id' => Auth::id(), 'checkout_data' => $checkoutData]);
            throw new Exception('Failed to create order.');
        }
        Log::info('Order created successfully', ['order_id' => $order->id, 'user_id' => Auth::id()]);

        if (empty($cartData['cartItems'])) {
            Log::error('Cart is empty for user', ['user_id' => Auth::id()]);
            throw new Exception('Cart is empty. Cannot proceed with checkout.');
        }

        Log::debug('Cart data for order items', ['cart_data' => $cartData]);

        foreach ($cartData['cartItems'] as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('checkout');
        //Delete cart items
        CartsItem::where('user_id', Auth::id())->delete();
        return 3;
    }


    private function isValidStep($step)
    {
        return in_array($step, [1, 2, 3]);
    }

    private function userHasOrder()
    {
        return Order::where('user_id', Auth::id())->exists();
    }

    private function getCartData()
    {
        $cartItems = [];
        $totalPrice = 0;

        if (Auth::check()) {
            $cart = CartsItem::where('user_id', Auth::id())->with('product')->get();

            foreach ($cart as $item) {
                $price = $item->product->salePrice() ?? $item->product->price;
                $cartItems[] = [
                    'product_id' => $item->product->id,
                    'name' => $item->product->name,
                    'price' => $price,
                    'quantity' => $item->quantity,
                    'total' => $price * $item->quantity,
                ];
                $totalPrice += $price * $item->quantity;
            }
        }

        return ['cartItems' => $cartItems, 'totalPrice' => $totalPrice];
    }
}
