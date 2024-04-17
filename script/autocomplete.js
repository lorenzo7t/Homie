// Function to fetch data from an API based on user input
async function fetchData(input) {
    try {
        const response = await fetch(`https://maps.googleapis.com/maps/api/place/autocomplete/json?input=${input}&language=it&components=country:it&key=AIzaSyAV2pCTErRiX6IWUu6Ol7gVE0U37rWWB_s`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
        return null;
    }
}

// Function to handle user input and display results
async function handleInput() {
    const inputField = document.getElementById('bigSearchInput'); // Replace 'inputField' with the ID of your HTML input field
    const userInput = inputField.value;

    // Fetch data based on user input
    const results = await fetchData(userInput);

    // Display results on the page
    if (results) {
        // Replace 'resultsContainer' with the ID of the HTML element where you want to display the results
        const resultsContainer = document.getElementById('resultsContainer');
        resultsContainer.innerHTML = ''; // Clear previous results

        results.forEach(result => {
            const resultElement = document.createElement('div');
            resultElement.textContent = result.title;
            resultsContainer.appendChild(resultElement);
        });
    }
}

// Attach event listener to the input field
const inputField = document.getElementById('inputField'); // Replace 'inputField' with the ID of your HTML input field
inputField.addEventListener('input', handleInput);