document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#contactForm"); // Use id for form selection

    form.addEventListener("submit", (event) => {
        event.preventDefault(); // Prevent actual form submission
        
        console.log("Form submission intercepted.");  // Debugging line to confirm form submission is intercepted
        
        const formData = new FormData(form);

        // Check if the form data is empty or not
        if (!formData.has('name') || !formData.has('email') || !formData.has('message')) {
            console.error('Form data is missing required fields');
            alert('Please fill out all the fields.');
            return;
        }

        fetch("info.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            console.log('Server Response:', data); // Log the server's response to the console
            alert(data); // Show response from the server
            form.reset(); // Reset form after submission
        })
        .catch(error => {
            console.error("Error:", error);
            alert("There was an error submitting your inquiry: " + error.message);
        });
    });
});
