<?php
// Start the session
@session_start();

// Include the database connection
include('../include/connect_db.php');

// Initialize variables to avoid undefined variable warnings
$user_id = $user_name = $user_email = $user_address = $user_city = $user_country = $user_zip = $user_mobile = $user_password = $user_image = $email_verified = $verification_code = "";

// Check if edit_account is set in the GET request
if (isset($_GET['edit_account'])) {
    // Retrieve the username from the session
    $username = $_SESSION["cmrName"];
    
    // Fetch user data from the database
    $select_query = "SELECT * FROM `tbl_customer` WHERE name = '$username'";
    $result_query = mysqli_query($conn, $select_query);
    
    // Check if the query was successful and fetch the result
    if ($result_query && mysqli_num_rows($result_query) > 0) {
        $row_query = mysqli_fetch_array($result_query);
        $user_id = $row_query['id'];
        $user_name = $row_query['name'];
        $user_email = $row_query['email'];
        $user_address = $row_query['address'];
        $user_city = $row_query['city'];
        $user_country = $row_query['country'];
        $user_zip = $row_query['zip'];
        $user_mobile = $row_query['phone'];
        $user_password = $row_query['pass'];
        $user_image = $row_query['user_image'];
        $email_verified = $row_query['email_verified'];
        $verification_code = $row_query['verification_code'];
    }
}

// Check if the update form is submitted
if (isset($_POST['user_update'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $user_password = $_POST['user_password'];
    $new_user_image = $_FILES['user_image']['name'];
    $new_user_image_temp = $_FILES['user_image']['tmp_name'];
    
    // Check if a new image is uploaded
    if (!empty($new_user_image)) {
        move_uploaded_file($new_user_image_temp, "./user_image/$new_user_image");
        $user_image = $new_user_image; // Update with the new image
    }

    // Update the user data in the database
    $update_query = "UPDATE `tbl_customer` SET 
        name = '$user_name', 
        email = '$user_email', 
        address = '$user_address', 
        phone = '$user_mobile', 
        pass = '$user_password', 
        user_image = '$user_image' 
        WHERE id = $user_id";

    $result_update = mysqli_query($conn, $update_query);

    // Show success or failure message
    if ($result_update) {
        echo "<script>alert('Account updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update account');</script>";
    }
}
?>


<style>
    .form-outline {
        position: relative;
    }

    .showPassword {
        position: absolute;
        top: 43%;
        transform: translateY(-50%);
        right: 15px;
        cursor: pointer;
    }

    .error-message {
        position: absolute;
        color: red;
        bottom: -6px;
        left: 0;
        font-size: 12px;
    }
</style>

<section class="edit-account">
    <div class="edit_form">
        <form id="editAccountForm" action="" method="post" enctype="multipart/form-data">
            <!-- Username input -->
            <div class="form-outline">
                <input type="text" class="form-input" id="user_name" value="<?php echo htmlspecialchars($user_name); ?>" name="user_name">
                <span id="usernameError" class="error-message"></span>
            </div>

            <!-- Email input -->
            <div class="form-outline">
                <input type="email" class="form-input" id="user_email" value="<?php echo htmlspecialchars($user_email); ?>" name="user_email">
                <span id="emailError" class="error-message"></span>
            </div>

            <!-- Password input -->
            <div class="form-outline">
                <input type="password" class="password form-input" id="user_password" value="<?php echo htmlspecialchars($user_password); ?>" name="user_password">
                <span id="passwordError" class="error-message"></span>
                
                <!-- <input type="checkbox" class="showPassword"> Show Password -->
            </div>

            <!-- Profile image upload -->
            <div class="form-outline mb-1">
                <input type="file" class="form-control" name="user_image">
                <img src='./user_image/<?php echo htmlspecialchars($user_image); ?>' alt='<?php echo htmlspecialchars($user_name); ?>'>
            </div>

            <!-- Address input -->
            <div class="form-outline">
                <input type="text" class="form-input" id="user_address" value="<?php echo htmlspecialchars($user_address); ?>" name="user_address">
                <span id="addressError" class="error-message"></span>
            </div>

            <!-- Mobile number input -->
            <div class="form-outline">
                <input type="text" class="form-input" id="user_mobile" value="<?php echo htmlspecialchars($user_mobile); ?>" name="user_mobile">
                <span id="contactError" class="error-message"></span>
            </div>

            <!-- Submit button -->
            <input type="submit" class="read-more btn" value="Update" name="user_update">
        </form>
    </div>
</section>
<script>

// Show/Hide Password
document.querySelectorAll('.showPassword').forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        const passwordField = checkbox.previousElementSibling;
        if (checkbox.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
});

// Client-side validation
function validateUsername() {
    const usernameInput = document.getElementById("user_name");
    const usernameError = document.getElementById("usernameError");
    if (usernameInput.value.trim().length < 3) {
        usernameError.textContent = "Username must be at least 3 characters long.";
        return false;
    } else {
        usernameError.textContent = "";
        return true;
    }
}

function validateEmail() {
    const emailInput = document.getElementById("user_email");
    const emailError = document.getElementById("emailError");
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
        emailError.textContent = "Enter a valid email address.";
        return false;
    } else {
        emailError.textContent = "";
        return true;
    }
}

function validatePassword() {
    const passwordInput = document.getElementById("user_password");
    const passwordError = document.getElementById("passwordError");
    if (passwordInput.value.trim().length < 6 || !/[A-Z]/.test(passwordInput.value) || !/[a-z]/.test(passwordInput.value) || !/\d/.test(passwordInput.value)) {
        passwordError.textContent = "Password must contain at least 1 lowercase, 1 uppercase, and 1 number, and be 6 characters long.";
        return false;
    } else {
        passwordError.textContent = "";
        return true;
    }
}

function validateAddress() {
    const addressInput = document.getElementById("user_address");
    const addressError = document.getElementById("addressError");
    if (addressInput.value.trim().length < 5) {
        addressError.textContent = "Address must be at least 5 characters long.";
        return false;
    } else {
        addressError.textContent = "";
        return true;
    }
}

function validateContact() {
    const contactInput = document.getElementById("user_mobile");
    const contactError = document.getElementById("contactError");
    const contactValue = contactInput.value.trim();

    if (contactValue.length !== 10 || isNaN(contactValue)) {
        contactError.textContent = "Enter a valid 10-digit phone number.";
        return false;
    } else {
        contactError.textContent = "";
        return true;
    }
}

document.getElementById("user_name").addEventListener("input", validateUsername);
document.getElementById("user_email").addEventListener("input", validateEmail);
document.getElementById("user_password").addEventListener("input", validatePassword);
document.getElementById("user_address").addEventListener("input", validateAddress);
document.getElementById("user_mobile").addEventListener("input", validateContact);

document.getElementById("editAccountForm").addEventListener("submit", function (event) {
    if (!validateUsername() || !validateEmail() || !validatePassword() || !validateAddress() || !validateContact()) {
        event.preventDefault();
    }
});
