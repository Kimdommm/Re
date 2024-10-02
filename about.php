<?php
session_start();

// Check if session data exists
if (!isset($_SESSION['name'])) {
    header("Location: index.php"); // Redirect to the form if no session data
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">User Details</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        <p><strong>Facebook URL:</strong> <?php echo htmlspecialchars($_SESSION['facebook']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($_SESSION['contact']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($_SESSION['gender']); ?></p>
        <p><strong>Country:</strong> <?php echo htmlspecialchars($_SESSION['country']); ?></p>
        <p><strong>Skills:</strong> <?php echo implode(", ", $_SESSION['skills']); ?></p>
        <p><strong>Biography:</strong> <?php echo htmlspecialchars($_SESSION['bio']); ?></p>
    </div>
</body>
</html>
