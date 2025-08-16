<footer>
    <div class="w-full bg-teal-1001 p-4 md:flex md:items-center md:justify-between fixed bottom-0 z-20">
        
        <!-- Logo dan Brand -->
        <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('images/Logo.png') }}" class="h-8" alt="{{ __('genHomepageLayouteral.brand_name') }} Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-gold">
                {{ __('HomepageLayout.brand_name') }}
            </span>
        </a>

        <!-- Copyright -->
        <span class="text-sm text-gold sm:text-center">
            {!! __('HomepageLayout.footer.copyright', ['brand' => __('HomepageLayout.brand_name')]) !!}
        </span>

        @auth
        <!-- Menu Footer -->
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gold sm:mt-0">
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">{{ __('HomepageLayout.footer.about') }}</a>
            </li>
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">{{ __('HomepageLayout.footer.privacy_policy') }}</a>
            </li>
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">{{ __('HomepageLayout.footer.licensing') }}</a>
            </li>
            <li>
                <a href="#" class="hover:underline">{{ __('HomepageLayout.footer.contact') }}</a>
            </li>
        </ul>
        @endauth

    </div>
</footer>
