var markers = [];
var favoritesList = [1, 3];
var professionals = [];
var map;
var openInfoWindow;
var currentlySelectedProfessional;
var executed = false;
const customStyle =
[
  {
    "featureType": "all",
    "elementType": "all",
    "stylers": [
      {
        "saturation": "32"
      },
      {
        "lightness": "-3"
      },
      {
        "visibility": "on"
      },
      {
        "weight": "1.18"
      }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "landscape",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "landscape.man_made",
    "elementType": "all",
    "stylers": [
      {
        "saturation": "-70"
      },
      {
        "lightness": "14"
      }
    ]
  },
  {
    "featureType": "poi",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "all",
    "stylers": [
      {
        "saturation": "100"
      },
      {
        "lightness": "-14"
      }
    ]
  },
  {
    "featureType": "water",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      },
      {
        "lightness": "12"
      }
    ]
  }
];

function initMap(userLocation = { lat: 41.9028, lng: 12.4964 }) {
  console.log(userLocation)
  console.trace('Trace event handler calls');
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    styles: customStyle,
    center: { lat: userLocation.lat, lng: userLocation.lng },
    streetViewControl: false,
    mapTypeControl: false
  });

  var userMarker = new google.maps.Marker({
    position: { lat: userLocation.lat, lng: userLocation.lng },
    map: map,
    title: "La tua posizione",
    icon: { // Opzionale: icona personalizzata
      url: 'img/icons/house_pointer.png', // Percorso all'icona che vuoi usare
      scaledSize: new google.maps.Size(50, 50) // Dimensioni dell'icona
    }
  });

  openInfoWindow = null;
  currentlySelectedProfessional = null;



  professionals.forEach(professional => {
    var marker = new google.maps.Marker({
      position: { lat: professional.lat, lng: professional.lng },
      map: map,
      professional: professional,
      icon: { url: 'img/marker.png', scaledSize: new google.maps.Size(35, 35) }
    });

    var infoWindow = new google.maps.InfoWindow({
      content: `<h3>${professional.nome}</h3><p>${professional.professione}</p>`
    });

    marker.addListener('click', function () {
      if (openInfoWindow) openInfoWindow.close();
      if (currentlySelectedProfessional) currentlySelectedProfessional.classList.remove('professional-selected');
      var professionalElement = document.querySelector(`.worker-entry[data-name='${professional.nome}']`);
      professionalElement.classList.add('professional-selected');
      currentlySelectedProfessional = professionalElement;
      map.setCenter(marker.getPosition());
      infoWindow.open(map, marker);
      openInfoWindow = infoWindow;
      professionalElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
    document.querySelector(`.worker-entry[data-name='${professional.nome}']`).addEventListener('click', function () {
      google.maps.event.trigger(marker, 'click');
    });
    markers.push(marker);
  });
}

function populateProfessionalsList(professionalList) {
  console.log('propagating')
  const professionalsList = document.querySelector('.professionals-container ul');
  professionalsList.innerHTML = '';

  markers.forEach(marker => marker.setMap(null)); // Nascondi tutti i marker

  professionalList.forEach(professional => {
    const listItem = document.createElement('li');
    listItem.innerHTML = generateProfessionalHTML(professional);
    professionalsList.appendChild(listItem);

    const marker = markers.find(m => m.professional.piva === professional.piva);
    if (marker) {
      marker.setMap(map); // Rendi visibile il marker corrispondente
    }

    listItem.querySelector('.worker-entry').addEventListener('click', () => {
      google.maps.event.trigger(marker, 'click');
    });
  });
}


function generateProfessionalHTML(professional) {
  const isChecked = favoritesList.includes(professional.piva) ? 'checked' : '';
  return `<div class="worker-entry" data-lat="${professional.lat}" data-id="${professional.piva}" data-lng="${professional.lng}" data-name="${professional.nome}" data-category="${professional.professione}" data-rating="${professional.rating}">
              <div class="external-container">
                <div class="img-infos-container">
                    <div class="internal-container">
                        <img src="img/professionals/${professional.image}" alt="${professional.image.split(".")[0]}">
                        <div class="favourite">
                            <div class="heart-container" title="Like">
                            <input type="checkbox" class="checkbox" id="heart" ${isChecked}>
                            <div class="svg-container">
                                <svg viewBox="0 0 24 24" class="svg-outline" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                    </path>
                                </svg>
                                <svg viewBox="0 0 24 24" class="svg-filled" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                    </path>
                                </svg>
                                <svg class="svg-celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="10,10 20,20"></polygon>
                                    <polygon points="10,50 20,50"></polygon>
                                    <polygon points="20,80 30,70"></polygon>
                                    <polygon points="90,10 80,20"></polygon>
                                    <polygon points="90,50 80,50"></polygon>
                                    <polygon points="80,80 70,70"></polygon>
                                </svg>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="infos-container">
                        <div class="worker-info">
                            <span class="worker-name">${professional.nome}</span>
                            <span class="worker-category">${professional.professione}</span>

                            <div class="worker-price">
                                <div class="call-price">
                                    <svg fill="#457B9D" width="800px" height="800px" viewBox="0 0 36 36" version="1.1" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>phone-handset-solid</title>
                                        <path class="clr-i-solid clr-i-solid-path-1" d="M15.22,20.64a20.37,20.37,0,0,0,7.4,4.79l3.77-3a.67.67,0,0,1,.76,0l7,4.51a2,2,0,0,1,.33,3.18l-3.28,3.24a4,4,0,0,1-3.63,1.07,35.09,35.09,0,0,1-17.15-9A33.79,33.79,0,0,1,1.15,8.6a3.78,3.78,0,0,1,1.1-3.55l3.4-3.28a2,2,0,0,1,3.12.32L13.43,9a.63.63,0,0,1,0,.75l-3.07,3.69A19.75,19.75,0,0,0,15.22,20.64Z"></path>
                                        <rect x="0" y="0" width="36" height="36" fill-opacity="0" />
                                    </svg>
                                    <span>${professional.prezzo_chiamata}</span>
                                </div>
                                <div class="hour-price">
                                    <div class="separator-point">·</div>
                                    <span>${professional.prezzo_orario}</span>
                                </div>

                                <div class="hour-price-open">
                                    <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="9" stroke="#457B9D" stroke-width="2" />
                                        <path d="M16.5 12H12.25C12.1119 12 12 11.8881 12 11.75V8.5" stroke="#457B9D" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                    <span>${professional.prezzo_orario}</span>
                                </div>


                            </div>
                            <div class="worker-position">
                                <svg width="25px" height="25px" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 8.49478C8.604 8.49478 9.5 7.59934 9.5 6.49606C9.5 5.39278 8.604 4.49738 7.5 4.49738C6.396 4.49738 5.5 5.39278 5.5 6.49606C5.5 7.59934 6.396 8.49478 7.5 8.49478Z" stroke="#457B9D" stroke-linecap="square" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 6.49606C13.5 11.4928 8.5 14.4909 7.5 14.4909C6.5 14.4909 1.5 11.4928 1.5 6.49606C1.5 3.18522 4.187 0.5 7.5 0.5C10.813 0.5 13.5 3.18522 13.5 6.49606Z" stroke="#457B9D" stroke-linecap="square" />
                                </svg>
                                <span>${professional.position}</span>

                            </div>

                        </div>
                        <div class="worker-rating">
                            <span class="rating">${professional.rating}</span>
                            <svg fill="#E63946" width="22px" height="22px" id="star" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color">
                                <path id="primary" d="M22,9.81a1,1,0,0,0-.83-.69l-5.7-.78L12.88,3.53a1,1,0,0,0-1.76,0L8.57,8.34l-5.7.78a1,1,0,0,0-.82.69,1,1,0,0,0,.28,1l4.09,3.73-1,5.24A1,1,0,0,0,6.88,20.9L12,18.38l5.12,2.52a1,1,0,0,0,.44.1,1,1,0,0,0,1-1.18l-1-5.24,4.09-3.73A1,1,0,0,0,22,9.81Z" style="fill: #E63946"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="worker-menu">
                    <button class="call-worker-button">Richiedi</button>
                </div>
              </div>
            </div>`;
}

function toggleFavorites() {
  if (!executed) {
    console.trace('Trace event handler calls');
    console.log('Favorites toggle clicked');
    this.classList.toggle('active');
    let filteredProfessionals = professionals;

    const activeCategoryButton = document.querySelector('.category-button.active');
    if (activeCategoryButton) {
      const category = activeCategoryButton.getAttribute('data-category').toLowerCase();
      filteredProfessionals = filteredProfessionals.filter(p => p.professione.toLowerCase() === category);
    }

    if (this.classList.contains('active')) {
      filteredProfessionals = filteredProfessionals.filter(professional => favoritesList.includes(professional.piva));
    }

    console.log('Filtered professionals:', filteredProfessionals);
    populateProfessionalsList(filteredProfessionals);
    executed = true
  } else {
    executed = false
  }
}

function handleLocationError(hasGeolocation) {
  var errorText = hasGeolocation ? 'The Geolocation service failed.' : 'Your browser doesn\'t support geolocation.';
  console.error(errorText);
}

const favoritesToggleButton = document.querySelector('.favorites-toggle-button');
favoritesToggleButton.addEventListener('click', toggleFavorites);



document.addEventListener('DOMContentLoaded', function () {
  fetch('utilities.php?action=getProfessionals')
    .then(response => response.json())
    .then(data => {
      professionals = data;

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
          var userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          console.log('User location:', userLocation);

          populateProfessionalsList(professionals); // Popola la lista dei professionisti
          initMap(userLocation); // Inizializza la mappa con la posizione dell'utente
        }, function () {
          handleLocationError(true);
          populateProfessionalsList(professionals);
          initMap();
        });
      } else {
        handleLocationError(false);
        populateProfessionalsList(professionals);
        initMap();
      }
    })
    .catch(error => console.error('Error loading professionals:', error));
});



