var swiper = new Swiper(".reviews__swiper", {
	pagination: {
        el: ".swiper-pagination",
	},
	initialSlide: 1,
	slidesPerGroup: 2,
	slidesPerView: 2,
      spaceBetween: 20,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });