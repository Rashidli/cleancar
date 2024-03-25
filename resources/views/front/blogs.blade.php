@extends('front.layouts.master')

{{--@section('title', $service->title)--}}
{{--@section('description', $service->content)--}}
{{--@section('keywords', $service->title)--}}
{{--@section('ogTitle', $service->title)--}}
{{--@section('ogDescription', $service->content)--}}

@section('content')

    <!-------------- Page Head ------------------->
    <div class="pageHead p-lr">
        <div class="page-navigate">
            <a href="{{route('welcome')}}" class="prevPage">{{$words['main']->translate(app()->getLocale())->title}}</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                <g clip-path="url(#clip0_2961_1280)">
                    <path d="M0.126913 7.23959C-0.0456133 7.41667 -0.041707 7.70053 0.136027 7.87305C0.313111 8.04558 0.596965 8.04167 0.769491 7.86394L4.22782 4.29688L3.90686 3.98503L4.22913 4.29753C4.40165 4.11915 4.39775 3.83464 4.21936 3.66211C4.21415 3.65691 4.20894 3.65235 4.20374 3.64779L0.76884 0.136072C0.596314 -0.041662 0.313111 -0.0455682 0.135376 0.126958C-0.041707 0.299484 -0.0456133 0.582687 0.126913 0.760421L3.28186 3.98633L0.126913 7.23959Z" fill="black" fill-opacity="0.4"/>
                </g>
                <defs>
                    <clipPath id="clip0_2961_1280">
                        <rect width="4.35612" height="8" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
            <a href="{{route('blogs')}}" class="currentPage">{{$words['website.blog']->translate(app()->getLocale())->title}}</a>
        </div>
        <h1 class="page-title">{{$words['website.blog']->translate(app()->getLocale())->title}}</h1>
        <div class="page-head-logo">
            <img src="{{asset('front/image/pageheadLogo.svg')}}" alt="">
        </div>
    </div>
    <!-------------- All Blogs ------------------->
    <div class="allBlogs p-lr mt-76">
        @foreach($blogs as $blog)
            <a href="{{route('dynamic.page' , $blog->slug)}}" class="blog-box">
                <div class="blog-img">
                    <img src="{{$blog->image}}" alt="{{$blog->title}}" title="{{$blog->title}}">
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
                        <p class="date"> <?php echo $blog->created_at->format('d.m.Y'); ?></p>
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
    <div class="p-lr mt-76">
        {{ $blogs->links('vendor.pagination.bootstrap-4') }}
    </div>


@endsection
