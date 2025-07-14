document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contactForm');
    
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        validateForm();
    });

    function validateForm() {
        let isValid = true;
        
        // Clear previous error messages
        document.querySelectorAll('div[id*="Error"]').forEach((div) => {
            div.textContent = "";
        });

        // Validate Salutation
        const salutation = form['sal'].value.trim();
        if (salutation === "") {
            displayError('salError', "Please select your salutation.");
            isValid = false;
        }

        // Validate Name
        const name = form['name'].value.trim();
        if (name === "") {
            displayError('nameError', "Name is required.");
            isValid = false;
        }

        // Validate Email
        const email = form['email'].value.trim();
        const emailPattern = /\S+@\S+\.\S+/;
        if (email === "") {
            displayError('emailError', "Email is required.");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            displayError('emailError', "Please enter a valid email.");
            isValid = false;
        }

        // Validate Phone Number
        const phone = form['tel'].value.trim();
        if (phone === "") {
            displayError('telError', "Phone number is required.");
            isValid = false;
        }

        // Validate Enquiry Type (Checkbox)
        const enquiryCheckboxes = form.querySelectorAll('input[name="enquiry"]');
        const isEnquiryChecked = Array.from(enquiryCheckboxes).some(checkbox => checkbox.checked);
        if (!isEnquiryChecked) {
            displayError('enquiryError', "Please select at least one type of enquiry.");
            isValid = false;
        }

        // Validate Message
        const message = form['msg'].value.trim();
        if (message === "") {
            displayError('msgError', "Message is required.");
            isValid = false;
        }

        // Submit the form if everything is valid
        if (isValid) {
            form.submit();
        }
    }

    function displayError(elementId, message) {
        const errorDiv = document.getElementById(elementId);
        errorDiv.textContent = message;
        errorDiv.style.color = "red";
    }
});