document.querySelectorAll('.category-button').forEach(button => {
  button.addEventListener('click', function () {
    const category = this.getAttribute('data-category').toLowerCase();
    let filteredProfessionals;

    if (this.classList.contains('active')) {
      this.classList.remove('active');
      filteredProfessionals = professionals; // Se disattivi la categoria, mostra tutti i professionisti.
    } else {
      document.querySelectorAll('.category-button').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      filteredProfessionals = professionals.filter(p => p.professione.toLowerCase() === category);
    }

    // Se il toggle dei preferiti è attivo, filtra ulteriormente per mostrare solo i preferiti nella categoria selezionata
    if (document.querySelector('.favorites-toggle-button').classList.contains('active')) {
      filteredProfessionals = filteredProfessionals.filter(p => favoritesList.includes(p.id));
    }

    populateProfessionalsList(filteredProfessionals);
  });
});








/* document.addEventListener('change', function (event) {
  if (event.target.matches('.heart-container .checkbox')) {
    const checkbox = event.target;
    const workerEntry = checkbox.closest('.worker-entry');
    const id = parseInt(workerEntry.dataset.id, 10);
    const index = favoritesList.indexOf(id);

    if (checkbox.checked) {
      if (index === -1) {
        favoritesList.push(id);
      }
    } else {
      if (index !== -1) {
        favoritesList.splice(index, 1);
      }
    }
  }
});
 */