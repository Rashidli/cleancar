const hamburgerMenu=document.querySelector('.hamgurgerMenu')
const closeMenu=document.querySelector('.closeMenu')
const navLinks=document.querySelector('.nav-menu-items')
hamburgerMenu.addEventListener('click', function(){
    navLinks.style.right='0'
})
closeMenu.addEventListener('click', function(){
    navLinks.style.right='-100%'
})

var swiper = new Swiper(".home-hero-Slider", {
    slidesPerView: 1,
    // autoplay: {
    //     delay: 2000,
    // },
    speed:2000,
});
var swiper = new Swiper(".service-Slide", {
    slidesPerView: 3.5,
    spaceBetween: 24,
    autoplay: {
        delay: 2000,
    },
    speed:2000,
    breakpoints: {
         850: {
           slidesPerView: 3.5,
        },
        650: {
            slidesPerView: 3,
        },
        550: {
            slidesPerView: 2.5,
        },
        480: {
            slidesPerView: 2,
        },
        0: {
            slidesPerView: 1.4,
        }
    }
});
var swiper = new Swiper(".advantages-tags-Slider", {
    loop:true,
    slidesPerView: 4.5,
    spaceBetween: 32,
    autoplay: {
        delay: 0,
    },
    speed:2800,
    breakpoints: {
       1024: {
        spaceBetween: 32,
       },
       768: {
        spaceBetween: 24,
       },
       0: {
        spaceBetween: 16,
       }
   }
});
var swiper = new Swiper(".offer-Slide", {
    slidesPerView: 4,
    spaceBetween: 24,
    autoplay: {
        delay: 2000,
    },
    speed:2000,
    breakpoints: {
        1700: {
            slidesPerView: 4,
        },
        850: {
           slidesPerView: 3.5,
        },
        650: {
            slidesPerView: 3,
        },
        550: {
            slidesPerView: 2.5,
        },
        480: {
            slidesPerView: 2,
        },
        0: {
            slidesPerView: 1.4,
        }
    }
});
var swiper = new Swiper(".blog-Slide", {
    loop:true,
    slidesPerView: 4,
    spaceBetween: 24,
    autoplay: {
        delay: 2000,
    },
    speed:2000,
    breakpoints: {
        1700: {
            slidesPerView: 4,
        },
        1100: {
           slidesPerView: 3,
        },
        800: {
            slidesPerView: 2.7,
        },
        600: {
            slidesPerView: 2.4,
        },
        500: {
            slidesPerView: 2,
        },
        400: {
            slidesPerView: 1.3,
        },
        0: {
            slidesPerView: 1.1,
        },
       
    }
});