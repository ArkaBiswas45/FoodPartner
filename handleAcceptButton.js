document.addEventListener('DOMContentLoaded', () => {
    // Attach event listener to all accept buttons
    document.querySelectorAll('.accept-button').forEach(button => {
        button.addEventListener('click', function () {
            const msgId = this.getAttribute('data-msg-id');

            // Send AJAX request to update accept_status
            fetch('update_accept_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `msg_id=${msgId}&accept_status=1`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert("Message accepted successfully!");
                        // Reload the page to reflect the change
                        location.reload();  // This will refresh the page
                    } else {
                        alert("Failed to accept message: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
});
