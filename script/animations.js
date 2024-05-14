window.addEventListener('scroll', function() {
    var header = document.querySelector('.header-container');
    var scrollPosition = window.scrollY || document.documentElement.scrollTop;
    var headerHeight = header.offsetHeight;
  
    if (scrollPosition > headerHeight) {
      header.classList.add('header-sticky');
    } else {
      header.classList.remove('header-sticky');
    }
  });


document.addEventListener("DOMContentLoaded", function() {
    var scrollLink = document.querySelector('.scroll-to-landing');
  
    scrollLink.addEventListener('click', function(e) {
      e.preventDefault();
      var target = document.querySelector(this.getAttribute('href'));
      target.scrollIntoView({ behavior: 'smooth' });
    });
  });
  