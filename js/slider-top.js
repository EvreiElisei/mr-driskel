const slider = document.querySelector(".top-slider__inner");
const arrowLeft = document.querySelector(".swiper-button-prev");
const arrowRight = document.querySelector(".swiper-button-next");
const slides = document.querySelectorAll(".top-slide");
const bottom = document.querySelector(".swiper-pagination-bullets");

let swiperControl;
let swiperDelay = 4000;

let currentSlideIndex = 0;
const paginationCircle = [];
const sliderHeigth = slider.clientHeight;

function createPaginationCircle() {
  const span = document.createElement("span");
  span.className = "swiper-pagination-bullet";
  bottom.appendChild(span);
  paginationCircle.push(span);
}

function addPagination() {
  slides.forEach(createPaginationCircle);
  paginationCircle[0].classList.add("swiper-pagination-bullet-active");
  paginationCircle.forEach((circle, index) => {
    circle.addEventListener("click", () => {
      changeSlide(index);
      autoSwiperSuspend();
    });
  });
}

function addActiveClass() {
  paginationCircle[currentSlideIndex].classList.add(
    "swiper-pagination-bullet-active"
  );
}

function removeActiveClass() {
  paginationCircle[currentSlideIndex].classList.remove(
    "swiper-pagination-bullet-active"
  );
}
function showSlide() {
  slider.style.transform = `translateY(-${currentSlideIndex * sliderHeigth}px)`;
}

function changeSlide(slideIndex) {
  removeActiveClass();
  currentSlideIndex = slideIndex;
  addActiveClass();
  showSlide();
}

function nextSlide() {
  let newSlideIndex = currentSlideIndex + 1;
  if (newSlideIndex > slides.length - 1) {
    newSlideIndex = 0;
  }
  changeSlide(newSlideIndex);
}

function previousSlide() {
  let newSlideIndex = currentSlideIndex - 1;

  if (newSlideIndex < 0) {
    newSlideIndex = slides.length - 1;
  }
  changeSlide(newSlideIndex);
}

function autoSwipeStart() {
  swiperControl = setInterval(nextSlide, swiperDelay);
}
function autoSwiperSuspend() {
  clearInterval(swiperControl);
  setTimeout(autoSwipeStart, swiperDelay);
}
autoSwipeStart();
console.log(swiperControl);
addPagination();
arrowLeft.addEventListener("click", () => {
  previousSlide();
  autoSwiperSuspend();
});
arrowRight.addEventListener("click", () => {
  nextSlide();
  autoSwiperSuspend();
});
