{{-- //var from livewire variable passed to blade file with entanglement --}}
<div x-cloak x-show="showModal" x-data="{ showPassword: @entangle('show_password'), isCreate: @entangle('isCreate') }">

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
                                Edit User
                            @else
                                Create User
                            @endif

                        </h3>
                    </div>

                    {{-- //* close button --}}
                    <button type="button" x-on:click="showModal=false" wire:click=' resetFormWhenClosed() '
                        class="absolute right-[26px] inline-flex items-center justify-center w-8 h-8 text-sm text-[rgb(53,53,53)] bg-transparent rounded-lg hover:bg-[rgb(52,52,52)] transition duration-100 ease-in-out hover:text-gray-100 ms-auto "
                        data-modal-hide="UserModal">

                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                <h1 class="font-bold">Personal Information</h1>
                            </div>

                            <div class="p-4">

                                {{-- //* first row --}}
                                <div class="grid justify-between grid-flow-col grid-cols-2 gap-4">

                                    {{-- //* firstname --}}
                                    <div class="mb-3">

                                        <label for="firstname"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">First Name
                                        </label>

                                        <input type="text" id="firstname" wire:model="firstname"
                                            class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5"
                                            placeholder="First Name" tabindex="2" required />

                                        @error('firstname')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- //* middlename --}}
                                    <div class="mb-3">

                                        <label for="middlename"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Middle
                                            Name <span class="text-red-400 ">*</span></label>

                                        <input type="text" id="middlename" wire:model="middlename"
                                            class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5"
                                            placeholder="Middle Name" />

                                        @error('middlename')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                {{-- //* second row --}}
                                <div class="grid justify-between grid-flow-col grid-cols-2 gap-4">

                                    {{-- //* lastname --}}
                                    <div class="mb-3">

                                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 ">Last
                                            Name
                                        </label>

                                        <input type="text" id="lastname" wire:model="lastname"
                                            class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5"
                                            placeholder="Last Name" required />

                                        @error('lastname')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    {{-- //* contact numebr --}}
                                    <div class="mb-3">

                                        <label for="contactno"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Contact
                                            No</label>

                                        <input type="number" id="contactno" wire:model="contact_number"
                                            class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5"
                                            placeholder="Contact No" required />

                                        @error('contact_number')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                </div>

                                {{-- //* third row --}}
                                <div class="grid justify-between grid-flow-col grid-cols-2 gap-4">

                                    {{-- //* role --}}
                                    <div class="mb-3">

                                        <label for="role"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Role</label>

                                        <select id="user_roles" wire:model="role"
                                            class=" bg-[rgb(245,245,245)] border border-[rgb(53,53,53)] text-gray-900 text-sm rounded-lg block w-full p-2.5 ">
                                            <option value="" selected>Select a role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Cashier</option>
                                            <option value="3">Inventory Staff</option>
                                        </select>

                                        @error('role')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    {{-- //* status --}}
                                    <div class="mb-3">

                                        <label for="status"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Status</label>

                                        <select id="status" wire:model="status"
                                            class=" bg-[rgb(245,245,245)] border border-[rgb(53,53,53)] text-gray-900 text-sm rounded-lg block w-full p-2.5 ">
                                            <option value="" selected>Set your status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>

                                        @error('status')
                                            <span class="font-medium text-red-500 error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                </div>

                                {{-- user image --}}
                                {{-- <div class="grid justify-between grid-flow-col grid-cols-2 gap-4"
                                    x-data="{ imagePreview: '', showPreview: false }">

                                    <div class="mb-3">
                                        <label for="profile"
                                            class="block mb-2 text-sm font-medium text-gray-900">Profile</label>

                                        <div class="flex items-center justify-center">
                                            <div x-show="!showPreview"
                                                class=" translate-y-[-28] shadow-xl rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor"
                                                    class="border border-black rounded-full size-36">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                                                        fill="white" />
                                                </svg>

                                            </div>
                                            <div x-show="showPreview"
                                                class=" translate-y-[-28] shadow-xl rounded-full">
                                                <img :src="imagePreview" alt="Preview"
                                                    class="border border-black rounded-full size-36">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 flex flex-wrap items-center justify-center">
                                        <div class="flex flex-col  gap-2">
                                            <input type="file" id="user_image" wire:model="user_image" required accept="image/jpg, image/png"
                                                class="mb-4 bg-[rgb(236,236,236)] border border-[rgb(53,53,53)]"
                                                x-on:change="showPreview = true; imagePreview = URL.createObjectURL($event.target.files[0])"
                                                x-ref="fileInput">
                                            <a x-show="showPreview"
                                                @click="showPreview = false; imagePreview = ''; $refs.fileInput.value = ''"
                                                class="px-4 py-2 mb-4 text-white transition-all duration-100 ease-in-out bg-red-500 hover:bg-red-600 hover:rounded-md">Clear</a>
                                        </div>
                                    </div>

                                </div> --}}


                            </div>
                        </div>
                    </div>

                    {{-- //* second area, login information --}}
                    <div class="border-2 border-[rgb(53,53,53)] rounded-md">

                        <div
                            class="p-2 border-b  bg-[rgb(53,53,53)] text-[rgb(242,242,242)] pointer-events-none rounded-br-sm rounded-bl-sm">
                            <h1 class="font-bold">Login Information</h1>
                        </div>

                        <div class="p-4">

                            {{-- //* username --}}
                            <div class="mb-3">

                                <label for="username"
                                    class="block mb-2 text-sm font-medium text-gray-900">Username</label>

                                <input type="text" id="username" wire:model="username"
                                    class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5"
                                    placeholder="Username" required />

                                @error('username')
                                    <span class="font-medium text-red-500 error">{{ $message }}</span>
                                @enderror

                            </div>

                            {{-- //* script that show password and retype pass if create form --}}
                            <div x-show="showPassword" x-cloak class="transition-all duration-100 ease-in-out">

                                {{-- //* password --}}
                                <div class="mb-3">

                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>

                                    <input type="password" wire:model="password" id="password"
                                        placeholder="Password"
                                        class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5" />

                                    @error('password')
                                        <span class="font-medium text-red-500 error">{{ $message }}</span>
                                    @enderror

                                </div>

                                {{-- //* retype password --}}
                                <div class="mb-3">

                                    <label for="retypepassword"
                                        class="block mb-2 text-sm font-medium text-gray-900">Re-type
                                        Password</label>

                                    <input type="password" id="retype_password" wire:model="retype_password"
                                        placeholder="Retype Password"
                                        class=" bg-[rgb(245,245,245)] text-gray-900 text-sm rounded-lg  block w-full p-2.5" />

                                    @error('retype_password')
                                        <span class="font-medium text-red-500 error">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>

                            {{-- //* check box for edit --}}
                            @if (!$this->isCreate)
                                <input type="checkbox" name="showpassword" id="showpassword"
                                    wire:model="show_password" placeholder="">

                                <label for="showpassword">Update Password</label>
                            @endif

                        </div>
                    </div>

                    {{-- //* form footer --}}

                    {{-- *if form is edit --}}
                    @if (!$this->isCreate)
                        <div class="flex flex-row justify-end gap-2">

                            <div>

                                {{-- //* submit button for edit --}}
                                <button type="submit" wire:loading.remove
                                    class="text-white bg-[rgb(55,55,55)] focus:ring-4 hover:bg-[rgb(28,28,28)] focus:outline-none  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                                    <div class="flex flex-row items-center gap-2">
                                        <p>Update</p>

                                    </div>

                                </button>
                                <div wire:loading>
                                    <div class="loader loader--style3 flex justify-center items-center "
                                        title="2">
                                        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px"
                                            height="40px" viewBox="0 0 50 50"
                                            style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                            <path fill="#000"
                                                d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                                                <animateTransform attributeType="xml" attributeName="transform"
                                                    type="rotate" from="0 25 25" to="360 25 25" dur="0.6s"
                                                    repeatCount="indefinite" />
                                            </path>
                                        </svg>
                                    </div>

                                </div>
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
                                <button type="submit" wire:loading.remove
                                    class="text-white bg-[rgb(55,55,55)] focus:ring-4 hover:bg-[rgb(28,28,28)] focus:outline-none  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">
                                    <div class="flex flex-row items-center gap-2">
                                        <p>
                                            Create
                                        </p>

                                    </div>

                                </button>

                                <div wire:loading>
                                    <div class="loader loader--style3 flex justify-center items-center "
                                        title="2">
                                        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px"
                                            height="40px" viewBox="0 0 50 50"
                                            style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                            <path fill="#000"
                                                d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                                                <animateTransform attributeType="xml" attributeName="transform"
                                                    type="rotate" from="0 25 25" to="360 25 25" dur="0.6s"
                                                    repeatCount="indefinite" />
                                            </path>
                                        </svg>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endif
                </div>

        </div>

        </form>
    </div>


</div>

<script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>

<x-livewire-alert::flash />
