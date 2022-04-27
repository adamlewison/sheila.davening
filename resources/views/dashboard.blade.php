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
                        <table class="table-auto w-full">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Nusach</th>
                                <th>Purchaser</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                        @foreach(\App\Models\Item::category($cat)->get() as $i => $item)
                            <tr>
                                <td>{{$item->prayer->prayer}}</td>
                                <td>{{\App\Models\Item::NUSACH[$item->nusach]}}</td>
                                <td>
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
