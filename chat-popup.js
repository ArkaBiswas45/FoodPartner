// Open the chat popup
document.getElementById('openChat').addEventListener('click', function() {
    document.getElementById('chatPopup').style.display = 'block';
    // // Ensure the chat window is scrolled to the latest message when opened
    // let messageDisplay = document.getElementById('messageDisplay');
    // messageDisplay.scrollTop = messageDisplay.scrollHeight;
});

// Close the chat popup
document.getElementById('closeChat').addEventListener('click', function() {
    document.getElementById('chatPopup').style.display = 'none';
});
