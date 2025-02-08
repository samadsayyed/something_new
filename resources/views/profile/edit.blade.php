<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="max-w-3xl mx-auto mt-8 bg-white p-4 sm:p-8 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Submit Your Durood and Recitation</h2>
                <form method="POST" action="{{ route('recitation.create') }}" class="grid gap-4">
                    @csrf
                    <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="durud_count" class="block text-sm font-medium text-gray-700 mb-1">
                                Read Durood Sharif(times) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="durud_count" name="durud_count"
                                placeholder="Read Durood Sharif(times)"
                                class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2"
                                required>
                        </div>
                        <div>
                            <label for="para_count" class="block text-sm font-medium text-gray-700 mb-1">
                                Para(s) of Quran Majeed
                            </label>
                            <input type="number" id="para_count" name="para_count"
                                placeholder="Para(s) of Quran Majeed"
                                class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-black text-white font-medium text-sm rounded-lg shadow-md hover:bg-green-800">
                            Submit
                        </button>
                    </div>
                </form>
            </div>


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>



        </div>
    </div>

</x-app-layout>
