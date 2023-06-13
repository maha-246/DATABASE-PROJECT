<footer class="footer d-flex justify-content-evenly">
    <div class="container">
        <div class="row d-flex justify-content-evenly mt-4">
            <div class="col-6 col-md-4 mt-3">
                <a href="index.php">
                    <img src="New folder (2)/logo.png" alt="logo" class="logo-size">
                </a>
            </div>
            <div class="col-6 col-md-4 mt-5 text-center">
                <h5 style="color:#F1B2B2">Your Management Solution</h5>
            </div>
            <div class="col-6 col-md-4 mt-5 text-end">
                <h5 style="color:#F1B2B2">Subscribe to To-Do List</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-md-4 mt-1">
                <!-- <img src="images/logo.png" alt="logo" class="footer-logo-size"> -->
                <div class="d-flex mt-3">
                    <i class="fa-solid fa-location-dot me-2" style="color: #F1B2B2"></i>
                    <adress><em>123 Main Street,
                            Anytown, USA</em></address>
                </div>
                <div class="d-flex mt-3">
                    <i class="fa-solid fa-phone me-2" style="color: #F1B2B2"></i>
                    <p><em>+92 317463976</em></p>
                </div>
                <div class="d-flex mt-3 mb-3">
                    <i class="fa-solid fa-at me-2" style="color: #F1B2B2"></i>
                    <p><em>tasksync@outlook.com</em></p>
                </div>
            </div>
            <!-- logo column done -->
            <div class="col-6 col-md-4 text-center mt-2">
                <div class="">
                    <p> Cloud-based task management for seamless access, collaboration, and data security.</p>
                </div>
                <div class="mt-5">
                    <a href="https://www.facebook.com/profile.php?id=100017748708066" class="social-media-icons px-3"><i class="fa-brands fa-facebook" style="color: #F1B2B2"></i></a>
                    <a href="https://twitter.com/MahaArshad17" class="social-media-icons pe-3"><i class="fa-brands fa-twitter" style="color: #F1B2B2"></i></a>
                    <a href="https://www.instagram.com/mahaauthorpk/" class="social-media-icons pe-3"><i class="fa-brands fa-square-instagram" style="color: #F1B2B2"></i></a>
                    <a href="https://www.linkedin.com/in/maha-arshad-2b547718a/" class="social-media-icons pe-3"><i class="fa-brands fa-linkedin" style="color: #F1B2B2"></i></a>
                </div>
            </div>

            <div class="col-6 col-md-4 mt-2 text-end">
                <form class="row justify-content-end">
                    <div class="col-auto pe-1 ">
                        <input type="email" class="form-control" id="email" placeholder="Email Address" style="background-color: #F7EFE2;">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn button-style">Subscribe</button>
                    </div>
                </form>

                <div class="row mt-5 pt-4 justify-content-end">
                    <p class="">&copy; 2023 To-Do List. All rights reserved.</p>
                </div>

            </div>
        </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#courseID').select2();
    });
</script>
</body>

</html>