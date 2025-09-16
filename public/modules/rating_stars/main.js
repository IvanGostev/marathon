function hide(box, arr) {
  arr.forEach((element) => {
    element = box.children(".star").children(element);
    element.prop("checked", false);
    element
      .parent(".star")
      .children(".star-shape")
      .css("background-image", "url('/modules/rating_stars/img/star.svg')");
  });
}
function display(box, arr) {
  arr.forEach((element) => {
    element = box.children(".star").children(element);
    element.prop("checked", true);
    element
      .parent(".star")
      .children(".star-shape")
      .css("background-image", "url('/modules/rating_stars/img/star_gold.svg')");
  });
}



document.addEventListener("click", function (e) {
  e = $(e.target);
  if (e.hasClass("star-shape")) {
    id_active = e.parent(".star").children(".star-input").attr("id");
    if (id_active == "st-1") {
      hide(e.parent(".star").parent(".star-box"), ["#st-2", "#st-3"]);
      if (!e.parent(".star").children(".star-input").is(':checked')) {
        display(e.parent(".star").parent(".star-box"), ["#st-1"]);
      } else {
        hide(e.parent(".star").parent(".star-box"), ["#st-1"]);
      }
    } else if (id_active == "st-2") {
      hide(e.parent(".star").parent(".star-box"), ["#st-3"]);
      display(e.parent(".star").parent(".star-box"), ["#st-1", "#st-2"]);
    } else if (id_active == "st-3") {
      display(e.parent(".star").parent(".star-box"), [
        "#st-1",
        "#st-2",
        "#st-3",
      ]);
    }
  }
});
