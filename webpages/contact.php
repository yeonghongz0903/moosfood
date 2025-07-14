<?php

    include("../includes/templates/header.php");
    include("../includes/helper.php");
    require_login();

?>
 <link rel="stylesheet" href="http://localhost/moosfood/styles/contact.css">

    <h1>Stakeholder Intro Page</h1>
    <p> <strong>Moosfood</strong> is a fast-food restaurant specializing in chicken-based meals, offering a 
    diverse menu with affordable price. The company's executive and management team will be the main stakeholders
    of this company. They are responsible in strategic planning and operational oversight. Employees
    who are the customer service representive, are important for daily operations and maintaining quality 
    stardards. Customer will be the central stakeholders, as their preferences and satisfaction drive business
    sucess. Moreover, choosing the suppliers also very important which can maintaining the quality ingredients
    and vital to <strong>Moosfood</strong>'s ecosystem<p>
    


    <div id="contentWrapper" class="content">
    <h2>Complain section</h2>
    
    <form id="contactForm" action="./test.php" method="post" onsubmit="event.preventDefault()">

    <label for="sal">Salutation</label><br>
    <select id="sal" name="sal">
        <option disabled selected value> -- Select a Salutation -- </option>
        <option value="Mr">Mr</option>
        <option value="Ms">Ms</option>
        <option value="Mrs">Mrs</option>
        <option value="Mdm">Mdm</option>
    </select>
    <div id="salError"></div>
    <br>

    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name">
    <div id="nameError"></div>
    <br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email">
    <div id="emailError"></div>
    <br>
    <label for="tel">Phone Number:</label><br>
    <input type="tel" id="tel" name="tel">
    <div id="telError"></div>
    <br>

 Type of Enquiry:<br>
 <input type="checkbox" name="enquiry">Complaints
 <input type="checkbox" name="enquiry">Suggestion
 <div id="enquiryError"></div>
 <br>

 <label for="msg">Message:</label><br>
 <textarea id="msg" name="msg" rows="10", cols="50"></textarea><br>
 <div id="msgError"></div>

 <input type="submit" value="submit" onclick="validateForm()">
 </form>
</form>


    <h3>Contact</h3>
    <strong>Moosfood email:</strong> moosfood-business@gmail.com
    <br>
    <strong>Moosfood:</strong> 1000-555-888
    </p>

<?php include("../includes/templates/footer.php"); ?>
<script>

function validateForm() {
    let isValid = true;
    let form = document.getElementById("contactForm");

    document.querySelectorAll(`#contactForm div`).forEach((div) => {
        div.textContent = "";
    });

    if (form["sal"].value.trim()==="") {
        document.getElementById("salError").textContent = "Please select your salutation.";
        document.getElementById("salError").style.color = "red";
        isValid = false;
    }

    if (form["name"].value.trim()==="") {
        document.getElementById("nameError").textContent = "Name is required.";
        document.getElementById("nameError").style.color = "red";
        isValid = false;
    }

    if (form["email"].value.trim()==="") {
        document.getElementById("emailError").textContent = "Email is required.";
        document.getElementById("emailError").style.color = "red";
        isValid = false;
    }

    if (form["tel"].value.trim()==="") {
        document.getElementById("telError").textContent = "Phone number is required.";
        document.getElementById("telError").style.color = "red";
        isValid = false;
    }

    if (![...form["enquiry"]].some(checkbox => checkbox.checked)) {
        document.getElementById("enquiryError").textContent = "Please select at least one enquiry type.";
        document.getElementById("enquiryError").style.color = "red";
        isValid = false;
    }

    if (form["msg"].value.trim()==="") {
        document.getElementById("msgError").textContent = "Message is required.";
        document.getElementById("msgError").style.color = "red";
        isValid = false;
    }

    if (isValid) {
        form.submit();
    }
}

</script>

</body>
</html>