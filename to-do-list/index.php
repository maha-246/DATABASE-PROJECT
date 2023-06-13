<?php
include 'includes/db.php';
if (!isset($_COOKIE['userID'])) {
  echo "Cookie named '" . $_COOKIE['userID'] . "' is not set!";
} else {
  echo "Cookie '" . $_COOKIE['userID'] . "' is set!<br>";
  echo "Value is: " . $_COOKIE['userID'];
}
include 'header.php';
?>

<div class="main-body">
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <!-- indicator buttons ends here -->
    <div class="carousel-inner my-carousel">
      <div class="carousel-item active">
        <img src="New folder (2)/carousel pic1.png" class="d-block w-100" alt="about me">
      </div>
      <div class="carousel-item">
        <img src="New folder (2)/carousel pic2.jpg" class="d-block w-100" alt="my-skills">
      </div>
      <div class="carousel-item">
        <img src="New folder (2)/carousel pic3.jpg" class="d-block w-100" alt="favorite-personalities"></a>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <section class="container text-center">
    <div class="row my-5">
      <h2>About Us</h2>
      <p> Welcome to our centralized platform, exclusively designed to revolutionize academic organization for university students. Our comprehensive solution empowers students to effortlessly manage, prioritize, and track all their academic responsibilities in one place. From assignments and exams to project deadlines and study schedules, our platform simplifies the complexities of university life. With our intuitive features and user-friendly interface, staying organized has never been easier. Experience a new level of academic productivity and take control of your educational journey with our all-in-one solution.</p>
    </div>
  </section>

  <section class="container my-5 text-style">
    <div class="inspiration inspiration-style">
      <div class="text text-style">
        <h3>A Pathway to Inspiration</h3>
        <p>What inspired me to create this to-do list app was witnessing the struggles and challenges faced by individuals in managing their daily tasks and responsibilities. I saw friends, colleagues, and even myself overwhelmed with juggling multiple commitments, forgetting important deadlines, and feeling a constant sense of disorganization. This sparked a desire within me to develop a solution that could simplify task management and help people regain control of their lives. The vision of creating a tool that could streamline productivity, reduce stress, and enhance efficiency became my driving force. Witnessing the positive impact it can have on individuals' lives inspired me to embark on this journey and create an app that empowers users to achieve their goals with ease and clarity.</p>
      </div>
      <div class="inspImage1 image-style">
        <img src="New folder (2)/inspiration.jpg" class="d-block w-50" alt="image">
      </div>
    </div>
  </section>

  <section class="container my-5 text-center">


    <div class="row d-flex justify-content-evenly">
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card card-style p-4" style="background-color: #C0B0DF">
          <img src="New folder (2)/lilac box1.jpg" class="card-img-top card-img-size" alt="image">
          <h6></h6>
          <h5 class="card-title">Streamline Your Commitments:</h5>
          <p class="card-text">Say goodbye to scattered notes and overwhelming schedules. Our platform provides a centralized hub where students can consolidate their tasks, assignments, exams, and project deadlines.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card card-style p-4" style="background-color: #C0B0DF">
          <img src="New folder (2)/lilac box2.jpg" class="card-img-top card-img-size" alt="image">
          <h6></h6>
          <h5 class="card-title">Reduce Stress, Boost Productivity:</h5>
          <p class="card-text">University can be stressing. Our app is meticulously designed to alleviate stress and increase productivity. Set reminders and notifications to ensure you never miss a due date.</p>

        </div>
      </div>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card card-style p-4" style="background-color: #C0B0DF">
          <img src="New folder (2)/lilac box3.png" class="card-img-top card-img-size" alt="image">
          <h6></h6>
          <h5 class="card-title">Efficient Task Management:</h5>
          <p class="card-text">Our user-friendly interface makes task management a breeze. Easily add new tasks, categorize them by course or subject, assign due dates, and track progress as you complete task</p>
        </div>
      </div>

    </div>
    <div class="row d-flex justify-content-evenly">
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card card-style p-4" style="background-color: #C0B0DF">
          <img src="New folder (2)/lilac box4.png" class="card-img-top card-img-size" alt="image">
          <h6></h6>
          <h5 class="card-title">Collaboration Made Simple:</h5>
          <p class="card-text">Group projects? No problem. Our platform enables seamless collaboration among classmates. Share task lists, assign responsibilities, and monitor progress collectively.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card card-style p-4" style="background-color: #C0B0DF">
          <img src="New folder (2)/lilac box5.jpg" class="card-img-top card-img-size" alt="image">
          <h6></h6>
          <h5 class="card-title">Personalized and Customizable:</h5>
          <p class="card-text">Tailor the app to fit your unique preferences. Customize the interface with various themes and color schemes. Organize tasks according to your preferred layout.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="card card-style p-4" style="background-color: #C0B0DF">
          <img src="New folder (2)/lilac box6.png" class="card-img-top card-img-size" alt="image">
          <h6></h6>
          <h5 class="card-title">Stay Connected, Anywhere:</h5>
          <p class="card-text">With our mobile app, you can conveniently manage your tasks and stay on top of your academic responsibilities while on the move. Access your to-do lists, update tasks, and receive notifications.</p>
        </div>
      </div>

    </div>
    <!--<p class="text-center mb-5"><em>Join the To-Do List Project and experience a new level of academic organization. Simplify your university life, reduce stress, and maximize your productivity. Take control of your academic responsibilities and achieve your goals with ease. Sign up today and unlock your full potential!</em></p>-->
  </section>
  <section class="container my-5 text-center">
    <div class="row d-flex justify-content-evenly">
      <div class="col-6 col-md-4">
        <div class="card mt-5">
          <div class="card-body">
            <i class="fa-solid fa-plus fa-2xl" style="color: #F7EFE2;"></i>
            <h5 class="card-title">Add Task</h5>
          </div>
          <!-- card body text ends here -->
          <div class="card-body">
            <a href="task/addTask.php" target="_blank" class="btn button-style">Add</a>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4">
        <div class="card mt-5">
          <div class="card-body">
            <i class="fa-solid fa-display fa-2xl" style="color: #F7EFE2;"></i>
            <h5 class="card-title">Display</h5>
          </div>
          <!-- card body text ends here -->
          <div class="card-body">
            <a href="task/display.php" target="_blank" class="btn button-style">Display</a>
          </div>
        </div>
      </div>
      
    </div>
</div>
</section>

<?php
include 'footer.php';
?>