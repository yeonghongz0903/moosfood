document.addEventListener('DOMContentLoaded', function () {
    // Example: Basic form validation
    document.querySelector('form').addEventListener('submit', function (event) {
        let fullName = document.getElementById('full_name').value.trim();
        let streetAddress = document.getElementById('street_address').value.trim();
        let townCity = document.getElementById('town_city').value.trim();
        let phoneNumber = document.getElementById('phone_number').value.trim();
        let email = document.getElementById('email').value.trim();

        if (!fullName || !streetAddress || !townCity || !phoneNumber || !email) {
            alert('Please fill out all required fields.');
            event.preventDefault(); // Prevent form submission
        }
    });

    // Example: Apply coupon logic
    document.querySelector('.coupon button').addEventListener('click', function () {
        let couponCode = document.getElementById('coupon').value.trim();
        if (couponCode === 'Deal30') {
            alert('Coupon applied successfully! 30% off your order.');
            // Update total here...
        } else {
            alert('Invalid coupon code.');
        }
    });
});
