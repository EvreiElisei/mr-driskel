export function startSwiper() {
  var swiper = new Swiper(".goods__card-swiper", {
    pagination: {
      el: ".goods__card-swiper-pagination",
    },
  });
}
// var swiper_rev = new Swiper(".reviews__swiper", {
//   pagination: {
//     el: ".swiper-pagination",
//   },
//   initialSlide: 1,
//   slidesPerGroup: 2,
//   slidesPerView: 2,
//   spaceBetween: 20,
//   navigation: {
//     nextEl: ".swiper-button-next",
//     prevEl: ".swiper-button-prev",
//   },
// });

// var swiper_pop = new Swiper(".pop-brend__swiper", {
//   navigation: {
//     nextEl: ".pop-brend__button-next",
//     prevEl: ".pop-brend__button-prev",
//   },
// });
