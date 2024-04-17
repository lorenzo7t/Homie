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
    const results = await fetchData(userInput);

    // Display results on the page
    if (results) {
        console.log(results);
        // Replace 'resultsContainer' with the ID of the HTML element where you want to display the results
        const resultsContainer = document.getElementById('resultsContainer');
        resultsContainer.innerHTML = ''; // Clear previous results
        
        for(let i in results['predictions']){
            console.log(results['predictions'][i]['description']);
            const resultElement = document.createElement('div');
            resultElement.textContent = results['predictions'][i]['description'];
            resultsContainer.appendChild(resultElement);
        };
    }
}

// Attach event listener to the input field
const inputField = document.getElementById('inputField'); // Replace 'inputField' with the ID of your HTML input field
inputField.addEventListener('input', handleInput);