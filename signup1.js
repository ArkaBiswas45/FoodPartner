document.getElementById('signup-form').addEventListener('submit', function(event) { 
    event.preventDefault(); // Prevent default form submission 
    var form = event.target; 
 
    var xhr = new XMLHttpRequest(); 
    xhr.open('POST', form.action, true); 
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
    xhr.onload = function() { 
        if (xhr.status === 200) { 
            // Redirect to signup2.html after successful submission 
            window.location.href = 'signup2.html'; 
        } else { 
            alert('An error occurred: ' + xhr.responseText); 
        } 
    }; 
    xhr.send(new URLSearchParams(new FormData(form)).toString()); 
});