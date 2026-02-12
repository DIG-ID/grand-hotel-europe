import Swiper from 'swiper/bundle';
import {Pagination, Autoplay} from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";

window.addEventListener("load", () => {
  if (document.querySelector(".page-template-page-home")) {
    const travelslider = new Swiper('.travel-banner-swiper', {
      slidesPerView: 1,
      loop: true,
      speed: 900,
      effect: 'slide',
      navigation: {
        nextEl: '.travel-banner-nav-arrows .swiper-button-next',
        prevEl: '.travel-banner-nav-arrows .swiper-button-prev',
      },
      autoplay: {
        delay: 6000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
    });
  }

  if (document.querySelector(".single-zimmer") || document.querySelector(".single-suiten")) {

    // Get original image count from PHP
      const originalImageCount = window.galleryData ? window.galleryData.originalImageCount : 0;
      
      var thumbs = new Swiper('.gallery-thumbs-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 14,
        loop: true,
        loopedSlides: originalImageCount,
        centeredSlides: true,
        slideToClickedSlide: true,
        watchSlidesProgress: true,
      });

      var slider = new Swiper('.gallery-images-swiper', {
        slidesPerView: 1,
        loop: true,
        loopedSlides: originalImageCount,
        speed: 600,
        effect: 'slide',
        centeredSlides: true,
        navigation: {
          nextEl: '.zimmer-suiten-nav-arrows .swiper-button-next',
          prevEl: '.zimmer-suiten-nav-arrows .swiper-button-prev',
        },
        thumbs: {
          swiper: thumbs,
        },
        on: {
          init: function() {
            // Initialize thumbs sync
            if (this.thumbs && this.thumbs.swiper) {
              this.thumbs.swiper.update();
              // Start at a position where first image is centered
              this.thumbs.swiper.slideToLoop(this.realIndex, 0);
            }
          },
          slideChange: function() {
            // Sync thumbs on slide change
            if (this.thumbs && this.thumbs.swiper) {
              this.thumbs.swiper.slideToLoop(this.realIndex, 300);
            }
          }
        }
      });

      // Add click handlers for thumbnails
      if (originalImageCount > 0) {
        document.querySelectorAll('.gallery-thumbs-swiper .swiper-slide').forEach((slide) => {
          slide.addEventListener('click', function() {
            const originalIndex = parseInt(this.getAttribute('data-original-index'));
            // Navigate to the correct slide
            slider.slideToLoop(originalIndex);
          });
        });
      }
      
      // Force initial sync
      setTimeout(() => {
        if (slider && slider.thumbs && slider.thumbs.swiper) {
          slider.thumbs.swiper.update();
          slider.thumbs.swiper.slideToLoop(slider.realIndex, 0);
        }
      }, 100);
  }

  if (document.querySelector(".single-bankette") || document.querySelector(".single-seminare")) {

    const originalImageCount = window.galleryData ? window.galleryData.originalImageCount : 0;

    var thumbs = new Swiper('.gallery-thumbs-swiper-bs', {
      slidesPerView: 'auto',
      spaceBetween: 14,
      loop: true,
      loopedSlides: originalImageCount,
      centeredSlides: true,
      slideToClickedSlide: true,
      watchSlidesProgress: true,
    });

    var slider = new Swiper('.gallery-images-swiper-bs', {
      slidesPerView: 1,
      loop: true,
      loopedSlides: originalImageCount,
      speed: 600,
      effect: 'slide',
      centeredSlides: true,
      navigation: {
        nextEl: '.bankette-seminare-nav-arrows .swiper-button-next',
        prevEl: '.bankette-seminare-nav-arrows .swiper-button-prev',
      },
      thumbs: {
        swiper: thumbs,
      },
      on: {
        init: function() {
          if (this.thumbs && this.thumbs.swiper) {
            this.thumbs.swiper.update();
            this.thumbs.swiper.slideToLoop(this.realIndex, 0);
          }
        },
        slideChange: function() {
          if (this.thumbs && this.thumbs.swiper) {
            this.thumbs.swiper.slideToLoop(this.realIndex, 300);
          }
        }
      }
    });

    if (originalImageCount > 0) {
      document.querySelectorAll('.gallery-thumbs-swiper-bs .swiper-slide').forEach((slide) => {
        slide.addEventListener('click', function() {
          const originalIndex = parseInt(this.getAttribute('data-original-index'));
          slider.slideToLoop(originalIndex);
        });
      });
    }
    
    setTimeout(() => {
      if (slider && slider.thumbs && slider.thumbs.swiper) {
        slider.thumbs.swiper.update();
        slider.thumbs.swiper.slideToLoop(slider.realIndex, 0);
      }
    }, 100);

  }
 
  if (document.querySelector(".page-template-page-hotel")) {
    //slider testimonials
    const el = document.querySelector("#testimonials-section .testimonials-swiper");
    if (!el) return;

    new Swiper(el, {
      modules: [Pagination],
      slidesPerView: 1,
      spaceBetween: 20,
      grabCursor: true,
      breakpoints: {
        768: { slidesPerView: 1.5 },
        1280: { slidesPerView: 2.2, spaceBetween: 28 },
      },
      navigation: {
        nextEl: "#testimonials-section .testimonials-next",
        prevEl: "#testimonials-section .testimonials-prev",
      },
    });

    //slider intro
    const sliders = document.querySelectorAll(".intro-swiper");

    sliders.forEach((el) => {
      new Swiper(el, {
        modules: [Autoplay],
        slidesPerView: 1,
        loop: true,
        speed: 900,
        allowTouchMove: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
          pauseOnMouseEnter: true,
        },
      });
    });
  }


  if (document.querySelector(".page-template-page-region")) {
    const initScopedButtonsSwiper = ({
      sectionSelector,
      swiperSelector,
      nextSelector,
      prevSelector,
      datasetKey,
    }) => {
      const section = document.querySelector(sectionSelector);
      if (!section) return;

      const swiperEl = section.querySelector(swiperSelector);
      if (!swiperEl) return;

      const swiper = new Swiper(swiperEl, {
        slidesPerView: 1,
        spaceBetween: 0,
        speed: 600,
        allowTouchMove: true,
        loop: true,
        loopAdditionalSlides: 1,
      });

      const bindButtons = () => {
        const nextButtons = section.querySelectorAll(nextSelector);
        const prevButtons = section.querySelectorAll(prevSelector);

        nextButtons.forEach((btn) => {
          if (btn.dataset[datasetKey] === "1") return;
          btn.dataset[datasetKey] = "1";

          btn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            swiper.slideNext();
          });
        });

        prevButtons.forEach((btn) => {
          if (btn.dataset[datasetKey] === "1") return;
          btn.dataset[datasetKey] = "1";

          btn.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            swiper.slidePrev();
          });
        });
      };

      bindButtons();
      swiper.on("slideChange", bindButtons);

      return swiper;
    };

    initScopedButtonsSwiper({
      sectionSelector: "#activities-section",
      swiperSelector: ".activities-swiper",
      nextSelector: ".activities-next",
      prevSelector: ".activities-prev",
      datasetKey: "boundActivities",
    });

    initScopedButtonsSwiper({
      sectionSelector: "#discover-section",
      swiperSelector: ".discover-swiper",
      nextSelector: ".discover-next",
      prevSelector: ".discover-prev",
      datasetKey: "boundDiscover",
    });
  }
});
