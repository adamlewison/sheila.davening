<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800">
                        <div class="container flex flex-wrap justify-between items-center mx-auto">

                            <button data-collapse-toggle="mobile-menu" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
                                <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                                    <li>
                                        <a href="/dashboard/Home"  class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent {{ ($cat === "Home" || $cat === null) ? "md:text-blue-700" : "text-gray-700" }}  md:p-0 dark:text-white">
                                            Home
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/dashboard/Shacharit" {{ $cat == "Shacharit" ? "aria-current='page'" : "" }} class="block py-2 pr-4 pl-3 {{ ($cat === "Shacharit") ? "md:text-blue-700" : "text-gray-700" }} border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                                            Shacharit
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/dashboard/Hallel" {{ $cat == "Hallel" ? "aria-current='page'" : "" }} class="block py-2 pr-4 pl-3 {{ ($cat === "Hallel") ? "md:text-blue-700" : "text-gray-700" }} border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                                            Hallel
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/dashboard/Before Brochas" {{ $cat == "Before Brochas" ? "aria-current='page'" : "" }} class="block py-2 pr-4 pl-3 {{ ($cat === "Before Brochas") ? "md:text-blue-700" : "text-gray-700" }} border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                                            Before Brochas
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/dashboard/After Brochas" {{ $cat == "After Brochas" ? "aria-current='page'" : "" }} class="block py-2 pr-4 pl-3 {{ ($cat === "After Brochas") ? "md:text-blue-700" : "text-gray-700" }} hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                            After Brochas
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/dashboard/purchases" {{ $cat == "purchases" ? "aria-current='page'" : "" }} class="block py-2 pr-4 pl-3 {{ ($cat === "purchases") ? "md:text-blue-700" : "text-gray-700" }} hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                            Purchases
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                    @if ($cat != null)
                        <div class="text-5xl my-5">{{$cat}}</div>
                        <table class="min-w-full">
                            <thead class="border-b">
                            <tr>
                                <th class="text-m font-bold text-gray-900 px-6 py-4 text-left">Name</th>
                                <th class="text-m font-bold text-gray-900 px-6 py-4 text-left">Nusach</th>
                                <th class="text-m font-bold text-gray-900 px-6 py-4 text-left">Purchaser</th>
                                <th class="text-m font-bold text-gray-900 px-6 py-4 text-left">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Item::category($cat)->get() as $i => $item)
                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{$item->prayer->prayer}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{\App\Models\Item::NUSACH[$item->nusach]}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        @if( $item->purchaseAttempt() != null )

                                            {{$item->purchaseAttempt()->paymentReference()}}

                                            <br>

                                            <span style="
                                                font-family: monospace;
                                                color: rgb(155, 183, 231);
                                                font-weight: 100;
                                            ">
                                            {{$item->purchaseAttempt()->email}}
                                            </span>
                                        @else
                                            NA
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                        @if($item->available())
                                            <!--
                                            <li>
                                                <a href="#" class="button primary disabled">
                                                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        Mark as Purchased
                                                    </button>
                                                </a>
                                            </li>
                                            -->
                                            @else
                                                <li>
                                                    <a href="/items/{{$item->id}}/clear" class="button primary disabled">
                                                        <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                                            Make Available
                                                        </button>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif


                    @if ($page == "purchases")
                    <div class="text-5xl my-5">Purchases</div>
                        <table class="min-w-full">
                            <thead class="border-b">
                            <tr>
                                <th class="text-m font-bold text-gray-900 px-6 py-4 text-left">Name</th>
                                <th class="text-m font-bold text-gray-900 px-6 py-4 text-left">Nusach</th>
                                <th class="text-m font-bold text-gray-900 px-6 py-4 text-left">Purchaser</th>
                                <th class="text-m font-bold text-gray-900 px-6 py-4 text-left">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach(\App\Models\PurchaseAttempt::orderByDesc("created_at")->get() as $pa)
                                <?php $item = $pa->item; ?>
                                <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{$item->prayer->prayer}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{\App\Models\Item::NUSACH[$item->nusach]}}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        @if( $item->purchaseAttempt() != null )

                                            {{$item->purchaseAttempt()->paymentReference()}}

                                            <br>

                                            <span style="
                                                font-family: monospace;
                                                color: rgb(155, 183, 231);
                                                font-weight: 100;
                                            ">
                                            {{$item->purchaseAttempt()->email}}
                                            </span>
                                        @else
                                            NA
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                        @if($item->available())
                                            <!--
                                            <li>
                                                <a href="#" class="button primary disabled">
                                                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        Mark as Purchased
                                                    </button>
                                                </a>
                                            </li>
                                            -->
                                            @else
                                                <li>
                                                    <a href="/items/{{$item->id}}/clear" class="button primary disabled">
                                                        <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                                            Make Available
                                                        </button>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach    
                           
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
