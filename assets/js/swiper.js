import Swiper from 'swiper/bundle';
import { Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";

window.addEventListener("load", () => {
  if (document.querySelector(".single-zimmer") || document.querySelector(".single-suiten")) {

    const thumbs = new Swiper('.gallery-thumbs-swiper', {
      slidesPerView: 'auto',
      spaceBetween: 14,
      watchSlidesProgress: true,
    });

    new Swiper('.gallery-images-swiper', {
      slidesPerView: 1,
      loop: true,
      speed: 900,
      effect: 'slide',
      navigation: {
        nextEl: '.zimmer-suiten-nav-arrows .swiper-button-next',
        prevEl: '.zimmer-suiten-nav-arrows .swiper-button-prev',
      },
      thumbs: {
        swiper: thumbs,
      },
    });
  }

  if (document.querySelector(".single-bankette") || document.querySelector(".single-seminare")) {

    const thumbs = new Swiper('.gallery-thumbs-swiper-bs', {
      slidesPerView: 'auto',
      spaceBetween: 14,
      watchSlidesProgress: true,
    });

    new Swiper('.gallery-images-swiper-bs', {
      slidesPerView: 1,
      loop: true,
      speed: 900,
      effect: 'slide',
      navigation: {
        nextEl: '.bankette-seminare-nav-arrows .swiper-button-next',
        prevEl: '.bankette-seminare-nav-arrows .swiper-button-prev',
      },
      thumbs: {
        swiper: thumbs,
      },
    });
  }
  
  if (document.querySelector(".page-template-page-hotel")) {
  const el = document.querySelector("#testimonials-section .testimonials-swiper");
  if (!el) return;

  new Swiper(el, {
    modules: [Pagination],
    slidesPerView: 1,
    spaceBetween: 20,
    grabCursor: true,

    breakpoints: {
        768: {
        slidesPerView: 1.5,
        },
        1280: {
        slidesPerView: 2.2,
        spaceBetween: 28,
        },
    },
    navigation: {
    nextEl: "#testimonials-section .testimonials-next",
    prevEl: "#testimonials-section .testimonials-prev",
  },
  })
};

  if (document.querySelector(".page-template-page-region")) {
  const activitiesEl = document.querySelector(".activities-swiper");
  if (activitiesEl) {
    new Swiper(activitiesEl, {
      slidesPerView: 1,
      spaceBetween: 0,
      speed: 600,
      allowTouchMove: true,
      navigation: {
        nextEl: activitiesEl.querySelector(".activities-next"),
        prevEl: activitiesEl.querySelector(".activities-prev"),
      },
    });
  }

  const discoverEl = document.querySelector(".discover-swiper");
  if (discoverEl) {
    new Swiper(discoverEl, {
      slidesPerView: 1,
      spaceBetween: 0,
      speed: 600,
      allowTouchMove: true,
      navigation: {
        nextEl: discoverEl.querySelector(".discover-next"),
        prevEl: discoverEl.querySelector(".discover-prev"),
      },
    });
  }
}
});