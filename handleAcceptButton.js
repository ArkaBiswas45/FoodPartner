document.addEventListener("DOMContentLoaded", () => {
    const acceptButtons = document.querySelectorAll(".accept-button");

    acceptButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const msgId = button.getAttribute("data-msg-id");

            // Send AJAX request to update accept_status
            fetch("update_accept_status.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `msg_id=${msgId}&accept_status=1`, // Ensure accept_status is sent
            })
                .then((response) => {
                    if (!response.ok) {
                        // If the response is not OK (e.g., 500, 404), throw an error
                        return response.text().then((text) => {
                            throw new Error(`HTTP ${response.status}: ${text}`);
                        });
                    }
                    return response.json(); // Parse JSON for a successful response
                })
                .then((data) => {
                    if (data.status === "success") {
                        alert("Message request accepted.");
                        button.parentElement.parentElement.remove(); // Remove the message request from the list
                    } else {
                        // Show server's error message if any
                        alert(`Failed to accept the message request: ${data.message}`);
                    }
                })
                .catch((error) => {
                    // Catch and display any errors
                    alert(`An error occurred: ${error.message}`);
                    console.error("Error:", error);
                });
        });
    });
});
