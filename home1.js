document.addEventListener('DOMContentLoaded', function() {
    const profileImage = document.getElementById('profileImage');
    const profileInitial = document.getElementById('profileInitial');
    const logoutLink = document.querySelector('.profile-menu a[href="logout.html"]');
    
    // Fetch user data function
    function fetchUserData() {
        fetch('fetch_user_data.php')
            .then(response => response.json())
            .then(user => {
                if (user.loggedIn) {
                    if (user.profileImageUrl) {
                        profileImage.src = user.profileImageUrl;
                        profileImage.style.display = 'block';
                        profileInitial.style.display = 'none'; // Hide initials if image is displayed
                    } else {
                        const initial = user.firstname.charAt(0).toUpperCase();
                        profileInitial.textContent = initial;
                        profileInitial.style.display = 'flex';
                        profileImage.style.display = 'none'; // Hide image if initials are displayed
                    }
                } else {
                    // User is not logged in
                    profileImage.style.display = 'none';
                    profileInitial.style.display = 'none';
                }
            })
            .catch(error => console.error('Error fetching user data:', error));
    }

    // Initial fetch on page load
    fetchUserData();

    // Logout functionality
    logoutLink.addEventListener('click', function(event) {
        event.preventDefault();
        
        fetch('logout.php', {
            method: 'POST',
        })
        .then(response => response.json())
        .then(result => {
            if (result.loggedOut) {
                profileImage.style.display = 'none';
                profileInitial.style.display = 'none';
                // Optionally update UI or show message for logged out state
            } else {
                console.error('Logout unsuccessful:', result.error);
            }
        })
        .catch(error => console.error('Error during logout:', error));
    });
});
