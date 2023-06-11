<?php
session_start();  // Starting the session at the beginning
include 'db.php';
$errors = array();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['Login'])) {
  $usernameEmail = $_POST['usernameEmail'];
  $password = $_POST['password'];

  if (empty($usernameEmail)) {
    array_push($errors, "Username or Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }


  if (count($errors) == 0) {
    $query = "SELECT * FROM users WHERE Username='$usernameEmail' OR Email='$usernameEmail' AND Password_='$password' ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    print_r($result);
    print_r($user);


    if ($user) {
      // Passwords match, so start a new session
      $_SESSION['userID'] = $user['UserID'];
      setcookie('userID', $user['UserID'], time() + (86400 * 30), "/"); 
      header("Location: index.php");  // Using header() before any output
      // exit();
      print_r($user['UserID']);
    } else {
      // Passwords didn't match or no such user
      array_push($errors, "Wrong username/email or password");
    }
  }
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
  <link rel="stylesheet" href="stylesheet.css">
</head>

<body>

  <div class="main-body">
    <section class="container py-5">
      <div class="w-50 mx-auto">
        <form class="form-design px-5" method="POST" action="login.php">
          <h2 class="pt-4">Already a User? Login to Your Account</h2>
          <div class="form-row pb-5">
            <div class="form-group mt-3">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="usernameEmail" name="usernameEmail" placeholder="Enter your name..." required />
            </div>
            <div class="form-group mt-3">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password..." required />

            </div>
            <div class="form-group mt-3">
              <input type="submit" value="Login" name="Login" class="btn button-style">
              <a href="registration.php" target="_blank" class="btn btn-primary button-style">Sign Up</a>
            </div>
          </div>

        </form>
      </div>
    </section>
  </div>

</body>

</html>