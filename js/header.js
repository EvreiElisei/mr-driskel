$(".catalog-window__top-select").on("click", changeCatalog);

function changeCatalog() {
  let buttonId = $(this).attr("data-js-class");
  switch (buttonId) {
    case "-js-category":
      $(".-js-category").addClass("-active");
      $(".-js-brand").removeClass("-active");
      break;
    case "-js-brand":
      $(".-js-brand").addClass("-active");
      $(".-js-category").removeClass("-active");
      break;
  }
}
