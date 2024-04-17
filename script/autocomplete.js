// Function to fetch data from an API based on user input
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

// Function to handle user input and display results
async function handleInput() {
    const inputField = document.getElementById('bigSearchInput'); // Replace 'inputField' with the ID of your HTML input field
    console.log(inputField.value);
    const userInput = inputField.value;

    // Fetch data based on user input
    const resultsContainer = document.getElementById('resultsContainer');
    resultsContainer.classList.add("results-container-active")

    if (userInput.length < 3){
        resultsContainer.innerHTML = ''; // Clear previous results
        return;
    }

    const results = await fetchData(userInput);

    // Display results on the page
    if (results) {
        resultsContainer.innerHTML = ''; // Clear previous results
        // Replace 'resultsContainer' with the ID of the HTML element where you want to display the results
        resultsContainer.classList.add("results-container-active")
        
        if (results['predictions'].length == 0){
            const resultElement = document.createElement('div');
            resultElement.textContent = "Nessun risultato trovato";
            resultElement.className = "suggest-item light_text";
            resultElement.id = "no-results";
            resultsContainer.appendChild(resultElement);
        }

        for(let i in results['predictions']){
            console.log(results['predictions'][i]['description']);
            const resultElement = document.createElement('div');
            resultElement.textContent = results['predictions'][i]['description'];
            resultElement.className = "suggest-item light_text";
            resultsContainer.appendChild(resultElement);
        };
    }
}

// Attach event listener to the input field
const inputField = document.getElementById('inputField'); // Replace 'inputField' with the ID of your HTML input field
inputField.addEventListener('input', handleInput);