async function fetchData(input) {
    try {
        const response = await fetch(`https://agile-tor-65735-062761b3f9d0.herokuapp.com/https://maps.googleapis.com/maps/api/place/autocomplete/json?input=${input}&language=it&components=country:it&key=AIzaSyAV2pCTErRiX6IWUu6Ol7gVE0U37rWWB_s`, {
            headers: {
            'Access-Control-Allow-Origin': '*'
            }
        });
        var data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
        return null;
    }
}

async function handleInputMain() {
    const inputField = document.getElementById('bigSearchInput'); 
    console.log(inputField.value);
    const userInput = inputField.value;

    const miniMap2 = document.getElementsByClassName("single-mini-map-container");

    for (let i = 0; i < miniMap2.length; i++) {
        miniMap2[i].classList.remove("single-mini-map-container-active");
    }


    const resultsContainer = document.getElementById('resultsContainer');

    if (userInput.length < 3){
        resultsContainer.innerHTML = ''; // Clear previous results
        resultsContainer.classList.remove("results-container-active")
        return;
    }

    const results = await fetchData(userInput);

    // Display results on the page
    if (results) {
        resultElement = document.createElement('ul');
        resultsContainer.innerHTML = ''; // Clear previous results
        resultsContainer.classList.add("results-container-active")
        
        if (results['predictions'].length == 0){
            const resultElement = document.createElement('li');
            resultElement.textContent = "Nessun risultato trovato";
            resultElement.className = "suggest-item light_text";
            resultElement.id = "no-results";
            resultsContainer.appendChild(resultElement);
        }

        for(let i in results['predictions']){
            const resultElement = document.createElement('li');
            resultElement.textContent = results['predictions'][i]['description'];
            resultElement.className = "suggest-item light_text";
            resultElement.addEventListener('click', function() {
                inputField.value = results['predictions'][i]['description'];
                resultsContainer.innerHTML = '';
                resultsContainer.classList.remove("results-container-active")

                const miniMap = document.getElementsByClassName("single-mini-map-container");

                var selectedCity = results['predictions'][i]['description'].split(",").reverse()[2].trim();
                console.log(selectedCity);
                if (["Roma", "Milano", "Napoli", "Torino"].includes(selectedCity)) {
                    for (let i = 0; i < miniMap.length; i++) {
                        console.log(miniMap[i].outerText);
                        if (miniMap[i].outerText.includes(selectedCity)) {
                            miniMap[i].classList.add("single-mini-map-container-active");
                        }
                    }
                }
                
            });
            resultsContainer.appendChild(resultElement);

        };
    }
}


async function handleInputB() {
    const inputField = document.getElementById('address'); 
    console.log(inputField.value);
    const userInput = inputField.value;


    const resultsContainer = document.getElementById('address-entries-container');

    if (userInput.length < 3){
        resultsContainer.innerHTML = ''; // Clear previous results
        resultsContainer.classList.remove("address-entries-container")
        return;
    }

    const results = await fetchData(userInput);

    // Display results on the page
    if (results) {
        resultElement = document.createElement('ul');
        resultsContainer.innerHTML = ''; // Clear previous results
        resultsContainer.classList.add("active")
        
        if (results['predictions'].length == 0){
            const resultElement = document.createElement('li');
            resultElement.textContent = "Nessun risultato trovato";
            resultElement.className = "entry";
            resultElement.id = "no-results";
            resultsContainer.appendChild(resultElement);
        }

        var cnt = 0;
        for(let i in results['predictions']){
            const resultElement = document.createElement('li');
            resultElement.textContent = results['predictions'][i]['description'];
            resultElement.className = "entry";
            resultElement.addEventListener('click', function() {
                inputField.value = results['predictions'][i]['description'];
                resultsContainer.innerHTML = '';
                resultsContainer.classList.remove("results-container-active")
            });
            if (cnt < 4){resultsContainer.appendChild(resultElement);}
            cnt++;
        };
    }
}


