window.addEventListener('scroll', function() {
    var header = document.querySelector('.header');
    var scrollPosition = window.scrollY || document.documentElement.scrollTop;
    var headerHeight = header.offsetHeight;
  
    if (scrollPosition > headerHeight) {
      header.classList.add('header-sticky');
    } else {
      header.classList.remove('header-sticky');
    }
  });

  
  