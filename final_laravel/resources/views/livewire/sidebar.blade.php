<section
    class="grid flex-col phone:max-tablet:justify-center tablet:flex phone:max-tablet:border-gray-200 phone:max-tablet:border-b-2 phone:max-tablet:p-4 phone:max-tablet:mb-5 phone:max-tablet:w-screen">
    <!-- Search Bar -->
    <form class="max-w-[1200px] w-[220px] mb-5">
        <label for="default-search" class="text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative phone:max-tablet:start-[40%]">
            <input type="text" placeholder="Search" wire:model.live="search" id="default-search"
                class="block w-full p-4 ps-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <button type="button"
                class="absolute end-2.5 bottom-2.5 bg-white focus:ring-2 focus:outline-none rounded-lg py-2">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e049bbac9007f28b8521ba6a8adffac68548815191ee5882c549324c1ea8d37d?apiKey=e8ca62b583f64a60ba17a0d16e44846a&"
                    alt="Search icon">
            </button>
        </div>
    </form>
    <div id="searchResults" class="search-results mt-4"></div>

    <!-- Filter Section -->
    <section class="select-none phone:max-tablet:grid phone:max-tablet:justify-center">
        <div class="phone:max-tablet:flex gap-3" id="dropdownArea">
            <!-- Shop BY -->
            <button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox"
                class="text-black bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 mb-7"
                type="button">Shop By <svg class="w-2.5 h-2.5 ms-[120px]" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="dropdownDefaultCheckbox"
                class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownCheckboxButton">
                    @foreach ($categories as $category)
                        <li>
                            <div class="flex items-center">
                                <input type="checkbox" wire:key="category-{{ $category->id }}"
                                    wire:model.live='selectedCategories' value="{{ $category->id }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded">
                                <div for="category" class="ms-2 text-sm font-medium text-gray-900 ">
                                    {{ $category->name }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
            <!-- Sort By -->
            <button id="dropdownDelayButton" data-dropdown-toggle="dropdownDelay" data-dropdown-delay="500"
                data-dropdown-trigger="hover"
                class="text-black bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 mb-7"
                type="button">Sort By <svg class="w-2.5 h-2.5 ms-[125px]" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="dropdownDelay"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDelayButton">
                    <li>
                        <a href="#" wire:click.prevent="$set('sortBy', 'lowest_to_highest')"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Lowest to highest
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click.prevent="$set('sortBy', 'highest_to_lowest')"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Highest to lowest
                        </a>
                    </li>
                    <li>
                        <a href="#" wire:click.prevent="$set('sortBy', 'best_seller')"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Best seller
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- On Sale and In Stock Toggles -->
    <section class="phone:max-tablet:flex phone:max-tablet:justify-center phone:max-tablet:gap-10">
        <div
            class="flex justify-between phone:max-tablet:my-4 my-5 phone:max-tablet:w-[full] phone:max-tablet:max-w-[150px] w-[220px] z-0">
            <a>On sale</a>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" wire:model.live="onSale" class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                </div>
            </label>
        </div>

        <div
            class="flex justify-between phone:max-tablet:w-[full] phone:max-tablet:max-w-[150px] w-[220px] z-0 items-center">
            <a>In stock</a>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" wire:model.live="inStock" class="sr-only peer">
                <div
                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                </div>
            </label>
        </div>

    </section>

    <div class="flex flex-wrap gap-2 mt-4 w-[220px]">
        @foreach ($selectedCategories as $categoryId)
            @php
                $category = $categories->firstWhere('id', $categoryId);
            @endphp
            @if ($category)
                <span
                    class="inline-flex items-center px-2.5 py-1.5 text-[15px] font-medium text-gray-800 bg-gray-100 rounded-sm dark:bg-gray-600 dark:text-gray-200">
                    {{ $category->name }}
                    <button wire:click="removeCategory({{ $categoryId }})" type="button"
                        class="flex-shrink-0 ms-1.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-gray-400 hover:text-gray-500 dark:text-gray-300 dark:hover:text-gray-200">
                        <span class="sr-only">Remove small</span>
                        <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                            <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path>
                        </svg>
                    </button>
                </span>
            @endif
        @endforeach
        @if ($onSale)
            <span
                class="inline-flex items-center px-2.5 py-1.5 text-[15px] font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-600 dark:text-gray-200">
                On Sale
                <button wire:click="toggleOnSale" type="button"
                    class="flex-shrink-0 ms-1.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-gray-400 hover:text-gray-500 dark:text-gray-300 dark:hover:text-gray-200">
                    <span class="sr-only">Remove On Sale</span>
                    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                        <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path>
                    </svg>
                </button>
            </span>
        @endif

        @if ($inStock)
            <span
                class="inline-flex items-center px-2.5 py-1.5 text-[15px] font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-600 dark:text-gray-200">
                In Stock
                <button wire:click="toggleInStock" type="button"
                    class="flex-shrink-0 ms-1.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-gray-400 hover:text-gray-500 dark:text-gray-300 dark:hover:text-gray-200">
                    <span class="sr-only">Remove In Stock</span>
                    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                        <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path>
                    </svg>
                </button>
            </span>
        @endif

        @if ($sortBy)
            <span
                class="inline-flex items-center px-2.5 py-1.5 text-[15px] font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-600 dark:text-gray-200">
                {{ ucfirst(str_replace('_', ' ', $sortBy)) }}
                <button wire:click="clearSortBy" type="button"
                    class="flex-shrink-0 ms-1.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-gray-400 hover:text-gray-500 dark:text-gray-300 dark:hover:text-gray-200">
                    <span class="sr-only">Remove Sort By</span>
                    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                        <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7"></path>
                    </svg>
                </button>
            </span>
        @endif
    </div>
</section>