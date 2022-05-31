// DEMOS: https://swiperjs.com/demos

if (document.querySelector('.mySwiper')) {
  const desktopSwiper = new Swiper(".mySwiper", {
    centeredSlides: true,
    loop: true,
    // effect: "fade",

    // effect: "flip",

    // ______________________________ //
    // effect: "cube",
    // cubeEffect: {
    //   shadow: true,
    //   slideShadows: true,
    //   shadowOffset: 20,
    //   shadowScale: 0.94,
    // },
    // ______________________________ //

    // ______________________________ //
    // effect: "creative",
    // creativeEffect: {
    //   prev: {
    //     shadow: true,
    //     translate: ["-20%", 0, -1],
    //   },
    //   next: {
    //     translate: ["100%", 0, 0],
    //   },
    // },
    // ______________________________ //


    // ______________________________ //
    // effect: "coverflow",
    // centeredSlides: true,
    // slidesPerView: "auto",
    // coverflowEffect: {
    //   rotate: 50,
    //   stretch: 0,
    //   depth: 100,
    //   modifier: 1,
    //   slideShadows: true,
    // },
    // ______________________________ //

    speed: 600,
    parallax: true,

    loopFillGroupWithBlank: false,
    // direction: "vertical",
    direction: "horizontal",
    autoplay: {
      delay: 5000,
      disableOnInteraction: true, // transitions stops after next/previous
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
}


// ______________________________ //
if (document.querySelector('.holidaySwiper')) {
  const holidayHeader = new Swiper(".holidaySwiper", {
    centeredSlides: true,
    loop: true,
    // effect: "fade",

    // effect: "flip",

    // ______________________________ //
    // effect: "cube",
    // cubeEffect: {
    //   shadow: true,
    //   slideShadows: true,
    //   shadowOffset: 20,
    //   shadowScale: 0.94,
    // },
    // ______________________________ //

    // ______________________________ //
    // effect: "creative",
    // creativeEffect: {
    //   prev: {
    //     shadow: true,
    //     translate: ["-20%", 0, -1],
    //   },
    //   next: {
    //     translate: ["100%", 0, 0],
    //   },
    // },
    // ______________________________ //


    // ______________________________ //
    // effect: "coverflow",
    // centeredSlides: true,
    // slidesPerView: "auto",
    // coverflowEffect: {
    //   rotate: 50,
    //   stretch: 0,
    //   depth: 100,
    //   modifier: 1,
    //   slideShadows: true,
    // },
    // ______________________________ //

    speed: 600,
    parallax: true,

    loopFillGroupWithBlank: false,
    // direction: "vertical",
    direction: "horizontal",
    autoplay: {
      delay: 5000,
      disableOnInteraction: true, // transitions stops after next/previous
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
}
// ______________________________ //