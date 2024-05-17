document.addEventListener('DOMContentLoaded', function() {
    const addressInput = document.getElementById('address');
    const addressButton = document.querySelector('.address-submit');

    // Funzione per gestire la modifica dell'indirizzo
    function handleAddressChange() {
        const newAddress = addressInput.value.trim();
        if(newAddress) {
            fetch('utilities.php?action=updateAddress', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ address: newAddress })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    updateMap(data.lat, data.lng);
                    document.querySelector('.address').textContent = newAddress;
                } else {
                    console.error('Error updating address:', data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function updateMap(lat, lng) {
        const newPosition = { lat, lng };
        userMarker.setPosition(newPosition);
        map.setCenter(newPosition);
    }

    addressButton.addEventListener('click', function(event) {
        event.preventDefault();
        handleAddressChange();
    });

    fetch('utilities.php?action=getAddress')
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            addressInput.value = data.address;
            updateMap(data.lat, data.lng);
        } else {
            console.error('Failed to fetch address');
        }
    });
});
