<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookdb"; // bookdb

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $raw_password = $_POST["password"];
    $password = password_hash($raw_password, PASSWORD_DEFAULT);
    $address = $_POST["address"];
    $mobilenumber = $_POST["mobilenumber"];

    $sql = "INSERT INTO usersignup (fullname, username, email, password, address, mobilenumber)
        VALUES ('$fullname', '$username', '$email', '$password', '$address', '$mobilenumber')";



    if (mysqli_query($conn, $sql)) {
        
        $userId = mysqli_insert_id($conn);

      
        $to = $email;
        $subject = "Registration Confirmation";
        $message = "Dear $fullname,\n\nThank you for registering with us!\n\nYour User ID is: $userId\n\nBest regards";
        $headers = "From: ahmedeimzy@gmail.com";

        if (mail($to, $subject, $message, $headers)) {
            echo '<script>alert("Signup successfully! Confirmation email sent."); window.location.href = "userprofile.php";</script>';
        } else {
            echo '<script>alert("Signup successful, but confirmation email could not be sent. Please contact support."); window.location.href = "userprofile.html";</script>';
        }
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<style>
  body {
    margin: 0;
    padding: 0;
    background: url('image/back2.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
  }

  .signup-form {
    width: 300px;
    background: rgba(255, 255, 255, 0.8);
    padding: 50px;
    border-radius: 10px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }

  h2 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
    color: #5ea1e9;
  }

  input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
  }

  button {
    width: 100%;
    padding: 10px;
    background-color: #5ea1e9;
    border: none;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
  }

</style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="signup-form">
            <h2>Create an Account</h2>

            <input type="text" name="fullname" placeholder="Full Name"  title="Please enter your full name with only letters and spaces." autofocus>
            <input type="text" name="username" placeholder="User Name"  title="Enter the Username ">
            <input type="email" name="email" placeholder="Email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Please enter a valid email address.">
            <input type="password" name="password" placeholder="Password" >
            <input type="text" name="address" placeholder="Address"  title="Please enter your valid address.">
            <input type="tel" name="mobilenumber" placeholder="Mobile Number" required pattern="\d{10}" title="Please enter a 10-digit mobile number.">

            <button type="submit">Sign Up</button>
            <p>you have an account? <a href="loginl.php">Register here</a>.</p>
        </div>
        
    </form>
</body>
</html>



