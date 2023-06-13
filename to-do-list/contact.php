<?php
include 'header.php';
?>

<body style="background-color: #EBD9D0;">
<div class="main-body">
  <section class="container py-5">
    <div class="box w-50 mx-auto" style="background-color: #DFB49C;">
      <form method="get" class="form-design px-5">
        <h2 class="pt-4" style="color:#faede7">Let's Talk!</h2>
        <p class="pt-4" style="color:#faede7">If you have any complaints, queries, or suggestions, we value your feedback and would love to hear from you. Thank you for reaching out!</p>
        <div class="form-row pb-5">
            <div class="form-group mt-3">
              <input type="text" class="form-control" id="inputName" placeholder="Username" > 
            </div>
            <div class="form-group mt-3">
              <input type="email" class="form-control" id="inputEmail" placeholder="Email">
            </div>
            <div class="form-group mt-3">
              <input type="tel" class="form-control" id="inputTel" placeholder="Phone Number">
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" id="inputMessage" rows="8" placeholder="Complaints"></textarea>
            </div>
            <div class="form-group mt-3">
                <textarea class="form-control" id="inputMessage" rows="5" placeholder="Queries"></textarea>
              </div>
            <div class="form-group mt-3">
                <textarea class="form-control" id="inputMessage" rows="7" placeholder="Suggestions"></textarea>
            </div>  
            <div class="form-group mt-3">
              <input type="submit" value="Submit" class="btn button-style" style="background-color: #865a42; color: #EBD9D0;">
              <input type="reset" class="btn button-style" style="background-color: #865a42; color: #EBD9D0;">
            </div>
          </div>
          
      </form>
    <!-- <div>
      <img src="images/contact-form-img.jpg" alt="Image Description" class="position-absolute" style="width: 150px; bottom: -20px; right: 20px;">
    </div> -->
    </div>
  </section>
</div>
<?php
include 'footer.php';
?>