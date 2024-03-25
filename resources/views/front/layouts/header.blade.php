<div class="navbar p-lr">
    <a href="{{route('welcome')}}" class="navlogo">
        <img src="{{asset('/')}}front/image/nav-logo.svg" alt="">
    </a>
    <div class="nav-menu-items">
        <a href="{{route('about')}}" class="navlink">{{$words['website.about']->translate(app()->getLocale())->title}}</a>
        <a href="{{route('branches')}}" class="navlink">{{$words['website.branches']->translate(app()->getLocale())->title}}</a>
        <a href="{{route('services')}}" class="navlink">{{$words['website.service']->translate(app()->getLocale())->title}}</a>
        <a href="{{route('blogs')}}" class="navlink">{{$words['website.blog']->translate(app()->getLocale())->title}}</a>

        @if(count($locales = LaravelLocalization::getSupportedLanguagesKeys()) > 1)
            <div class="languages">
                @foreach($locales as $key=>$locale)
                    @if(isset($translatedLinks))
                        @if(array_key_exists($locale, $translatedLinks))
                            <a href="{{ $translatedLinks[$locale] }}" class="lang-item {{app()->getLocale() === $locale ? 'active-lang' : ''}} ">{{ strtoupper($locale) }}</a>
                        @else
                            <a href="{{ LaravelLocalization::localizeURL(url()->route('welcome'), $locale) }}" class="lang-item {{app()->getLocale() === $locale ? 'active-lang' : ''}} ">{{ strtoupper($locale) }}</a>
                        @endif
                    @else
                        <a href="{{ LaravelLocalization::localizeURL(url()->current(), $locale) }}" class="lang-item {{app()->getLocale() === $locale ? 'active-lang' : ''}} ">{{ strtoupper($locale) }}</a>
                    @endif
                @endforeach
            </div>
        @endif
        <button class="closeMenu"><i class="bi bi-x-lg"></i></button>
    </div>
    <button class="hamgurgerMenu">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
            <rect width="48" height="48" fill="white"/>
            <line x1="12" y1="16.6667" x2="22.6667" y2="16.6667" stroke="#0F0403" stroke-width="1.33333"/>
            <line x1="12" y1="23.3333" x2="36" y2="23.3333" stroke="#0F0403" stroke-width="1.33333"/>
            <line x1="12" y1="30" x2="25.3333" y2="30" stroke="#0F0403" stroke-width="1.33333"/>
        </svg>
    </button>
</div>
