(function($) {
    // Handler function for the PokeAPI widget
    const pokeapiWidgetHandle = function($scope, $) {
        // Fetch the first 10 Pokemon from the PokeAPI
        fetch('https://pokeapi.co/api/v2/pokemon?limit=10')
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            // Select the UL element where Pokemon will be listed
            const ul = document.querySelector('.pokeapi-container #pokelist');
            // Iterate over each Pokemon in the results
            data.results.forEach(pokemon => {
                // Fetch details for each individual Pokemon
                fetch(pokemon.url)
                .then(response => response.json()) // Parse the JSON response
                .then(singleData => {
                    // Create elements for displaying Pokemon details
                    const li = document.createElement('li');
                    const card = document.createElement('div');
                    const name = document.createElement('h2');
                    const image = document.createElement('img');
                    // Append elements to build the structure
                    li.appendChild(card);
                    card.appendChild(name);
                    card.appendChild(image);
                    // Set the content for name and image
                    name.textContent = pokemon.name;
                    image.setAttribute('src', singleData.sprites.front_default);
                    // Append the list item to the UL element
                    ul.appendChild(li);
                });
            });
        });
    };
    // Listen for the Elementor frontend initialization event
    $(window).on('elementor/frontend/init', function() {
        // Add action hook for when the PokeAPI widget is ready
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/pokeapi-widget.default', 
            pokeapiWidgetHandle // Attach the handler function
        );
    });
})(jQuery);