// Seleziona l'elemento input field
const inputField = document.querySelector('#bigSearchInput');

// Seleziona tutti gli elementi con la classe "single-mini-map-container"
const mapContainers = document.querySelectorAll('.single-mini-map-container');

// Aggiungi un listener di clic a ciascun elemento
mapContainers.forEach(container => {
    container.addEventListener('click', () => {
        // Ottieni il testo del paragrafo contenuto nell'elemento cliccato
        const paragraphText = container.querySelector('p').title;

        // Imposta il testo nell'input field
        inputField.value = paragraphText;
        const miniMap2 = document.getElementsByClassName("single-mini-map-container");

        for (let i = 0; i < miniMap2.length; i++) {
            miniMap2[i].classList.remove("single-mini-map-container-active");
        }

        // Aggiungi la classe "single-mini-map-container-active" all'elemento cliccato
        container.classList.add('single-mini-map-container-active');

    });
});

