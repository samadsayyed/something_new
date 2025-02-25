<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="/Logo.webp" class="block h-12 w-auto" alt="Logo" />
                    </a>
                </div>

                <!-- Navigation Links - Horizontal on desktop -->
                <div class="hidden md:flex space-x-8 ml-10">
                    <x-nav-link href="https://masjidehussain.com/" class="text-green-600 font-medium">
                        {{ __('Home') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="font-medium">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    
                    <div x-data="{ open: false }" class="relative">
                        <x-nav-link @click="open = !open" @click.away="open = false" class="flex items-center font-medium">
                            {{ __('Projects') }}
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </x-nav-link>
                        <div x-show="open" class="absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg">
                            <!-- Dropdown content for Projects -->
                            <a href="https://masjidehussain.com/project/build-a-masjid/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Build a Masjid</a>
                            <a href="https://masjidehussain.com/project/quran-classes/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Quran Classes</a>
                            <a href="https://masjidehussain.com/project/hadith-classes/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Hadith Classes</a>
                            <a href="https://masjidehussain.com/project/scholarship/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Scholarship</a>
                            <a href="https://masjidehussain.com/project/sadqa/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sadqa</a>
                            <a href="https://masjidehussain.com/project/water-pumps/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Water Pumps</a>
                        </div>
                    </div>
                    
                    <div x-data="{ open: false }" class="relative">
                        <x-nav-link @click="open = !open" @click.away="open = false" class="flex items-center font-medium">
                            {{ __('Markaz-e-Durood') }}
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </x-nav-link>
                        <div x-show="open" class="absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg">
                            <!-- Dropdown content for Markaz-e-Durood -->
                            <a href="https://masjidehussain.com/markaz-e-naat/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Markaz-e-Naat</a>
                            <a href="https://masjidehussain.com/bayan/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Bayan</a>
                            <a href="https://masjidehussain.com/online-classes/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Online Classes</a>
                            <a href="https://markazedurood.masjidehussain.com/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Submit Durood</a>
                        </div>
                    </div>
                    
                    <x-nav-link href="https://masjidehussain.com/about/" class="font-medium">
                        {{ __('About') }}
                    </x-nav-link>
                    
                    <x-nav-link href="https://masjidehussain.com/contact/" class="font-medium">
                        {{ __('Contact') }}
                    </x-nav-link>
                    
                    <x-nav-link href="https://masjidehussain.com/news/" class="font-medium">
                        {{ __('News') }}
                    </x-nav-link>
                </div>
            </div>
            
            <div class="hidden md:flex items-center">
        <a href="{{route('profile.edit')}}" class="text-gray-500">Profile</a>
        </div>

            <!-- Right Side with Donate Now button -->
            <div class="hidden md:flex items-center">
                <!-- Donate Now Button -->
                <a href="https://donate-masjidehussain.tscube.co.in/" class="inline-flex items-center px-6 py-2 bg-blue-900 border border-transparent rounded-full font-semibold text-white hover:bg-blue-800 focus:outline-none transition">
                    {{ __('Donate Now') }}
                </a>
            </div>

            <!-- Hamburger for mobile -->
            <div class="flex items-center md:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="#" class="block text-green-600">
                {{ __('Home') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            
            <!-- Projects with sub-items -->
            <div x-data="{ open: false }">
                <x-responsive-nav-link @click="open = !open" class="flex justify-between items-center">
                    <span>{{ __('Projects') }}</span>
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </x-responsive-nav-link>
                <div x-show="open" class="pl-4">
                    <x-responsive-nav-link href="https://masjidehussain.com/project/build-a-masjid" class="block">Build a Masjid</x-responsive-nav-link>
                    <x-responsive-nav-link href="https://masjidehussain.com/project/quran-classes" class="block">Quran Classes</x-responsive-nav-link>
                    <x-responsive-nav-link href="https://masjidehussain.com/project/hadith-classes" class="block">Hadith Classes</x-responsive-nav-link>
                    <x-responsive-nav-link href="https://masjidehussain.com/project/scholarship" class="block">Scholarship</x-responsive-nav-link>
                    <x-responsive-nav-link href="https://masjidehussain.com/project/sadqa" class="block">Sadqa</x-responsive-nav-link>
                    <x-responsive-nav-link href="https://masjidehussain.com/project/water-pumps" class="block">Water Pumps</x-responsive-nav-link>
                </div>
            </div>
            
            <!-- Markaz-e-Durood with sub-items -->
            <div x-data="{ open: false }">
                <x-responsive-nav-link @click="open = !open" class="flex justify-between items-center">
                    <span>{{ __('Markaz-e-Durood') }}</span>
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </x-responsive-nav-link>
                <div x-show="open" class="pl-4">
                    <x-responsive-nav-link href="https://masjidehussain.com/markaz-e-naat" class="block">Markaz-e-Naat</x-responsive-nav-link>
                    <x-responsive-nav-link href="https://masjidehussain.com/bayan" class="block">Bayan</x-responsive-nav-link>
                    <x-responsive-nav-link href="https://masjidehussain.com/online-classes" class="block">Online Classes</x-responsive-nav-link>
                    <x-responsive-nav-link href="https://markazedurood.masjidehussain.com" class="block">Submit Durood</x-responsive-nav-link>
                </div>
            </div>
            
            <x-responsive-nav-link href="https://masjidehussain.com/about/" class="block">
                {{ __('About') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="https://masjidehussain.com/contact/" class="block">
                {{ __('Contact') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="https://masjidehussain.com/news/" class="block">
                {{ __('News') }}
            </x-responsive-nav-link>
            
            <!-- Donate Now button in mobile menu -->
            <div class="pt-2 pb-3">
                <a href="#" class="flex items-center justify-center px-4 py-2 bg-blue-900 border border-transparent rounded-full text-white text-sm font-medium">
                    {{ __('Donate Now') }}
                </a>
            </div>
        </div>
    </div>
</nav>