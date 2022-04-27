<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach(\App\Models\Prayer::categories() as $cat)
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
                            <tr class="border-b">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{$item->prayer->prayer}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{\App\Models\Item::NUSACH[$item->nusach]}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    @if( $item->purchaseAttempt() != null )
                                        {{$item->purchaseAttempt()->email}}
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
                                                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                        Mark as Available
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
