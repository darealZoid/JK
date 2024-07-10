{{-- // --}}
<div class="relative">


    <div class="relative overflow-hidden bg-white border border-black shadow-lg sm:rounded-lg">

        {{-- //* filters --}}
        <div class="flex flex-row items-center justify-between px-2 py-4 ">

            {{-- //* search filter --}}
            <div class="relative w-full">

                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <input type="text" wire:model.live.debounce.100ms = "search"
                    class="w-1/3 p-2 pl-10 hover:bg-[rgb(225,225,225)] transition duration-100 ease-in-out border-[rgb(53,53,53)] text-[rgb(53,53,53)] rounded-lg cursor-pointer text-s bg-gray-50 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="Search by SKU or Item Name" required="" />


            </div>


            <div class="flex flex-row items-center justify-center gap-6">

                {{-- //*inventory filter --}}
                <div class="flex flex-row items-center gap-2">

                    <label class="text-sm font-medium text-gray-900 text-nowrap">Category :</label>

                    <select wire:model.live="roleFilter"
                        class="bg-gray-50 border hover:bg-[rgb(225,225,225)] transition duration-100 ease-in-out border-[rgb(53,53,53)] text-[rgb(53,53,53)] text-sm rounded-lg block p-2.5 ">
                        <option value="0">All</option>
                        {{-- @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach --}}
                    </select>

                </div>


                <div class="flex flex-row items-center">

                    <div class="flex flex-row items-center gap-2">

                        <label class="text-sm font-medium text-gray-900 text-nowrap">Status :</label>

                        <select wire:model.live="statusFilter"
                            class="bg-gray-50 border border-[rgb(53,53,53)] hover:bg-[rgb(225,225,225)] transition duration-100 ease-in-out text-[rgb(53,53,53)] text-sm rounded-lg  block p-2.5 ">
                            <option value="0">All</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>

                        </select>

                    </div>
                </div>
                <div class="flex flex-row items-center gap-2 text-nowrap">
                    <div><p>Item Count:</p></div>
                    <div><p class="text-2xl ">0</p></div>
                </div>
            </div>
        </div>


        {{-- //* tablea area --}}
        <div class="overflow-x-auto overflow-y-scroll scroll no-scrollbar h-[500px] ">

            <table class="w-full h-10 text-sm text-left scroll no-scrollbar">

                {{-- //* table header --}}
                <thead class="text-xs text-white uppercase cursor-default bg-[rgb(53,53,53)] sticky top-0   ">

                    <tr class=" text-nowrap">

                        {{-- //* name --}}
                        <th wire:click="sortByColumn('firstname')" scope="col"
                            class="flex flex-row items-center justify-between gap-2 px-4 py-3 transition-all duration-100 ease-in-out cursor-pointer hover:bg-[#464646] hover:text-white">

                            <div class="flex items-center">
                                <p>SKU</p>

                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </span>

                            </div>

                        </th>

                        {{-- //* Item Name --}}
                        <th scope="col" class="px-4 py-3">Item Name</th>

                        {{-- //* category --}}
                        <th scope="col" class="px-4 py-3">Category</th>

                        {{-- //* quantity --}}
                        <th scope="col" class="px-4 py-3">Quantity</th>

                        {{-- //* expiration date --}}
                        <th wire:click="sortByColumn('updated_at')" scope="col"
                        class=" text-nowrap gap-2 px-4 py-3 transition-all duration-100 ease-in-out cursor-pointer hover:bg-[#464646] hover:text-white">

                        <div class="flex items-center">

                            <p>Expiration Date</p>

                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </span>

                            </div>
                        </th>

                        {{-- //* status --}}
                        <th scope="col" class="px-4 py-3 text-center">Status</th>

                        {{-- //* action --}}
                        <th scope="col" class="px-4 py-3 text-nowrap">Actions</th>
                        </th>

                    </tr>
                </thead>

                {{-- //* table body --}}
                <tbody>

                </tbody>

            </table>

        </div>

        {{-- //* table footer --}}
        <div class="border-t border-black ">

            {{-- //*pagination --}}
            <div class="mx-4 my-2 text-nowrap">

                {{-- {{ $users->links() }} --}}

            </div>

            {{-- //* per page --}}
            <div class="flex items-center px-4 py-2 mb-3">

                <label class="text-sm font-medium text-gray-900 w-15">Per Page</label>

                <select wire:model.live = "perPage"
                    class="bg-[rgb(243,243,243)] border border-[rgb(53,53,53)] text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-20 p-2.5 ml-4">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>

            </div>


        </div>

    </div>

    <div class="flex flex-row items-center justify-end gap-4 pointer-events-none my-[6px]">
        <div class="flex flex-row items-center">
            <p class="font-medium">Status:</p>
        </div>
        <div class="flex flex-row items-center gap-1">
            <div class="w-4 h-4 bg-green-300 rounded-full"></div>
            <p>Normal</p>
        </div>
        <div class="flex flex-row items-center gap-1">
            <div class="w-4 h-4 bg-orange-300 rounded-full"></div>
            <p>Low Stock</p>
        </div>
        <div class="flex flex-row items-center gap-1">
            <div class="w-4 h-4 bg-red-300 rounded-full"></div>
            <p>Expired</p>
        </div>

    </div>


</div>
