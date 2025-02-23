// script.js - Handles event booking with AJAX

document.addEventListener("DOMContentLoaded", function () {
    const bookingButtons = document.querySelectorAll(".book-event");

    bookingButtons.forEach(button => {
        button.addEventListener("click", function () {
            let eventId = this.getAttribute("data-id");
            
            // Disable button to prevent multiple clicks
            this.disabled = true;
            this.textContent = "Booking...";

            fetch("book_event.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ event_id: eventId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Event booked successfully!");
                    location.reload();
                } else {
                    alert("Error: " + data.message);
                    if (data.message.includes("login")) {
                        window.location.href = "login.php";
                    }
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An unexpected error occurred. Please try again.");
            })
            .finally(() => {
                this.disabled = false;
                this.textContent = "Book Event";
            });
        });
    });
});
