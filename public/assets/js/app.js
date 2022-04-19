$().ready(function () {
  $('.slick-carousel').slick({
    arrows: true,
    centerPadding: "0px",
    dots: true,
    slidesToShow: 1,
    infinite: false
  });

  $('.slick-prev').html(`<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M15.8337 10H4.16699" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10.0003 15.8346L4.16699 10.0013L10.0003 4.16797" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>`)
  $('.slick-next').html('<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4.16797 10H15.8346" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M10 4.16797L15.8333 10.0013L10 15.8346" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>')
});

$(function () {                       //run when the DOM is ready
  $(".img_dfts").click(function () {
    $(".img_dfts").removeClass("active")
    $(".img_dfts").children('h3').removeClass("active");
    $(".img_dfts").children('p').removeClass("active");

    $(this).addClass("active")
    $(this).children('h3').addClass("active");
    $(this).children('p').addClass("active");

    var index = $(this).index(".img_dfts")
    $('.kQrdDU').removeClass('active');
    $('.kQrdDU').eq(index).addClass('active');
  });


  $(".img_dfts2").click(function () {
    $(".img_dfts2").removeClass("active")
    $(".img_dfts2").children('h3').removeClass("active");
    $(".img_dfts2").children('p').removeClass("active");

    $(this).addClass("active")
    $(this).children('h3').addClass("active");
    $(this).children('p').addClass("active");

    var index = $(this).index(".img_dfts2")
    $('.kQrdDU2').removeClass('active');
    $('.kQrdDU2').eq(index).addClass('active');
  });
})





// NAVIGATION LOGO SCROLL TOP
$('.logo').on('click', function (e) {
  e.preventDefault();
  $('.nav-toggle').removeClass('open');
  $('.menu-left').removeClass('collapse');
  $('html, body').animate({
    scrollTop: 0
  }, 750, 'easeInOutQuad')
});
// LINKS TO ANCHORS
$('a[href^="#"]').on('click', function (event) {

  var $target = $(this.getAttribute('href'));

  if ($target.length) {
    event.preventDefault();
    $('html, body').stop().animate({
      scrollTop: $target.offset().top
    }, 750, 'easeInOutQuad');
  }
});

// TOGGLE HAMBURGER & COLLAPSE NAV


$('.nav-toggle').on('click', function () {
  $(this).toggleClass('open');
  $('body').toggleClass('mobile_active');

});


// REMOVE X & COLLAPSE NAV ON ON CLICK
$('.menu-left a').on('click', function () {
  $('.nav-toggle').removeClass('open');
  $('.menu-left').removeClass('collapse');
});

// SHOW/HIDE NAV

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function (event) {
  didScroll = true;
});

setInterval(function () {
  if (didScroll) {
    hasScrolled();
    didScroll = false;
  }
}, 250);

function hasScrolled() {
  var st = $(this).scrollTop();

  // Make sure they scroll more than delta
  if (Math.abs(lastScrollTop - st) <= delta)
    return;

  // If they scrolled down and are past the navbar, add class .nav-up.
  // This is necessary so you never see what is "behind" the navbar.
  if (st > lastScrollTop && st > navbarHeight) {
    // Scroll Down
    $('header').removeClass('show-nav').addClass('hide-nav');
    $('.nav-toggle').removeClass('open');
    $('.menu-left').removeClass('collapse');
  } else {
    // Scroll Up
    if (st + $(window).height() < $(document).height()) {
      $('header').removeClass('hide-nav').addClass('show-nav');
    }
  }

  lastScrollTop = st;
}