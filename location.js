document.getElementById('searchInput').addEventListener('focus', () => {
    const buttonContainer = document.getElementById('buttonContainer');
    const buttons = buttonContainer.querySelectorAll('button');
    buttonContainer.classList.add('show');
    buttons.forEach(button => {
        button.style.display = 'block';
    });
});

document.getElementById('getLocationBtn').addEventListener('click', () => {
    const spinner = document.getElementById('spinner');
    spinner.style.display = 'block'; // Show spinner

    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                getPlaceName(latitude, longitude);
            },
            (error) => {
                spinner.style.display = 'none'; // Hide spinner on error
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert("User denied the request for Geolocation.");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert("Location information is unavailable.");
                        break;
                    case error.TIMEOUT:
                        alert("The request to get user location timed out.");
                        break;
                    case error.UNKNOWN_ERROR:
                        alert("An unknown error occurred.");
                        break;
                }
            }
        );
    } else {
        alert("Geolocation is not supported by this browser.");
        spinner.style.display = 'none'; // Hide spinner if geolocation is not supported
    }
});

document.getElementById('searchInput').addEventListener('focus', () => {
    const buttonContainer = document.getElementById('buttonContainer');
    buttonContainer.classList.add('show');
});



function getPlaceName(lat, lng) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const spinner = document.getElementById('spinner');
            spinner.style.display = 'none'; // Hide spinner after fetching data

            if (data && data.address) {
                const placeName = data.display_name;
                // Display place name in the search bar
                document.querySelector('.search input').value = placeName;
            } else {
                alert("Geocoding failed.");
            }
        })
        .catch(error => {
            const spinner = document.getElementById('spinner');
            spinner.style.display = 'none'; // Hide spinner on error
            console.error("Error fetching place name: ", error);
        });
}
