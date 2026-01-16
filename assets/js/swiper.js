import Swiper from 'swiper/bundle';

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
});
