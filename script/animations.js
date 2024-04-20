

document.addEventListener("DOMContentLoaded", function() {
    var scrollLink = document.querySelector('.scroll-to-landing');
  
    scrollLink.addEventListener('click', function(e) {
      e.preventDefault();
      var target = document.querySelector(this.getAttribute('href'));
      target.scrollIntoView({ behavior: 'smooth' });
    });
  });
  