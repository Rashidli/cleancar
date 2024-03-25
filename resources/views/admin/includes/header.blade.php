<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Washing Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/admin_assets/images/favicon.png">
    <link rel="stylesheet" href="/admin_assets/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/admin_assets/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="/admin_assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="/admin_assets/css/style.css" rel="stylesheet">
    <link href="/admin_assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="{{route('admin_dashboard')}}" class="brand-logo">
            <img class="logo-abbr" src="/admin_assets/images/logo.png" alt="">
            <img class="logo-compact" src="/admin_assets/images/logo-text.png" alt="">
            <img class="brand-title" src="/admin_assets/images/logo-text.png" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                            <div class="dropdown-menu p-0 m-0">
                                <form>
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                </form>
                            </div>
                        </div>
                    </div>
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
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                <i class="mdi mdi-account"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{route('admin_profile')}}" class="dropdown-item">
                                    <i class="icon-user"></i>
                                    <span class="ml-2">Profile </span>
                                </a>
                                <a href="{{route('admin_exit')}}" class="dropdown-item">
                                    <i class="icon-key"></i>
                                    <span class="ml-2">Logout </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
        Header end ti-comment-alt
    ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="quixnav">
        <div class="quixnav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label first">Main Menu</li>
                <li>
                    <a href="{{route('washing')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Car Washings</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('reservation')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Reservations</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('services.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Car Services</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('city')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Şəhərlər</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('users')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('packages.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Qiymət paketləri</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('words.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Sözlər</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('bans.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Ban növləri</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('offers.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Təkliflər</span>
                    </a>
                </li>


                <li>
                    <a href="{{route('terms.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Şərtlər və qaydalar</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('faqs.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Çox verilən suallar</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('statistics.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Statistika</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('visions.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Niyə biz?</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('abouts.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Haqqımızda</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('blogs.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Bloqlar</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('heroes.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Ana section</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('languages.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Dillər</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('contacts.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('suggestions.index')}}" aria-expanded="false">
                        <i class="icon icon-single-copy-06"></i>
                        <span class="nav-text">Sayt təkliflər</span>
                    </a>
                </li>

            </ul>
        </div>


    </div>
    <!--**********************************
        Sidebar end
    ***********************************-->
