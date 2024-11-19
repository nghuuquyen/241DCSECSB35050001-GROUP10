@extends('layouts.app')

@section('title', 'Homepage')

@section('content')

<style>
    .slideshow-container {
        display: flex;
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    .mySlides {
        flex: 0 0 auto;
    }
    .fade {
        transition: opacity 3s ease-in-out;
    }
</style>

<section class="grid justify-center">
    <!-- Video Section -->
    <div class="max-w-[1300px] tablet:mx-auto phone:mx-[10px]">
        <video
            class="w-full h-auto focus:outline-none"
            muted
            autoplay
            loop 
        >
            <source
                type="video/mp4"
                src="/vid/Video_Tiffani.mp4"
            >
        </video>
    </div>
    
    <!-- Slideshow Section -->
    @php
        $slideshowImages = [
            'https://asset.swarovski.com/c_crop,g_xy_center,w_11455,h_3877,x_5728,y_3892/f_auto,q_auto,dpr_2.0/swa-cms/LOOKBOOKSS24_LOOK06-1_OF_GL_72DPI_RGB_SALE.jpg',
            'https://asset.swarovski.com/images/c_crop,g_xy_center,w_11348,h_3842,x_5669,y_4529/dpr_2.0,f_auto,q_auto,c_lfill,w_1449,h_830/swa-cms/LOOKBOOKSS24_LOOK06-2_OF_GL_72DPI_RGB_EXT2/.jpg',
            'https://asset.swarovski.com/images/c_crop,g_xy_center,w_6649,h_2251,x_3325,y_1126/dpr_2.0,f_auto,q_auto,c_lfill,w_1449,h_830/swa-cms/2024_MOL-MILAN_ARCHSHOT_VISUAL_FUTURE-HISTORY-2_GL_72DPI_RGB/.jpg',
            'https://media.tiffany.com/is/image/tiffanydm/2024-TITAN-HP-Stories-1?$tile$&wid=736&hei=920&fmt=webp',
            'https://cms-live-rc.pandora.net/resource/responsive-image/2994966/m66-feature-module/lg/5/q124-editorial-aprilmay-mostloved-model-summercelebration-twoimageoverlap.jpg',
        ];
    @endphp

    <div class="slideshow-container relative tablet:mt-3 phone:mt-2 tablet:mx-auto max-w-[1300px] tablet:gap-7 phone:gap-2 phone:mx-[10px] sha">
        @foreach ($slideshowImages as $url)
            <div class="mySlides fade hidden">
                <div class="tablet:w-[480px] tablet:h-[250px] phone:w-[170px] phone:h-[110px] bg-cover bg-center" style="background-image: url('{{ $url }}');"></div>
            </div>
        @endforeach
        <a class="prev cursor-pointer absolute top-1/2 transform -translate-y-1/2 left-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out rounded-r-md hover:bg-black hover:text-white select-none" id="prev">&#10094;</a>
        <a class="next cursor-pointer absolute top-1/2 transform -translate-y-1/2 right-0 p-4 text-black font-bold text-xl transition duration-600 ease-in-out hover:bg-black hover:text-white rounded-l-md select-none" id="next">&#10095;</a>
    </div>
    
    <!-- Shop Section -->
    <main>
        <section class="grid justify-center">
            <section
                class="flex justify-between mt-14 font-medium my-10 mx-auto max-w-[1200px] phone:w-[calc(400px-20px)] tablet:w-[calc(1000px-100px)] laptop:w-[calc(1200px-50px)]"
            >
                <h2 class="font-roboto flex-auto tablet:text-4xl phone:text-2xl leading-10 text-black">
                    Shop The Latest
                </h2>
                <a
                    href="/shop"
                    class="font-roboto my-auto tablet:text-xl leading-7 capitalize text-stone-500 phone:text-sm"
                >
                    View All
                </a>
            </section>
        </section>

        <!-- Product Grid -->
        @php
            $products = [
                [
                    'id' => 1,
                    'name' => 'Product 1',
                    'images' => ['/images/product1.jpg'],
                    'price' => 100,
                    'sales' => 20,
                ],
                [
                    'id' => 2,
                    'name' => 'Product 2',
                    'images' => ['/images/product2.jpg'],
                    'price' => 120,
                    'sales' => 15,
                ],
                [
                    'id' => 3,
                    'name' => 'Product 3',
                    'images' => ['/images/product3.jpg'],
                    'price' => 150,
                    'sales' => 30,
                ],
                [
                    'id' => 4,
                    'name' => 'Product 4',
                    'images' => ['/images/product4.jpg'],
                    'price' => 80,
                    'sales' => 10,
                ],
            ];
        @endphp

        <section class="grid justify-center">
            <section
                class="grid phone:grid-cols-2 tablet:grid-cols-3 laptop:grid-cols-4 mx-auto max-w-[1200px] gap-4 px-4"
            >
                @foreach ($products as $item)
                <div class="mb-32 phone:h-[180px] phone:w-[180px] tablet:w-[260px] tablet:h-[260px] shadow-md">
                    <a href="/product?id={{ $item['id'] }}">
                        <div class="bg-gray-100 rounded-lg phone:h-[180px] phone:w-[180px] tablet:w-[260px] tablet:h-[260px]">
                            <img src="{{ $item['images'][0] }}" alt="{{ $item['name'] }}" class="rounded w-full h-full object-cover">
                        </div>
                        <h3 class="text-bold font-roboto phone:text-[13px] tablet:text-[16px] text-center mt-3">{{ $item['name'] }}</h3>
                        <h4 class="text-center font-roboto phone:text-[11px] tablet:text-[15px] desktop:text-[15px]">
                            <font color="#a28b68">${{ $item['price'] - $item['sales'] }}</font>
                        </h4>
                    </a>
                </div>
                @endforeach
            </section>
        </section>
    </main>

    <!-- Banner Section -->
    <section class="tablet:grid tablet:justify-center">
        <div class="phone:mx-auto tablet:mx-[200px] max-w-[1200px] phone:w-full phone:h-[200px] tablet:w-[800px] tablet:h-[350px] laptop:w-[1000px] laptop:h-[500px]" style="background-image: url('https://images.unsplash.com/photo-1531303435785-3853ba035cda?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center;">
        </div>
    </section>
</section>

<script type="module" src="/src/resources/scripts/menu.js"></script>
<script type="module" src="/src/resources/scripts/slide.js"></script>

@endsection
