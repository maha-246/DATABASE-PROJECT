<?php
include 'includes/db.php';
$errors = array();

error_reporting(E_ALL);
ini_set('display_errors', 1);

//registration form php 
// Get user input from form

if (isset($_POST['submit'])) {
  // echo "registration is live!";

  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword']; // hash the password for security
  $email = $_POST['email'];
  $gender = $_POST['gender'];

  // echo "First Name: " . $firstName . "<br>";
  // echo "Last Name: " . $lastName . "<br>";
  // echo "Username: " . $username . "<br>";
  // echo "Email: " . $email . "<br>";
  // echo "Password: " . $password . "<br>";
  // echo "Confirm Password: " . $confirmPassword . "<br>";
  // echo "Gender: " . $gender . "<br>";


  // Prepare an SQL statement
  if (empty($firstName)) {
    array_push($errors, "First Name  is required");
  }
  if (empty($lastName)) {
    array_push($errors, "Last Name is required");
  }
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  if ($password != $confirmPassword) {
    array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if (isset($user['username']) && $user['username'] === $username) {
        array_push($errors, "Username already exists");
    }

    if (isset($user['email']) && $user['email'] === $email) {
        array_push($errors, "Email already exists");
    }
  }

  }
  
  if (count($errors) == 0) {
    // Prepare statement;
    $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, Username, Password_, Email, gender) VALUES (?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("ssssss", $firstName, $lastName, $username, $password, $email, $gender);
    
    // Execute the statement
    $stmt->execute();

    // Close statement
    $stmt->close();

  }

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/7e8022a4f3.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/stylesheet.css" />
</head>

<body>

  <div class="main-body">
    <section class="container py-5">
      <div class="w-50 mx-auto">
        <form method="POST" class="form-design px-5" action="">
          <h2 class="pt-4">Registration!</h2>
          <div class="form-row pb-5">

            <!-- first name -->
            <div class="form-group mt-3">
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
            </div>

            <!-- //last name -->
            <div class="form-group mt-3">
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
            </div>

            <!-- //username -->
            <div class="form-group mt-3">
              <input type="text" class="form-control" id="username" name="username" placeholder="Your Username" required>
            </div>

            <!-- //email -->
            <div class="form-group mt-3">
              <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Your Email" required>
            </div>

            <!-- //password -->
            <div class="form-group mt-3">
              <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" data-sb-validations="required">
            </div>

            <div class="form-group mt-3">
              <input type="password" class="form-control" id="inputPassword" name="confirmPassword" placeholder=" Confirm Password" data-sb-validations="required">
            </div>

            <!-- //gender -->
            <div class="form-group mt-3">
              <b><label>Gender</label></b><br>
              <input type="radio" id="male" name="gender" value="male">
              <label for="male">Male</label>
              <input type="radio" id="female" name="gender" value="female">
              <label for="female">Female</label>
              <input type="radio" id="other" name="gender" value="other">
              <label for="other">Other</label>
            </div>

            <div class="form-group mt-3">
              <input type="submit" name="submit" value="Submit" class="btn button-style">
              <input type="reset" class="btn button-style">
            </div>
          </div>

        </form>
      </div>
    </section>
  </div>

  <!-- FORM -->




</body>

</html>