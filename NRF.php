<?php
session_start(); // Start the session

$errors = [];
$name = $email = $facebook = $password = $conpassword = $contact = $gender = $country = $bio = "";
$skills = [];

if ($_SERVER["REQUEST_METHOD"] === "post") {
    if (empty($_POST['Name'])) {
        $errors['Name'] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST['Name'])) {
        $errors['Name'] = "Only letters and spaces are allowed.";
    } else {
        $name = htmlspecialchars(trim($_POST['name']));
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    } else {
        $email = htmlspecialchars(trim($_POST['email']));
    }

    if (empty($_POST['facebook'])) {
        $errors['facebook'] = "Facebook URL is required.";
    } elseif (!filter_var($_POST['facebook'], FILTER_VALIDATE_URL)) {
        $errors['facebook'] = "Invalid URL format.";
    } else {
        $facebook = htmlspecialchars(trim($_POST['facebook']));
    }

    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($_POST['password']) < 8 || !preg_match('/[A-Z]/', $_POST['password']) || !preg_match('/[0-9]/', $_POST['password'])) {
        $errors['password'] = "Password must be at least 8 characters long, include at least 1 uppercase letter, and contain both letters and numbers.";
    } else {
        $password = $_POST['password']; 
    }

    if (empty($_POST['conpassword'])) {
        $errors['confirmPassword'] = "Confirm Password is required.";
    } elseif ($_POST['conpassword'] !== $password) {
        $errors['confirmPassword'] = "Passwords do not match.";
    }

    if (empty($_POST['contact'])) {
        $errors['contact'] = "Phone number is required.";
    } elseif (!ctype_digit($_POST['contact'])) {
        $errors['contact'] = "Phone number must be a valid number.";
    } else {
        $contact = htmlspecialchars(trim($_POST['contact']));
    }

    if (empty($_POST['gender'])) {
        $errors['gender'] = "Gender is required.";
    } else {
        $gender = htmlspecialchars(trim($_POST['gender']));
    }

    if (empty($_POST['country'])) {
        $errors['country'] = "Country is required.";
    } else {
        $country = htmlspecialchars(trim($_POST['country']));
    }

    if (empty($_POST['skills'])) {
        $errors['skills'] = "At least one skill must be selected.";
    } else {
        $skills = $_POST['skills'];
    }

    if (empty($_POST['bio'])) {
        $errors['bio'] = "Biography is required.";
    } elseif (strlen($_POST['bio']) > 200) {
        $errors['bio'] = "Biography must be less than 200 characters.";
    } else {
        $bio = htmlspecialchars(trim($_POST['bio']));
    }
if (empty($errors)) {
$_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['facebook'] = $facebook;
        $_SESSION['contact'] = $contact;
        $_SESSION['gender'] = $gender;
        $_SESSION['country'] = $country;
        $_SESSION['skills'] = $skills;
        $_SESSION['bio'] = $bio;

        header("Location: about.php"); 
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <form method="post" action="">
<div class="container mt-5">
    <div class="form-container">
    <h2 class="text-center mb-4">Registration Form</h2>
    <form method="post" action="">
<div class="mb-3">
    <label for="name" class="form-label">Name:</label>
    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($name ?? ''); ?>">
    <div class="error">
        <?php echo $errors['name'] ?? ''; ?>
    </div>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email:</label>
    <input type="text" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email ?? ''); ?>">
    <div class="error">
        <?php echo $errors['email'] ?? ''; ?>
    </div>
</div>
<div class="mb-3">
    <label for="facebook" class="form-label">Facebook URL:</label>
    <input type="text" id="facebook" name="facebook" class="form-control" value="<?php echo htmlspecialchars($facebook ?? ''); ?>">
    <div class="error">
        <?php echo $errors['facebook'] ?? ''; ?>
    </div>
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password:</label>
    <input type="password" id="password" name="password" class="form-control">
    <div class="error">
        <?php echo $errors['password'] ?? ''; ?>
    </div>
