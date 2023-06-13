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
include 'header.php';
?>


<body style="background-color:#F1B2B2">

  <div class="main" style="background-color:#F1B2B2">
    <section class="container py-5">
      <div class="w-50 mx-auto">
        <form method="POST" class="form-design px-5" style="background-color: #C0D6D8" action="">
          <h2 class="pt-4" style="color: #FF0099">Registration!</h2>
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
              <b><label style="color: #FF0099;">Gender</label></b><br>
              <input type="radio" id="male" name="gender" value="male">
              <label for="male" style="color: #FF0099;">Male</label>
              <input type="radio" id="female" name="gender" value="female">
              <label for="female" style="color: #FF0099;">Female</label>
              <input type="radio" id="other" name="gender" value="other">
              <label for="other" style="color: #FF0099;">Other</label>
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

  <?php
  include 'footer.php';
  ?>