window.onload = () => {
  setTimeout(() => {
    document.querySelector("body").classList.add("display");
  }, 1200);
};

$(document).on('mouseover', '.container .column', function() {
  $(this).addClass('active').siblings().removeClass('active')
})


$(window).scroll(function() {
    var scroll = $(window).scrollTop(),
    dh = $(document).height(),
    wh = $(window).height();
    scrollPercent = (scroll / (dh - wh)) * 100;
    $('#progressbar').css('height', scrollPercent + '%')
})

document.querySelector(".hamburger-menu").addEventListener("click", () => {
    document.querySelector(".container").classList.toggle("change");
  });

  document.querySelector(".scroll-btn").addEventListener("click", () => {
    document.querySelector("html").style.scrollBehavior = "smooth";
    setTimeout(() => {
      document.querySelector("html").style.scrollBehavior = "unset";
    }, 1500);
  });