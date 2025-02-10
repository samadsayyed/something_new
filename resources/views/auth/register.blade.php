<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- City -->
        <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

            <!-- Country (Dropdown with Full Names) -->
            <div class="mt-4">
                <x-input-label for="country" :value="__('Country')" />
                <select id="country" name="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Select Country</option>
                    <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                    <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                    <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                    <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                    <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                    <option value="Pakistan" {{ old('country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                    <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                    <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                    <option value="Brazil" {{ old('country') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                    <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>China</option>
                    <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                    <option value="South Africa" {{ old('country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                    <option value="Nigeria" {{ old('country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                    <option value="Mexico" {{ old('country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                    <option value="Russia" {{ old('country') == 'Russia' ? 'selected' : '' }}>Russia</option>
                </select>
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>

        <!-- Mobile Number -->
        <div class="mt-4">
            <x-input-label for="mobile_number" :value="__('Mobile Number')" />
            <x-text-input id="mobile_number" class="block mt-1 w-full" type="text" name="mobile_number"
                :value="old('mobile_number')" required />
            <x-input-error :messages="$errors->get('mobile_number')" class="mt-2" />
        </div>

        <!-- Recites Quran -->
        <div class="mt-4">
            <x-input-label for="recites_quran" :value="__('Do you recite the Quran?')" />
            <select id="recites_quran" name="recites_quran"
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="Y" {{ old('recites_quran') == 'Y' ? 'selected' : '' }}>Yes</option>
                <option value="N" {{ old('recites_quran') == 'N' ? 'selected' : '' }}>No</option>
            </select>
            <x-input-error :messages="$errors->get('recites_quran')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
