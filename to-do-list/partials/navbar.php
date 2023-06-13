<?php

$baseUrl = "http://";   
// Append the host(domain name, ip) to the URL.   
$baseUrl.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$baseUrl .= '/to-do-list';   


if (!isset($_COOKIE['userID'])) {
    echo "Cookie named '" . $_COOKIE['userID'] . "' is not set!";
} else {
    echo "Cookie '" . $_COOKIE['userID'] . "' is set!<br>";
    echo "Value is: " . $_COOKIE['userID'];
}
?>

<menu class="container">
    <nav class="navbar py-0 navbar-expand-lg navbar-style fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand py-0" href="<?= $baseUrl ?>/index.php">
                <img src="New folder (2)/logo.png" alt="logo" class="logo-size"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"></a>
                    </li>

                </ul>
                <!-- end of left-side nav-bar items -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= $baseUrl ?>/index.php" style="color: #F7EFE2;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>/contact.php" style="color: #F7EFE2;">Contact Us</a>
                    </li>
                    <?php
                    if (!isset($_COOKIE['userID'])) : // User is not logged in
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $baseUrl ?>/login.php" style="color: #F7EFE2;">Log In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $baseUrl ?>/registration.php" style="color: #F7EFE2;">Registration</a>
                        </li>
                    <?php else : // User is logged in 
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $baseUrl ?>/logout.php" style="color: #F7EFE2;">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <!-- end of right-side nav bar items -->
            </div>
        </div>
    </nav>
</menu>