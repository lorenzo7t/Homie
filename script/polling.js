function pollRequests() {
    fetch('requests.json')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Aggiorna l'UI con le nuove richieste
            updateUIWithRequests(data);
        })
        .catch(error => console.error('Error fetching requests:', error));
}

// Chiamata periodica della funzione pollRequests ogni 30 secondi
setInterval(pollRequests, 30000);

function updateUIWithRequests(requests) {
    const requestsContainer = document.getElementById('requests-container');
    requestsContainer.innerHTML = ''; // Pulisce i vecchi dati
    requests.forEach(request => {
        const requestElement = document.createElement('div');
        requestElement.textContent = `Richiesta da ${request.userId} - Stato: ${request.status}`;
        requestsContainer.appendChild(requestElement);
    });
}
