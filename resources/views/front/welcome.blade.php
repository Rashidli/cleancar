@extends('front.layouts.master')

@section('title', 'Cleancar')
@section('description', 'Təmiz maşın')
@section('keywords', 'moyka, avtoyuma, masin')
@section('ogTitle', 'Cleancar')
@section('ogDescription', 'Təmiz maşın')


@section('content')

    <div class="home-hero">
        <div class="home-hero-Slider swiper">
            <div class="swiper-wrapper">
                @foreach($heroes as $hero)
                    <div class=" swiper-slide hero-item p-lr">
                        <div class="hero-content">
                            <p class="hero-content-topText" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <g clip-path="url(#clip0_2845_3432)">
                                        <path d="M16 0C18.4818 0 20.8304 0.565409 22.929 1.5739C22.07 2.25348 21.2735 2.90588 20.5314 3.53381C19.1179 3.02005 17.5929 2.74006 16.0027 2.74006C12.3411 2.74006 9.02481 4.22426 6.62725 6.62453C4.22698 9.0248 2.74278 12.3384 2.74278 16C2.74278 19.6616 4.22698 22.9752 6.62725 25.3755C9.02752 27.7757 12.3411 29.2599 16.0027 29.2599C19.6643 29.2599 22.9806 27.7757 25.3782 25.3755C27.7785 22.9752 29.2627 19.6616 29.2627 16C29.2627 15.1301 29.1784 14.2766 29.018 13.4529C29.7057 12.5559 30.4098 11.6616 31.1301 10.7754C31.6955 12.4118 32.0027 14.1706 32.0027 16C32.0027 20.4173 30.2113 24.4186 27.3163 27.3136C24.4213 30.2086 20.42 32 16.0027 32C11.5855 32 7.5841 30.2086 4.68909 27.3136C1.79137 24.4186 0 20.4173 0 16C0 11.5827 1.79137 7.58138 4.68637 4.68637C7.58138 1.79137 11.5827 0 16 0ZM8.54638 13.3714L12.4499 13.3197L12.7407 13.3959C13.5291 13.8498 14.2712 14.369 14.9643 14.9562C15.4645 15.3802 15.9429 15.8423 16.3969 16.3425C17.7968 14.089 19.2892 12.0204 20.8658 10.1176C22.5919 8.03262 24.4241 6.14067 26.3486 4.41454L26.7292 4.26775H30.9888L30.1298 5.22188C27.4903 8.15494 25.0955 11.1859 22.9317 14.3119C20.7679 17.4407 18.8325 20.6701 17.1118 23.9946L16.5763 25.0275L16.0843 23.9755C15.1764 22.0265 14.089 20.2379 12.7924 18.6395C11.4958 17.0411 9.98709 15.6222 8.22834 14.4152L8.54638 13.3714Z" fill="#4283F0"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2845_3432">
                                            <rect width="32" height="32" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <span>{{$hero->title}}</span>
                            </p>
                            <h1 class="hero-title">
                               {!! $hero->content !!}
                            </h1>
                            <p class="hero-text">
                                {{$hero->text}}
                            </p>
                            <div class="hero-buttons">
                                <a href="" class="downloadBtn appstore">
                                    <img src="{{asset('/')}}front/image/apple-icon 1.svg" alt="">
                                    <div class="downloadBtn-text">
                                        <p class="text-brandName">App Store</p>
                                        <p class="text-download">{{$words['website.with']->translate(app()->getLocale())->title}}</p>
                                    </div>
                                </a>
                                <a href="" class="downloadBtn playMarket">
                                    <img src="{{asset('/')}}front/image/google_play.png" alt="">
                                    <div class="downloadBtn-text">
                                        <p class="text-brandName">Play Store</p>
                                        <p class="text-download">{{$words['website.with']->translate(app()->getLocale())->title}}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="hero-img">
                            <img src="{{$hero->image}}" alt="{{$hero->title}}" title="{{$hero->title}}">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
    <!-------------- Statistics Section------------------->
    <div class="statistic-area p-lr mt-64">
        <h1 class="title">{{$words['website.statistics']->translate(app()->getLocale())->title}}</h1>
        <div class="statistic-items">
            @foreach($statistics as $statistic)
                <div class="statistic-item">
                    <h1 class="statistic-count">{{$statistic->title}}</h1>
                    <p>{{$statistic->content}}</p>
                </div>
            @endforeach

        </div>
    </div>
    <!-------------- Application Section------------------->
    <div class="application-area p-lr mt-76">
        <div class="app-content">
{{--            <h2 class="app-content-title"><span>Clean Car</span> mobil tətbiqini elə indi yükləyin</h2>--}}
            <h2 class="app-content-title">{{$words['website.download_title']->translate(app()->getLocale())->title}}</h2>
            <p>{{$words['website.download_text']->translate(app()->getLocale())->title}}</p>
            <a href="" class="now_download blueBtn">{{$words['website.download']->translate(app()->getLocale())->title}}</a>
        </div>
        <div class="qr_area">
            <div class="qr_box">
                <h3 class="qr_box_title">Android</h3>
                <p>{{$words['website.last_version']->translate(app()->getLocale())->title}}</p>
                <div class="qr_code_img">
                    <img src="{{asset('/')}}front/image/qr_android.svg" alt="">
                </div>
            </div>
            <div class="qr_box">
                <h3 class="qr_box_title">IOS</h3>
                <p>{{$words['website.last_version']->translate(app()->getLocale())->title}}</p>
                <div class="qr_code_img">
                    <img src="{{asset('/')}}front/image/qr_ios.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-------------- Service Section------------------->
    <div class="service-section mt-64">
        <h1 class="title">{{$words['website.service']->translate(app()->getLocale())->title}}</h1>
        <div class="service-Slide swiper">
            <div class="swiper-wrapper p-lr">
                @foreach($services as $service)
                    <div class="swiper-slide service-box">
                        <div class="service-icon">
                            <img src="{{$service->image_white}}" alt="{{$service->title}}" title="{{$service->title}}">
                        </div>
                        <h3 class="service_name">{{$service->title}}</h3>
                        <p>{!! \Illuminate\Support\Str::limit($service->content, 60) !!}</p>
                        <a href="{{route('dynamic.page' , $service->slug)}}" class="see_more">
                            <span>{{$words['wee_more']->translate(app()->getLocale())->title}}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.666664 7.83388C0.666664 7.70127 0.719343 7.5741 0.813111 7.48033C0.906879 7.38656 1.03406 7.33388 1.16666 7.33388H12.9597L9.81266 4.18788C9.71878 4.094 9.66603 3.96666 9.66603 3.83388C9.66603 3.70111 9.71878 3.57377 9.81266 3.47988C9.90655 3.386 10.0339 3.33325 10.1667 3.33325C10.2994 3.33325 10.4268 3.386 10.5207 3.47988L14.5207 7.47988C14.5672 7.52633 14.6042 7.5815 14.6294 7.64225C14.6546 7.703 14.6676 7.76812 14.6676 7.83388C14.6676 7.89965 14.6546 7.96477 14.6294 8.02552C14.6042 8.08626 14.5672 8.14144 14.5207 8.18788L10.5207 12.1879C10.4268 12.2818 10.2994 12.3345 10.1667 12.3345C10.0339 12.3345 9.90655 12.2818 9.81266 12.1879C9.71878 12.094 9.66603 11.9667 9.66603 11.8339C9.66603 11.7011 9.71878 11.5738 9.81266 11.4799L12.9597 8.33388H1.16666C1.03406 8.33388 0.906879 8.28121 0.813111 8.18744C0.719343 8.09367 0.666664 7.96649 0.666664 7.83388Z" fill="#4283F0"/>
                            </svg>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-------------- Advantages Tags Section------------------->
    <div class="advantages-tags mt-76">
        <div class="advantages-tags-Slider swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide advantages-tag-item">
                    <div class="advantages-tag-img">
                        <img src="{{asset('/')}}front/image/car2.svg" alt="">
                    </div>
                    <p>İnnovativ Tətbiq</p>
                </div>
                <div class="swiper-slide advantages-tag-item">
                    <div class="advantages-tag-img">
                        <img src="{{asset('/')}}front/image/car1.svg" alt="">
                    </div>
                    <p>Asan İnterferys</p>
                </div>
                <div class="swiper-slide advantages-tag-item">
                    <div class="advantages-tag-img">
                        <img src="{{asset('/')}}front/image/car2.svg" alt="">
                    </div>
                    <p>Üstün Xidmətlər</p>
                </div>
                <div class="swiper-slide advantages-tag-item">
                    <div class="advantages-tag-img">
                        <img src="{{asset('/')}}front/image/car1.svg" alt="">
                    </div>
                    <p>Müasir Rezervasiya</p>
                </div>
                <div class="swiper-slide advantages-tag-item">
                    <div class="advantages-tag-img">
                        <img src="{{asset('/')}}front/image/car2.svg" alt="">
                    </div>
                    <p>İnnovativ Tətbiq</p>
                </div>

            </div>
        </div>
    </div>
    <!-------------- Offers Section------------------->
    <div class="offer-section mt-64">
        <h1 class="title">{{$words['website.last_offer']->translate(app()->getLocale())->title}}</h1>
        <div class="offer-Slide swiper">
            <div class="swiper-wrapper p-lr">
                @foreach($suggestions as $suggestion)
                    <div class="swiper-slide offer-box">
                        <h3 class="offer-name">{{$suggestion->title}}</h3>
                        <p class="offer-pay">{{$suggestion->price}} {{$words['website.currency']->translate(app()->getLocale())->title}}</p>
                        <div class="offer-services">
                            <div class="offer-service-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <g clip-path="url(#clip0_2960_53)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C12.4184 0 16.0001 3.58164 16.0001 7.99987C16.0001 12.4182 12.4184 15.9999 8 15.9999C3.58177 16 0 12.4182 0 7.99987C0 3.58164 3.58177 0 8 0ZM4.44089 8.81224L4.43893 8.81042C4.33672 8.71693 4.28177 8.59102 4.27539 8.46289C4.26901 8.33503 4.3112 8.20443 4.40352 8.1013C4.40482 8.09987 4.40599 8.09857 4.40729 8.09727C4.50065 7.99518 4.62656 7.9401 4.75469 7.93372C4.88346 7.92734 5.01484 7.97018 5.11823 8.06367L6.80521 9.59336L10.8533 5.35391C10.9496 5.25286 11.0776 5.20026 11.2073 5.19714C11.3365 5.19388 11.4669 5.23997 11.5681 5.33607C11.6693 5.43229 11.7217 5.56068 11.725 5.6901C11.7283 5.8194 11.682 5.95013 11.5859 6.05117L7.19779 10.647C7.19479 10.6501 7.19154 10.6531 7.18828 10.6557C7.09518 10.7488 6.97357 10.7983 6.85 10.8029C6.72318 10.8077 6.5944 10.7647 6.49271 10.6727L4.44245 8.81354L4.44089 8.81224Z" fill="#4283F0"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2960_53">
                                            <rect width="16.0001" height="16" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p>{{$words['website.service_type']->translate(app()->getLocale())->title}}: <span>{{$suggestion->service}}</span></p>
                            </div>
                            <div class="offer-service-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <g clip-path="url(#clip0_2960_53)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C12.4184 0 16.0001 3.58164 16.0001 7.99987C16.0001 12.4182 12.4184 15.9999 8 15.9999C3.58177 16 0 12.4182 0 7.99987C0 3.58164 3.58177 0 8 0ZM4.44089 8.81224L4.43893 8.81042C4.33672 8.71693 4.28177 8.59102 4.27539 8.46289C4.26901 8.33503 4.3112 8.20443 4.40352 8.1013C4.40482 8.09987 4.40599 8.09857 4.40729 8.09727C4.50065 7.99518 4.62656 7.9401 4.75469 7.93372C4.88346 7.92734 5.01484 7.97018 5.11823 8.06367L6.80521 9.59336L10.8533 5.35391C10.9496 5.25286 11.0776 5.20026 11.2073 5.19714C11.3365 5.19388 11.4669 5.23997 11.5681 5.33607C11.6693 5.43229 11.7217 5.56068 11.725 5.6901C11.7283 5.8194 11.682 5.95013 11.5859 6.05117L7.19779 10.647C7.19479 10.6501 7.19154 10.6531 7.18828 10.6557C7.09518 10.7488 6.97357 10.7983 6.85 10.8029C6.72318 10.8077 6.5944 10.7647 6.49271 10.6727L4.44245 8.81354L4.44089 8.81224Z" fill="#4283F0"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2960_53">
                                            <rect width="16.0001" height="16" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p>{{$words['website.ban_type']->translate(app()->getLocale())->title}}: <span>{{$suggestion->service}}: <span>{{$suggestion->ban}}</span></p>
                            </div>
                            <div class="offer-service-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <g clip-path="url(#clip0_2960_53)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C12.4184 0 16.0001 3.58164 16.0001 7.99987C16.0001 12.4182 12.4184 15.9999 8 15.9999C3.58177 16 0 12.4182 0 7.99987C0 3.58164 3.58177 0 8 0ZM4.44089 8.81224L4.43893 8.81042C4.33672 8.71693 4.28177 8.59102 4.27539 8.46289C4.26901 8.33503 4.3112 8.20443 4.40352 8.1013C4.40482 8.09987 4.40599 8.09857 4.40729 8.09727C4.50065 7.99518 4.62656 7.9401 4.75469 7.93372C4.88346 7.92734 5.01484 7.97018 5.11823 8.06367L6.80521 9.59336L10.8533 5.35391C10.9496 5.25286 11.0776 5.20026 11.2073 5.19714C11.3365 5.19388 11.4669 5.23997 11.5681 5.33607C11.6693 5.43229 11.7217 5.56068 11.725 5.6901C11.7283 5.8194 11.682 5.95013 11.5859 6.05117L7.19779 10.647C7.19479 10.6501 7.19154 10.6531 7.18828 10.6557C7.09518 10.7488 6.97357 10.7983 6.85 10.8029C6.72318 10.8077 6.5944 10.7647 6.49271 10.6727L4.44245 8.81354L4.44089 8.81224Z" fill="#4283F0"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2960_53">
                                            <rect width="16.0001" height="16" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p>{{$words['website.branch']->translate(app()->getLocale())->title}}: <span>{{$suggestion->branch}}</span></p>
                            </div>
                        </div>
                        <a href="" class="now_buy blueBtn">
                            {{$words['website.buy_now']->translate(app()->getLocale())->title}}
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-------------- Blog Section------------------->
    <div class="blog-section p-lr mt-64">
        <h1 class="title"> {{$words['website.blog']->translate(app()->getLocale())->title}}</h1>
        <div class="blog-Slide swiper">
            <div class="swiper-wrapper">
                @foreach($blogs as $blog)
                    <a href="{{route('dynamic.page', $blog->slug)}}" class="swiper-slide blog-box">
                        <div class="blog-img">
                            <img src="{{$blog->image}}" alt="">
                        </div>
                        <div class="blog-box-body">
                            <div class="blog-date">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <g clip-path="url(#clip0_2961_1702)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6 0C9.31348 0 12 2.68652 12 6C12 9.31348 9.31348 12 6 12C2.68652 12 0 9.31348 0 6C0 2.68652 2.68652 0 6 0ZM5.29492 3.67676C5.29492 2.75586 6.69824 2.75488 6.69824 3.67871V6.19336L8.2832 7.03223C8.29102 7.03613 8.29883 7.04102 8.30566 7.04688L8.31934 7.05664C9.05566 7.53906 8.37109 8.69824 7.58398 8.24316L7.58105 8.24121L5.66309 7.21387C5.43848 7.09375 5.29297 6.85547 5.29297 6.59961H5.29395L5.29492 3.67676Z" fill="#4283F0"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2961_1702">
                                            <rect width="12" height="12" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p class="date">{{ \Carbon\Carbon::parse($blog->created_at)->format('d.m.Y') }}</p>
                            </div>
                            <h3 class="blog-name">{{$blog->title}}</h3>
                            <p class="see_more">
                                <span>{{$words['wee_more']->translate(app()->getLocale())->title}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.666664 7.83413C0.666664 7.70152 0.719343 7.57434 0.813111 7.48057C0.906879 7.38681 1.03406 7.33413 1.16666 7.33413H12.9597L9.81266 4.18813C9.71878 4.09424 9.66603 3.9669 9.66603 3.83413C9.66603 3.70135 9.71878 3.57401 9.81266 3.48013C9.90655 3.38624 10.0339 3.3335 10.1667 3.3335C10.2994 3.3335 10.4268 3.38624 10.5207 3.48013L14.5207 7.48013C14.5672 7.52657 14.6042 7.58175 14.6294 7.64249C14.6546 7.70324 14.6676 7.76836 14.6676 7.83413C14.6676 7.89989 14.6546 7.96502 14.6294 8.02576C14.6042 8.08651 14.5672 8.14168 14.5207 8.18813L10.5207 12.1881C10.4268 12.282 10.2994 12.3348 10.1667 12.3348C10.0339 12.3348 9.90655 12.282 9.81266 12.1881C9.71878 12.0942 9.66603 11.9669 9.66603 11.8341C9.66603 11.7014 9.71878 11.574 9.81266 11.4801L12.9597 8.33413H1.16666C1.03406 8.33413 0.906879 8.28145 0.813111 8.18768C0.719343 8.09391 0.666664 7.96674 0.666664 7.83413Z" fill="black" fill-opacity="0.6"/>
                                </svg>
                            </p>
                        </div>
                    </a>
                @endforeach


            </div>
        </div>
    </div>
    <!-------------- Contact Section------------------->
    <div class="contact mt-76 p-lr">
        <div class="contact-area">
            <div class="contact-details">
                <h1 class="contact-title">{{$words['website.contact_text']->translate(app()->getLocale())->title}}</h1>
                <p class="contact-description">{{$words['website.contact_content']->translate(app()->getLocale())->title}}</p>
                <div class="contact-items">
                    <a href="" class="contactPhone contact-item">
                        <div class="contact-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_2352_3738)">
                                    <path d="M5.50852 8.21995C6.1808 9.4387 6.95562 10.6084 7.96159 11.675C8.97082 12.7481 10.2258 13.7248 11.8504 14.5591C11.9708 14.618 12.0848 14.618 12.1873 14.5771C12.342 14.5182 12.4999 14.389 12.6545 14.2335C12.7749 14.1125 12.9247 13.9194 13.081 13.7084C13.706 12.8823 14.4792 11.8566 15.5715 12.3702C15.5959 12.3817 15.6138 12.3948 15.6382 12.4046L19.2812 14.51C19.2926 14.5166 19.3056 14.528 19.3154 14.5345C19.7956 14.8666 19.9942 15.3787 19.9991 15.9594C19.9991 16.55 19.7826 17.2142 19.4651 17.7753C19.0452 18.5163 18.4266 19.0071 17.7136 19.331C17.0349 19.6451 16.2796 19.8136 15.5536 19.9216C14.4141 20.0901 13.3463 19.9821 12.2541 19.6451C11.1862 19.313 10.1103 18.765 8.93501 18.0354L8.84873 17.9798C8.30994 17.6411 7.72719 17.2796 7.15584 16.8526C5.06576 15.2658 2.935 12.9739 1.5465 10.4513C0.382631 8.33447 -0.252204 6.04911 0.0945134 3.87172C0.286592 2.67751 0.796088 1.59127 1.68486 0.874742C2.45968 0.246554 3.50309 -0.0969859 4.85415 0.0240711C5.00879 0.0355224 5.14715 0.125497 5.2204 0.259641L7.55627 4.22835C7.89811 4.67331 7.94043 5.11501 7.75323 5.5567C7.5986 5.91824 7.28606 6.25196 6.85958 6.56278C6.73424 6.67075 6.58449 6.78036 6.42659 6.89487C5.90407 7.27604 5.30993 7.7161 5.5134 8.23304L5.50852 8.21995Z" fill="#4283F0"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_2352_3738">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <p>{{$words['website.phone']->translate(app()->getLocale())->title}}</p>
                    </a>
                    <a href="" class="contact-mail contact-item">
                        <div class="contact-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="16" viewBox="0 0 23 16" fill="none">
                                <g clip-path="url(#clip0_2352_3746)">
                                    <path d="M0.710529 0L11.6826 8.94706L22.1853 0H0.710529ZM0 15.0557L7.81582 7.21935L0 0.847026V15.0576V15.0557ZM8.67781 7.9224L0.618909 16H22.2901L14.5846 7.9224L12.0491 10.0858C11.9502 10.1682 11.826 10.2141 11.6973 10.2158C11.5687 10.2175 11.4433 10.1749 11.3423 10.0951L8.67781 7.9224ZM15.4316 7.20439L22.9763 15.1193V0.777843L15.4316 7.20439Z" fill="#4283F0"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_2352_3746">
                                        <rect width="22.9763" height="16" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <p>{{$words['website.email']->translate(app()->getLocale())->title}}</p>
                    </a>
                    <a href="" class="contactLocation contact-item">
                        <div class="contact-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" viewBox="0 0 16 20" fill="none">
                                <g clip-path="url(#clip0_2352_3753)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8825 17.2984C10.913 18.2961 9.78386 19.1896 8.516 19.9123C8.3599 20.0197 8.1483 20.0327 7.97486 19.9286C6.10169 18.8104 4.52857 17.4676 3.29193 16.0077C1.58527 13.9992 0.511662 11.7727 0.143966 9.62747C-0.230668 7.45299 0.119684 5.35989 1.27307 3.65905C1.72749 2.98685 2.30852 2.37487 3.01616 1.8459C4.64304 0.630077 6.50061 -0.0128269 8.35296 0.00019394C10.1359 0.0132148 11.8964 0.636587 13.4175 1.9403C13.9517 2.39603 14.4009 2.91849 14.7686 3.48489C16.0087 5.40221 16.2758 7.84687 15.7312 10.3241C15.1935 12.772 13.858 15.259 11.8825 17.2935V17.2984ZM7.99914 3.86738C10.1984 3.86738 11.9796 5.54056 11.9796 7.60273C11.9796 9.66653 10.1966 11.3381 7.99914 11.3381C5.7999 11.3381 4.01865 9.66653 4.01865 7.60273C4.01692 5.53893 5.7999 3.86738 7.99914 3.86738Z" fill="#4283F0"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_2352_3753">
                                        <rect width="16" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <p>{{$words['website.address']->translate(app()->getLocale())->title}}</p>
                    </a>
                </div>
            </div>
            <div class="contact-form-area">
                <form action="">
                    <input type="text" placeholder="{{$words['website.name']->translate(app()->getLocale())->title}}">
                    <input type="text" placeholder="{{$words['website_phone_text']->translate(app()->getLocale())->title}}">
                    <textarea name="" id="" cols="30" rows="5" placeholder="{{$words['website.message']->translate(app()->getLocale())->title}}"></textarea>
                    <button class="sendForm blueBtn" type="submit">{{$words['website.send']->translate(app()->getLocale())->title}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
