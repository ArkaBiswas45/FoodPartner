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
                body: `msg_id=${msgId}`,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert("Message request accepted.");
                        button.parentElement.parentElement.remove(); // Remove the message request from the list
                        
                    } else {
                        alert("Failed to accept the message request.");
                    }
                })
                .catch((error) => console.error("Error:", error));
        });
    });
});
