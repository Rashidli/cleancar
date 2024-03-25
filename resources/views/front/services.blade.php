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
            <a href="{{route('services')}}" class="currentPage">{{$words['website.service']->translate(app()->getLocale())->title}}</a>
        </div>
        <h1 class="page-title">{{$words['website.service']->translate(app()->getLocale())->title}}</h1>
        <div class="page-head-logo">
            <img src="{{asset('front/image/pageheadLogo.svg')}}" alt="">
        </div>
    </div>
    <!-------------- All Services ------------------->
    <div class="allServices p-lr mt-76">
        @foreach($services as $service)
            <div class="service-box">
                <div class="service-icon">
                    <img src="{{$service->image_white}}" alt="{{$service->title}}" title="{{$service->title}}">
                </div>
                <h3 class="service_name">{{$service->title}}</h3>
                <div>{!! \Illuminate\Support\Str::limit($service->content, 70) !!}</div>
                <a href="{{route('dynamic.page' , $service->slug)}}" class="see_more">
                    <span>{{$words['wee_more']->translate(app()->getLocale())->title}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.666664 7.83388C0.666664 7.70127 0.719343 7.5741 0.813111 7.48033C0.906879 7.38656 1.03406 7.33388 1.16666 7.33388H12.9597L9.81266 4.18788C9.71878 4.094 9.66603 3.96666 9.66603 3.83388C9.66603 3.70111 9.71878 3.57377 9.81266 3.47988C9.90655 3.386 10.0339 3.33325 10.1667 3.33325C10.2994 3.33325 10.4268 3.386 10.5207 3.47988L14.5207 7.47988C14.5672 7.52633 14.6042 7.5815 14.6294 7.64225C14.6546 7.703 14.6676 7.76812 14.6676 7.83388C14.6676 7.89965 14.6546 7.96477 14.6294 8.02552C14.6042 8.08626 14.5672 8.14144 14.5207 8.18788L10.5207 12.1879C10.4268 12.2818 10.2994 12.3345 10.1667 12.3345C10.0339 12.3345 9.90655 12.2818 9.81266 12.1879C9.71878 12.094 9.66603 11.9667 9.66603 11.8339C9.66603 11.7011 9.71878 11.5738 9.81266 11.4799L12.9597 8.33388H1.16666C1.03406 8.33388 0.906879 8.28121 0.813111 8.18744C0.719343 8.09367 0.666664 7.96649 0.666664 7.83388Z" fill="#4283F0"/>
                    </svg>
                </a>
            </div>
        @endforeach

    </div>

@endsection
