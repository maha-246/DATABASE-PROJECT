<?php
session_start();  // Starting the session at the beginning
include 'includes/db.php';
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
include 'header.php';
?>


<body style="background-color: #9791D0;">

  <div class="main-body">
    <section class="container py-5">
      <div class="w-50 mx-auto">
        <form class="form-design px-5" method="POST" style="background-color: #745581;" action="login.php">
          <h2 class="pt-4" style="color: #EDCEFF">Already a User? Login to Your Account</h2>
          <div class="form-row pb-5">
            <div class="form-group mt-3">
              <input type="text" class="form-control" id="usernameEmail" name="usernameEmail" placeholder="Username" required />
            </div>
            <div class="form-group mt-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />

            </div>
            <div class="form-group mt-3">
              <input type="submit" value="Login" name="Login" class="btn button-style" style="background-color: #FCB1E8">
              <a href="registration.php" target="_blank" class="btn btn-primary button-style" style="background-color: #FCB1E8">Sign Up</a>
            </div>
          </div>

        </form>
      </div>
    </section>
  </div>

<?php
include 'footer.php';
?>