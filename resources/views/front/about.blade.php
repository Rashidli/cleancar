@extends('front.layouts.master')

{{--@section('title', $service->title)--}}
{{--@section('description', $service->content)--}}
{{--@section('keywords', $service->title)--}}
{{--@section('ogTitle', $service->title)--}}
{{--@section('ogDescription', $service->content)--}}

@section('content')
    <!-------------- About------------------->
    <div class="about-area p-lr mt-76">
{{--        <div class="about-video">--}}
{{--            --}}
{{--            <iframe width="560" height="315" src="https://www.youtube.com/embed/sfpXASLCNwA?si=qe35wSxmMnq2fUHq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>--}}
{{--        </div>--}}
        <div class="about_image">
            <img src="{{$about->image}}" alt="{{$about->title}}" title="{{$about->title}}">
        </div>
        <div class="about-text">
            {!! $about->content !!}
        </div>
    </div>
    <!-------------- Why our App Section------------------->
    <div class="whyOurApp-section p-lr">
        <h1 class="title">{{$words['website.why']->translate(app()->getLocale())->title}}</h1>
        <div class="appAdvantages">
            @foreach($visions as $vision)
                <div class="appAdvantage-box">
                    <div class="appAdvantage-box-img">
                        <img src="{{$vision->image}}" alt="">
                    </div>
                    <h3 class="appAdvantage-box-title">{{$vision->title}}</h3>
                    {!! $vision->content !!}
                </div>
            @endforeach
        </div>
    </div>

@endsection
