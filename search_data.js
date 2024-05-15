// Function to fetch the data from data.json file
async function fetchData() {
    try {
        const response = await fetch('data.json');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// Function to perform search
async function searchBooks() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const data = await fetchData();
    
    if (!data) return;

    const searchResults = data.filter(book => {
        const title = book.title.toLowerCase();
        const author = book.author.toLowerCase();
        return title.includes(searchInput) || author.includes(searchInput);
    });

    // Display search results
    displaySearchResults(searchResults);
}

// Function to display search results
function displaySearchResults(results) {
    const resultsContainer = document.getElementById('searchResults');
    resultsContainer.innerHTML = '';

    results.forEach(book => {
        const title = document.createElement('p');
        title.textContent = `Title: ${book.title}, Author: ${book.author}`;
        resultsContainer.appendChild(title);
    });
}

// Event listener for Enter key press
document.getElementById('searchInput').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        searchBooks();
    }
});
