@extends('front.layouts.master')

@section('title', $service->title)
@section('description', $service->content)
@section('keywords', $service->title)
@section('ogTitle', $service->title)
@section('ogDescription', $service->content)


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
            <a href="{{route('services')}}" class="prevPage">{{$words['website.service']->translate(app()->getLocale())->title}}</a>
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
            <a href="" class="currentPage">{{$service->title}}</a>
        </div>
        <h1 class="page-title">{{$service->title}}</h1>
        <div class="page-head-logo">
            <img src="{{asset('front/image/pageheadLogo.svg')}}" alt="{{$service->title}}" title="{{$service->title}}">
        </div>
    </div>

    <!--------------- Service Inside ------------->
    <div class="service-inside-area p-lr mt-76">
        <div class="service-inside-content">
{{--            <div class="service-inside-img">--}}
{{--                <img src="{{$service->image_white}}" alt="{{$service->title}}" title="{{$service->title}}">--}}
{{--            </div>--}}
            <div class="service-inside-text">
                {!! $service->content !!}
            </div>
        </div>
        <div class="other-service-items">
            @foreach($services as $item)
                <a href="{{route('dynamic.page' , $item->slug)}}" class="other-service-item">
                    <div class="other-service-item-logo">
                        <img src="{{$item->image_white}}" alt="{{$item->title}}" title="{{$item->title}}">
                    </div>
                    <p>{{$item->title}}</p>
                </a>
            @endforeach
        </div>
    </div>

@endsection
