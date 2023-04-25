$(document).ready(function () {
  activeSidebarItem();

  function activeSidebarItem() {
    const path =
      location.pathname.slice(1).split("/").reverse()[0] || "index.php";
    document.querySelectorAll(".nav-link").forEach((item) => {
      if (item.getAttribute("href").split("/")[1] === path) {
        item.parentElement.classList.add("active");
      } else {
        item.parentElement.classList.remove("active");
      }
    });
  }

  $("body").delegate(".navbar-toggler", "click", function (event) {
    event.stopPropagation();
    $(".sidebar").addClass("active");
  });

  $(document).click(function () {
    $(".sidebar").removeClass("active");
  });
});
