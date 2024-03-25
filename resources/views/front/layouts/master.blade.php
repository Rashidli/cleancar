<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    <title>@yield('title', 'Clean Car')</title>
    <meta name="description" content="@yield('description', 'Default Description')">
    <meta name="keywords" content="@yield('keywords', 'Default Keywords')">

    <meta property="og:title" content="@yield('ogTitle', 'Default Open Graph Title')">
    <meta property="og:description" content="@yield('ogDescription', 'Default Open Graph Description')">
{{--    <meta property="og:image" content="@yield('ogImage', 'Default Open Graph Image URL')">--}}
{{--    <meta property="og:url" content="@yield('ogUrl', 'Default Open Graph URL')">--}}

{{--    <meta name="twitter:card" content="summary_large_image">--}}
{{--    <meta name="twitter:title" content="@yield('twitterCardTitle', 'Default Twitter Card Title')">--}}
{{--    <meta name="twitter:description" content="@yield('twitterCardDescription', 'Default Twitter Card Description')">--}}
{{--    <meta name="twitter:image" content="@yield('twitterCardImage', 'Default Twitter Card Image URL')">--}}


    <link rel="stylesheet" href="{{asset('front/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.0.1/remixicon.css">
</head>
<body>

<!-------------- Navbar------------------->

@include('front.layouts.header')

@yield('content')

<!-------------- Footer Section------------------->

@include('front.layouts.footer')
</body>
</html>
