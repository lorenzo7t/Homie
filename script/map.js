function initMap() {
  var professionals = [
    {
      name: "Mario Rossi",
      category: "Idraulico",
      lat: 41.9028,
      lng: 12.4964,
      rating: 4.5
    },
    {
      name: "Gianna Limone",
      category: "Colf",
      lat: 41.9050,
      lng: 12.5000,
      rating: 4.5
    },
    {
      name: "Luigi Peloso",
      category: "Colf",
      lat: 41.9060,
      lng: 12.5050,
      rating: 4.5
    }
  ];

  var markers = [];
  var currentlySelectedProfessional = null;

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


  var location = {
    lat: 41.9028,
    lng: 12.4964
  };
  var openInfoWindow = null

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: location,
    styles: customStyle,
    streetViewControl: false,
    mapTypeControl: false
  });

  // Itera su ogni professionista e crea marker e listener corrispondenti
  professionals.forEach(function (professional, index) {
    var marker = new google.maps.Marker({
      position: { lat: professional.lat, lng: professional.lng },
      map: map,
      title: professional.name,
      icon: {
        url: 'img/marker.png',
        scaledSize: new google.maps.Size(35, 35)
      }
    });

    var infoWindow = new google.maps.InfoWindow({
      content: '<h3>' + professional.name + '</h3><p>' + professional.category + '</p>'
    });
    var professionalElement = document.querySelector(`.worker-entry[data-name='${professional.name}']`);
    var professionalImage = document.querySelector(`.worker-entry[data-name='${professional.name}'] img`);
    var professionalInfo = document.querySelector(`.worker-entry[data-name='${professional.name}'] .worker-info`);
    var professionalName = document.querySelector(`.worker-entry[data-name='${professional.name}'] .worker-name`);
    var professionalMenu = document.querySelector(`.worker-entry[data-name='${professional.name}'] .worker-menu`);
    var professionalRating = document.querySelector(`.worker-entry[data-name='${professional.name}'] .worker-rating`);
    var professionalImgInfos = document.querySelector(`.worker-entry[data-name='${professional.name}'] .img-infos-container`);
    var professionalHourPrice = document.querySelector(`.worker-entry[data-name='${professional.name}'] .hour-price`);
    var professionalHourPriceOpen = document.querySelector(`.worker-entry[data-name='${professional.name}'] .hour-price-open`);
    var professionalWorkerPrice = document.querySelector(`.worker-entry[data-name='${professional.name}'] .worker-price`);
    // Aggiunta degli event listener
    marker.addListener('click', function () {

      if (currentlySelectedProfessional && currentlySelectedProfessional !== professionalElement) {
        currentlySelectedProfessional.classList.remove('professional-selected');
        currentlySelectedImage.classList.remove('selected-image');
        currentlySelectedInfo.classList.remove('selected-worker-info');
        currentlySelectedName.classList.remove('selected-worker-name');
        currentlySelectedRating.classList.remove('selected-worker-rating');
        currentlySelectedImgInfos.classList.remove('img-infos-column');
        currentlySelectedHourPrice.classList.remove('hidden');
        currentlySelectedHourPriceOpen.classList.add('hidden');
        currentlySelectedWorkerPrice.classList.remove('worker-price-selected');
        
        currentlySelectedMenu.classList.add('hidden');
      } 

      if (professionalElement) {
        professionalElement.classList.add('professional-selected');
        professionalImage.classList.add('selected-image');
        professionalInfo.classList.add('selected-worker-info');
        professionalName.classList.add('selected-worker-name');
        professionalRating.classList.add('selected-worker-rating');
        professionalImgInfos.classList.add('img-infos-column');

        professionalHourPrice.classList.add('hidden');
        professionalHourPriceOpen.classList.remove('hidden');
        professionalWorkerPrice.classList.add('worker-price-selected');

        professionalMenu.classList.remove('hidden');

        currentlySelectedProfessional = professionalElement; // Aggiorna l'elemento attualmente selezionato
        currentlySelectedImage = professionalImage;
        currentlySelectedInfo = professionalInfo;
        currentlySelectedName = professionalName;
        currentlySelectedMenu = professionalMenu;
        currentlySelectedRating = professionalRating;
        currentlySelectedImgInfos = professionalImgInfos;
        currentlySelectedHourPrice = professionalHourPrice;
        currentlySelectedHourPriceOpen = professionalHourPriceOpen;
        currentlySelectedWorkerPrice = professionalWorkerPrice;
        professionalElement.scrollIntoView({ behavior: 'smooth', block: 'nearest',align:'true' });

      }

      // Gestisci l'Info Window
      if (openInfoWindow) {
        openInfoWindow.close();
      }
      map.setCenter(marker.getPosition());
      infoWindow.open(map, marker);
      openInfoWindow = infoWindow;
    });

    professionalElement.addEventListener('click', function () {
      google.maps.event.trigger(marker, 'click');
    });

    markers.push(marker);
  });




}