</div>
<div class="mb-3">
    <label for="conpassword" class="form-label">Confirm Password:</label>
    <input type="password" id="conpassword" name="conpassword" class="form-control">
    <div class="error">
        <?php echo $errors['confirmPassword'] ?? ''; ?>
    </div>
</div>                
<div class="mb-3">
    <label for="contact" class="form-label">Phone number:</label>
    <input type="text" id="contact" name="contact" class="form-control" value="<?php echo htmlspecialchars($phone ?? ''); ?>">
    <div class="error">
        <?php echo $errors['contact'] ?? ''; ?>
    </div>
 </div>
<div class="mb-3" id="gender">
    <label class="form-label">Gender:</label><br>
    <input type="radio" id="male" name="gender" value="male"> Male
    <input type="radio" id="female" name="gender" value="female"> Female
    <div class="error">
        <?php echo $errors['gender'] ?? ''; ?>
    </div>
</div>
<div class="mb-3">
    <label for="country" class="form-label">Country:</label>
<select name="country" id="country" class="form-select">
<option value="">Select a country</option>
            <option value="usa">United States of America</option>
            <option value="ph">Philippines</option>
            <option value="canada">Canada</option>
            <option value="uk">United Kingdom</option>
            <option value="austrtalia">Australia</option>
            <option value="india">India</option>
            <option value="germany">Germany</option>
            <option value="france">France</option>
            <option value="japan">Japan</option>
            <option value="brazil">Brazil</option>
            <option value="italy">Italy</option>
            <option value="mexico">Mexico</option>
            <option value="spain">Spain</option>
            <option value="RU">Russia</option>
            <option value="china">China</option>
            <option value="south korea">South Korea</option>
            <option value="south africa">South Africa</option>
            <option value="nigeria">Nigeria</option>
            <option value="argentina">Argentina</option>
            <option value="singapore">Singapore</option>
            <option value="sweden">Sweden</option>
            <option value="norway">Norway</option>
            <option value="finland">Finland</option>
            <option value="netherland">Netherlands</option>
            <option value="switzerland">Switzerland</option>
            <option value="belgium">Belgium</option>
            <option value="austria">Austria</option>
            <option value="denmark">Denmark</option>
            <option value="ireland">Ireland</option>
            <option value="portugal">Portugal</option>
            <option value="iceland">Iceland</option>
            <option value="turkey">Turkey</option>
            <option value="thailand">Thailand</option>
            <option value="vietnam">Vietnam</option>
            <option value="malaysia">Malaysia</option>
            <option value="new zealand">New Zealand</option>
            <option value="sri lanka">Sri Lanka</option>
            <option value="egypt">Egypt</option>
            <option value="qatar">Qatar</option>
            <option value="united arab emirates">United Arab Emirates</option>
</select>
<div class="error">
    <?php echo $errors['country'] ?? ''; ?>
</div>
</div>
<div class="mb-3">
    <label class="form-label">Skills:</label><br>
    <input type="checkbox" name="skills" value="eating"> Eating
    <input type="checkbox" name="skills" value="coding"> Coding
    <input type="checkbox" name="skills" value="hardware maintenance"> Hardware Maintenance
    <input type="checkbox" name="skills" value="sleeping"> Sleeping
    <input type="checkbox" name="skills" value="singing">Singing
    <input type="checkbox" name="skills" value="dancer">Dancer
    <div class="error">
        <?php echo $errors['skills'] ?? ''; ?>
    </div>
</div>
<div class="mb-3">
    <label for="bio" class="form-label">Biography:</label>
    <textarea id="bio" name="bio" class="form-control" rows="4" maxlength="200"><?php echo htmlspecialchars($bio ?? ''); ?></textarea>
<div class="error">
    <?php echo $errors['bio'] ?? ''; ?>
</div>
</div>
<div class="allign-text-center">
    <input type="submit" value="Register" class="btn btn-primary">
    </div>
            </form>
        </div>
    </div>
    </form>
</body>
</html>