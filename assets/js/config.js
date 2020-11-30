$(document).ready(function () {
  $("#alert_close").click(function () {
    $("#alert_box").fadeOut("slow", function () {});
  });

  $(".sidenav").sidenav();

  $(".fixed-action-btn").floatingActionButton();

  $("select").formSelect();

  $(".owl-carousel").owlCarousel({
    dots: false,
    loop: true,
    margin: 20,
    stagePadding: 50,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplaySpeed: 1000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      900: {
        items: 3,
      },
      1200: {
        items: 4,
      },
      1800: {
        items: 5,
      },
    },
  });
});
