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



document.addEventListener("DOMContentLoaded", function () {
  var professionalsContainer = document.querySelector('.professionals-container');
  var title = document.querySelector('.professionals-container-title');

  professionalsContainer.addEventListener('scroll', function () {
    if (professionalsContainer.scrollTop > 0) {
      title.classList.add('shadow-active');
    } else {
      title.classList.remove('shadow-active');
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  document.addEventListener('MapInitialized', function () {
    const professionistiButtons = document.querySelectorAll('.worker-menu .call-worker-button');

    professionistiButtons.forEach(button => {
      button.addEventListener('click', function () {
        const workerEntry = button.closest('.worker-entry');
        console.log(workerEntry.dataset);
        const nome = workerEntry.dataset.name;
        const professione = workerEntry.dataset.category;
        const prezzoOrario = workerEntry.dataset.hourprice;
        const prezzoCall = workerEntry.dataset.callprice; 
        const posizione = workerEntry.querySelector('.worker-position span').textContent;
        const img = workerEntry.dataset.img;

        // Nascondi la mappa
        const map = document.getElementById('map');
        map.classList.add('hidden');

        // Mostra i dettagli del professionista
        const dettagliContainer = document.getElementById('professional-details');
        document.getElementById('professional-image').src = `${img}`
        document.getElementById('professional-name').textContent = `${nome}`;
        document.getElementById('professional-category').textContent = `${professione}`;
        document.getElementById('professional-address').textContent = `${posizione}`;
        document.getElementById('professional-hour-price').textContent = `${prezzoOrario}`;
        document.getElementById('professional-call-price').textContent = `${prezzoCall}`;
        /*document.getElementById('professional-price').textContent = `${prezzoOrario}`;*/  


        dettagliContainer.classList.remove('hidden');
      });
    });
  });

});

function chiudiDettagli() {
  document.getElementById('map').classList.remove('hidden');  // Mostra nuovamente la mappa
  document.getElementById('professional-details').classList.add('hidden');
}

/* document.querySelectorAll('.increment-button').forEach(button => {
  button.addEventListener('click', function() {
      const input = this.parentNode.previousElementSibling;  
      input.value = parseInt(input.value) + 1; 
  });
});

document.querySelectorAll('.decrement-button').forEach(button => {
  button.addEventListener('click', function() {
      const input = this.parentNode.previousElementSibling; 
      if (parseInt(input.value) > 0) {
          input.value = parseInt(input.value) - 1;
      }
  });
});
 */