function initMap() {
  var professionals = [
    { name: "Mario Rossi", category: "Idraulico", lat: 41.9028, lng: 12.4964, rating: 4.5 },
    { name: "Gianna Limone", category: "Colf", lat: 41.9050, lng: 12.5000, rating: 4.5 },
    { name: "Luigi Peloso", category: "Colf", lat: 41.9060, lng: 12.5050, rating: 4.5 }
  ];

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: { lat: 41.9028, lng: 12.4964 },
    styles: customStyle,
    streetViewControl: false,
    mapTypeControl: false
  });

  var openInfoWindow = null;
  var currentlySelectedProfessional = null;

  professionals.forEach(function (professional) {
    var marker = new google.maps.Marker({
      position: { lat: professional.lat, lng: professional.lng },
      map: map,
      title: professional.name,
      icon: { url: 'img/marker.png', scaledSize: new google.maps.Size(35, 35) }
    });

    var infoWindow = new google.maps.InfoWindow({
      content: '<h3>' + professional.name + '</h3><p>' + professional.category + '</p>'
    });

    marker.addListener('click', function () {
      if (openInfoWindow) openInfoWindow.close();
      if (currentlySelectedProfessional) currentlySelectedProfessional.classList.remove('professional-selected');
      
      var professionalElement = document.querySelector(`.worker-entry[data-name='${professional.name}']`);
      professionalElement.classList.add('professional-selected');
      currentlySelectedProfessional = professionalElement; // Update the currently selected element

      map.setCenter(marker.getPosition());
      infoWindow.open(map, marker);
      openInfoWindow = infoWindow;
      professionalElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });

    // Event listener to simulate a marker click when the corresponding professional element is clicked
    document.querySelector(`.worker-entry[data-name='${professional.name}']`).addEventListener('click', function () {
      google.maps.event.trigger(marker, 'click');
    });
  });
}

const customStyle = [/* Your Styles Here */];
