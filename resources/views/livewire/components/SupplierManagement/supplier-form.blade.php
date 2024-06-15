{{-- //var from livewire variable passed to blade file with entanglement --}}
<div x-cloak x-show="showModal" x-data="{ isCreate: @entangle('isCreate'), cities: @entangle('cities'), barangays: @entangle('barangays') }">

    {{-- //* form background --}}
    <div class="fixed inset-0 z-40 bg-gray-900/50 dark:bg-gray-900/80"></div>

    {{-- //* form position --}}
    <div
        class="fixed top-0 left-0 right-0 z-50 items-center justify-center w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">

        <div class="relative w-full max-w-2xl max-h-full mx-auto">

            {{-- //* Modal content --}}
            @if (!$this->isCreate)
            {{-- *if form is edit --}}
            <form class="relative bg-[rgb(238,238,238)] rounded-lg shadow " wire:submit.prevent="update">
                @endif

                {{-- *if form is create --}}
                <form class="relative bg-[rgb(238,238,238)] rounded-lg shadow " wire:submit.prevent="create">
                    @csrf

                    <div class="flex items-center justify-between px-6 py-2 border-b rounded-t ">

                        <div class="flex justify-center w-full p-2">

                            {{-- //* form title --}}
                            <h3 class="text-xl font-black text-gray-900 item ">

                                @if (!$this->isCreate)
                                {{-- *if form is edit --}}
                                Edit Supplier
                                @else
                                Create Supplier
                                @endif

                            </h3>
                        </div>

                        {{-- //* close button --}}
                        <button type="button" x-on:click="showModal=false" wire:click=' resetFormWhenClosed() '
                            class="absolute right-[26px] inline-flex items-center justify-center w-8 h-8 text-sm text-[rgb(53,53,53)] bg-transparent rounded-lg hover:bg-[rgb(52,52,52)] transition duration-100 ease-in-out hover:text-gray-100 ms-auto "
                            data-modal-hide="UserModal">

                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>

                            <span class="sr-only">Close modal</span>

                        </button>

                    </div>


                    <div class="p-6 space-y-6">

                        <div class="flex flex-col gap-4">

                            {{-- //* first area, personal information --}}
                            <div class="border-2 border-[rgb(53,53,53)] rounded-md">

                                <div
                                    class="p-2 border-b bg-[rgb(53,53,53)] text-[rgb(242,242,242)] pointer-events-none rounded-br-sm rounded-bl-sm">
                                    <h1 class="font-bold">Supplier Information</h1>
                                </div>

                                <div class="p-4">

                                    {{-- //* first row --}}
                                    <div class="grid justify-between grid-flow-col grid-cols-2 gap-4">

                                        {{-- //* company name --}}
                                        <div class="mb-3">

                                            <label for="companyname"
                                                class="block mb-2 text-sm font-medium text-gray-900 ">Company Name
                                            </label>

                                            <input type="text" id="companyname" wire:model="companyname"
                                                oninput="removeSpaces(this)"
                                                class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5"
                                                placeholder="Company Name" tabindex="2" required />

                                            @error('company_name')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- //* contact_no --}}
                                        <div class="mb-3">

                                            <label for="contactno"
                                                class="block mb-2 text-sm font-medium text-gray-900 "> Contact No <span
                                                    class="text-red-400 ">*</span></label>

                                            <input type="text" id="contactno" wire:model="contact_number"
                                                class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5"
                                                placeholder="Contact No" />

                                            @error('contact_no')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>

                                    {{-- //* second row --}}
                                    <div class="grid justify-between grid-flow-col grid-cols-2 gap-4">

                                        {{-- //* province --}}
                                        <div class="mb-3">

                                            <label for="province"
                                                class="block mb-2 text-sm font-medium text-gray-900 ">Province
                                            </label>

                                            <select id="province" wire:model="province" wire:change="selectCity()"
                                                class=" bg-[rgb(245,245,245)] border border-[rgb(53,53,53)] text-gray-900 text-sm rounded-lg block w-full p-2.5 ">
                                                <option value="" selected>Select province</option>
                                                @foreach ($provinces as $province)
                                                <option value="{{ $province->province_code }}">{{
                                                    $province->province_description }}</option>
                                                @endforeach

                                            </select>

                                            @error('province_id')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                            @enderror

                                        </div>

                                        {{-- //* city --}}
                                        <div class="mb-3">

                                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 ">City
                                                / Municipality
                                            </label>


                                            <select id="city" wire:model="city" wire:change="selectBarangay()"
                                                class=" bg-[rgb(245,245,245)] border border-[rgb(53,53,53)] text-gray-900 text-sm rounded-lg block w-full p-2.5 ">
                                                <option value="" selected>Select city / municipality</option>
                                                @if ($cities)
                                                @foreach ($cities as $city)
                                                <option value="{{ $city->city_municipality_code }}">{{
                                                    $city->city_municipality_description }}</option>
                                                @endforeach
                                                @endif


                                            </select>

                                            @error('city')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                            @enderror

                                        </div>

                                    </div>

                                    {{-- //* third row --}}
                                    <div class="grid justify-between grid-flow-col grid-cols-2 gap-4">

                                        {{-- //* brgy --}}
                                        <div class="mb-3">

                                            <label for="brgy"
                                                class="block mb-2 text-sm font-medium text-gray-900 ">Barangay</label>

                                            <select id="brgy" wire:model="brgy"
                                                class=" bg-[rgb(245,245,245)] border border-[rgb(53,53,53)] text-gray-900 text-sm rounded-lg block w-full p-2.5 ">
                                                <option value="" selected>Select a role</option>
                                                @if ($barangays)
                                                @foreach ($barangays as $barangay)
                                                <option value="{{ $barangay->barangay_code }}">{{
                                                    $barangay->barangay_description }}</option>
                                                @endforeach

                                                @endif
                                            </select>

                                            @error('bgryid')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                            @enderror

                                        </div>

                                        {{-- //* street --}}
                                        <div class="mb-3">

                                            <label for="stret"
                                                class="block mb-2 text-sm font-medium text-gray-900 ">Street</label>

                                            <input type="text" id="street" wire:model="street"
                                                oninput="removeSpaces(this)"
                                                class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5"
                                                placeholder="Street" required />



                                            @error('street')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                            @enderror

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- //* form footer --}}

                        {{-- *if form is edit --}}
                        @if (!$this->isCreate)
                        <div class="flex flex-row justify-end gap-2">

                            <div>

                                {{-- //* submit button for edit --}}
                                <button type="submit"
                                    class="text-white bg-[rgb(55,55,55)] focus:ring-4 hover:bg-[rgb(28,28,28)] focus:outline-none  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                                    <div class="flex flex-row items-center gap-2">
                                        <p>Update</p>

                                        <div wire:loading>

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 gap-2 text-white animate-spin" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M12 2a10 10 0 00-4.472 18.965 1 1 0 01.258-1.976 8 8 0 115.429 0 1 1 0 01.258 1.976A10 10 0 0012 2z">
                                                </path>
                                            </svg>

                                        </div>
                                    </div>

                                </button>

                            </div>

                        </div>
                        @else
                        {{-- *if form is create --}}
                        <div class="flex flex-row justify-end gap-2">
                            <div>

                                {{-- //* clear all button for create --}}
                                <button type="reset"
                                    class="text-[rgb(53,53,53)] hover:bg-[rgb(229,229,229)] font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center transition ease-in-out duration-100">Clear
                                    All</button>
                            </div>

                            <div>

                                {{-- //* submit button for create --}}
                                <button type="submit"
                                    class="text-white bg-[rgb(55,55,55)] focus:ring-4 hover:bg-[rgb(28,28,28)] focus:outline-none  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                                    <div class="flex flex-row items-center gap-2">
                                        <p>
                                            Create
                                        </p>

                                        <div wire:loading>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 text-white animate-spin" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M12 2a10 10 0 00-4.472 18.965 1 1 0 01.258-1.976 8 8 0 115.429 0 1 1 0 01.258 1.976A10 10 0 0012 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>


                                </button>

                            </div>

                        </div>
                        @endif

                    </div>

                </form>
        </div>

    </div>
</div>

<script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
<script>
    function removeSpaces(input) {
        input.value = input.value.replace(/\s+/g, '');
    }
</script>
<x-livewire-alert::flash />
