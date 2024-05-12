window.addEventListener('scroll', function () {
  var header = document.querySelector('.header-container');
  var scrollPosition = window.scrollY || document.documentElement.scrollTop;
  var headerHeight = header.offsetHeight;

  if (scrollPosition > headerHeight) {
    header.classList.add('header-sticky');
  } else {
    header.classList.remove('header-sticky');
  }
});


document.addEventListener("DOMContentLoaded", function () {
  var scrollLink = document.querySelector('.scroll-to-landing');

  scrollLink.addEventListener('click', function (e) {
    e.preventDefault();
    var target = document.querySelector(this.getAttribute('href'));
    target.scrollIntoView({ behavior: 'smooth' });
  });
});



document.addEventListener('DOMContentLoaded', function () {
  var userButton = document.querySelector('.user-button');
  var dropdownContent = document.querySelector('.dropdown-content');

  userButton.addEventListener('click', function (event) {
    dropdownContent.classList.toggle('show');
    userButton.classList.toggle('active'); // Aggiungi/rimuovi la classe 'active'
    event.stopPropagation();
  });

  document.addEventListener('click', function (event) {
    if (!dropdownContent.contains(event.target) && !userButton.contains(event.target)) {
      dropdownContent.classList.remove('show');
      userButton.classList.remove('active'); // Rimuovi la classe 'active'
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  var userButton = document.querySelector('.address-button');
  var dropdownContent = document.querySelector('.address-modify-dropdown');

  userButton.addEventListener('click', function (event) {
    dropdownContent.classList.toggle('show');
    userButton.classList.toggle('active'); // Aggiungi/rimuovi la classe 'active'
    event.stopPropagation();
  });

  document.addEventListener('click', function (event) {
    if (!dropdownContent.contains(event.target) && !userButton.contains(event.target)) {
      dropdownContent.classList.remove('show');
      userButton.classList.remove('active'); // Rimuovi la classe 'active'
    }
  });
});


document.addEventListener('DOMContentLoaded', function() {
  var categories = document.querySelectorAll('.category-button');

  categories.forEach(function(button) {
      button.addEventListener('click', function() {
          categories.forEach(b => {
              if (b !== button) b.classList.remove('active');
          });
          button.classList.toggle('active');
      });
  });
});



document.addEventListener("DOMContentLoaded", function() {
  var professionalsContainer = document.querySelector('.professionals-container');
  var title = document.querySelector('.professionals-container-title');

  professionalsContainer.addEventListener('scroll', function() {
      if (professionalsContainer.scrollTop > 0) {
          title.classList.add('shadow-active');
      } else {
          title.classList.remove('shadow-active');
      }
  });
});