<footer class="footer mt-76 p-lr">
    <a href="home.html" class="footer-logo">
        <img src="{{asset('/')}}front/image/footer-logo.svg" alt="">
    </a>
    <div class="footer-links">
        <a href="{{route('about')}}" class="footer-link">{{$words['website.about']->translate(app()->getLocale())->title}}</a>
        <a href="{{route('branches')}}" class="footer-link">{{$words['website.branches']->translate(app()->getLocale())->title}}</a>
        <a href="{{route('services')}}" class="footer-link">{{$words['website.service']->translate(app()->getLocale())->title}}</a>
        <a href="{{route('blogs')}}" class="footer-link">{{$words['website.blog']->translate(app()->getLocale())->title}}</a>
    </div>
    <div class="social-media">
        <a href="" class="sosialApp">
            <i class="bi bi-instagram"></i>
        </a>
        <a href="" class="sosialApp">
            <i class="ri-facebook-fill"></i>
        </a>
        <a href="" class="sosialApp">
            <i class="bi bi-youtube"></i>
        </a>
        <a href="" class="sosialApp">
            <i class="bi bi-twitter"></i>
        </a>
        <a href="" class="sosialApp">
            <i class="ri-linkedin-fill"></i>
        </a>
    </div>
</footer>
<div class="footer-bottom">
    <p class="copyRight-txt">
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
            <g clip-path="url(#clip0_2961_1574)">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.648 6.10821L9.93481 6.51499C9.56323 5.54107 8.94263 5.05085 8.07171 5.05085C7.40417 5.05085 6.87875 5.30769 6.50065 5.82529C6.11864 6.33898 5.92959 7.02868 5.92959 7.88527C5.92959 8.55932 6.00782 9.13168 6.16819 9.59583C6.32855 10.06 6.56454 10.4055 6.87484 10.6415C7.18514 10.8735 7.55671 10.9909 7.98827 10.9909C8.94915 10.9909 9.60495 10.3911 9.95567 9.19166L11.648 9.76662C11.0913 11.5802 9.85658 12.4876 7.94654 12.4876C7.26467 12.4876 6.62581 12.3194 6.03651 11.9844C5.4472 11.6519 4.97653 11.1421 4.6193 10.4602C4.26597 9.77445 4.08735 8.96089 4.08735 8.01173C4.08735 7.12647 4.25163 6.35202 4.58018 5.68448C4.90482 5.02086 5.37679 4.50326 5.98696 4.13168C6.59713 3.76402 7.3116 3.57888 8.13559 3.57888C9.8631 3.57627 11.0339 4.41982 11.648 6.10821ZM8.01043 0C9.103 0 10.1382 0.20339 11.1121 0.610169C12.0834 1.02086 12.94 1.59583 13.6819 2.33768C14.425 3.07953 14.9987 3.93742 15.4094 4.90743C15.8162 5.88136 16.0196 6.91395 16.0196 8.00913C16.0196 9.44459 15.6584 10.7797 14.9374 12.0078C14.2164 13.2399 13.2412 14.2138 12.0143 14.9283C10.7862 15.6428 9.45111 15.9987 8.00913 15.9987C6.54498 15.9987 5.19948 15.6415 3.97914 14.9309C2.75489 14.2203 1.78357 13.249 1.0704 12.0183C0.357236 10.7914 0 9.45241 0 8.01043C0 6.56063 0.357236 5.21904 1.0704 3.99087C1.78488 2.7588 2.7588 1.78488 3.99087 1.0704C5.21903 0.357236 6.56063 0 8.01043 0ZM8.01043 1.57106C6.83181 1.57106 5.75098 1.8605 4.77314 2.43807C3.79531 3.01695 3.01695 3.79791 2.44198 4.78357C1.86701 5.77184 1.57757 6.84746 1.57757 8.01043C1.57757 9.18123 1.86701 10.2555 2.44198 11.2334C3.01695 12.2151 3.79531 12.9896 4.77705 13.5645C5.76271 14.1395 6.83703 14.4289 8.01173 14.4289C9.17601 14.4289 10.2503 14.1434 11.2425 13.5724C12.2308 13.0013 13.013 12.2269 13.588 11.2451C14.163 10.2673 14.4524 9.18905 14.4524 8.01043C14.4524 6.85398 14.163 5.77966 13.5854 4.79009C13.0065 3.80183 12.2256 3.01565 11.236 2.43807C10.249 1.8605 9.17471 1.57106 8.01043 1.57106Z" fill="black" fill-opacity="0.6"/>
            </g>
            <defs>
                <clipPath id="clip0_2961_1574">
                    <rect width="16.0209" height="16" fill="white"/>
                </clipPath>
            </defs>
        </svg>
        <span>Copyright {{ date('Y') }}. {{$words['website.copy']->translate(app()->getLocale())->title}}</span>
    </p>
    <p class="voen">{{$words['website.voen']->translate(app()->getLocale())->title}}</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="{{asset('front/index.js')}}"></script>
