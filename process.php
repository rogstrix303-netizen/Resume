<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.html");
    exit();
}

$fullname   = $_POST['fullname'];
$fathername = $_POST['fathername'];
$email      = $_POST['email'];
$phone      = $_POST['phone'];
$gender     = $_POST['gender'];
$dob        = $_POST['dob'];
$join_date  = $_POST['join_date'];
$qualification = $_POST['qualification'];
$address    = $_POST['address'];
$course     = $_POST['course'];
$comments   = $_POST['comments'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Registration Successful ✅</h2>

    <div class="result">
        <p><b>Full Name:</b> <?php echo $fullname; ?></p>
        <p><b>Father's Name:</b> <?php echo $fathername; ?></p>
        <p><b>Email:</b> <?php echo $email; ?></p>
        <p><b>Phone:</b> <?php echo $phone; ?></p>
        <p><b>Gender:</b> <?php echo $gender; ?></p>
        <p><b>Date of Birth:</b> <?php echo $dob; ?></p>
        <p><b>Preferred Joining Date:</b> <?php echo $join_date; ?></p>
        <p><b>Highest Qualification:</b> <?php echo $qualification; ?></p>
        <p><b>Address:</b> <?php echo $address; ?></p>
        <p><b>Course Applying For:</b> <?php echo $course; ?></p>
        <p><b>Additional Comments:</b> <?php echo $comments; ?></p>
    </div>

    <br>
    <a href="index.html">
        <button>Go Back</button>
    </a>
</div>

</body>
</html>
