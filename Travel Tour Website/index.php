<?php
include ('./includes/header.php');
?>
<style>
  /* Style for the book links */
  .card-body a {
    display: inline-block;
    background-color: #007bff; /* Blue background color */
    color: #fff; /* White text color */
    padding: 10px 20px; /* Padding around text */
    border-radius: 5px; /* Rounded corners */
    text-decoration: none; /* Remove underline */
    margin-top: 10px; /* Add some space at the top */
  }

  /* Hover effect */
  .card-body a:hover {
    background-color: #0056b3; /* Darker blue background color */
  }
</style>


<body>

   <!-- Navbar Start -->
<nav class="navbar navbar-expand-lg" id="navbar">
  <div class="container">
      <a class="navbar-brand" href="index.php" id="logo"><span>T</span>ravel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
          <span><i class="fa-solid fa-bars"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
          <ul class="navbar-nav me-auto">
              <li class="nav-item">
                  <a class="nav-link active" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#book">Book</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#packages">Packages</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#services">Services</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#gallary">Gallary</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#about">About</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="register.php">Register</a> <!-- Link to your register.php file -->
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a> <!-- Link to your login.php file -->
              </li>
          </ul>
        
          <form class="d-flex">
              <input class="form-control me-2" type="text" placeholder="Search">
              <button class="btn btn-primary" type="button">Search</button>
          </form>
      </div>
  </div>
</nav>
<!-- Navbar End -->

<!-- Home Section Start -->
<div class="home">
    <div class="content">
        <h5>Welcome To World</h5>
        <h1>Visit <span class="changecontent"></span></h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quae, nisi.</p>
        <a href="#book">Book Place</a>
    </div>
</div>
<!-- Home Section End -->

<!-- Section Book Start -->
<section class="book" id="book">
  <div class="container">

    <div class="main-text">
      <h1><span>B</span>ook</h1>
    </div>
    
    <div class="row">

      <div class="col-md-6 py-3 py-md-0">
        <div class="card">
          <img src="./images/book-img.png" alt="">
        </div>
      </div>

      <div class="col-md-6 py-3 py-md-0">
        <form action="#">

          <input type="text" class="form-control" placeholder="Where To" required><br>
          <input type="text" class="form-control" placeholder="How Many" required><br>
          <input type="date" class="form-control" placeholder="Arrivals" required><br>
          <input type="date" class="form-control" placeholder="Leaving" required><br>
          <textarea class="form-control" rows="5" name="text" placeholder="Enter Your Name & Details"></textarea>
          <input type="submit" value="Book Now" class="submit" required>

        </form>
      </div>

    </div>
  </div>
</section>
<!-- Section Book End -->

<!-- Section Packages Start -->
<section class="packages" id="packages">
  <div class="container">
    
    <div class="main-txt">
      <h1><span>P</span>ackages</h1>
    </div>

    <div class="row" style="margin-top: 30px;">

      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <img src="./images/uk.png" alt="">
          <div class="card-body">
            <h3>United Kingdom</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut, doloribus!</p>
            <div class="star">
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star "></i>
              <i class="fa-solid fa-star "></i>
            </div>
            <h6>Price: <strong>$500</strong></h6>
            <a href="#book">Book Now</a>
          </div>
        </div>

      </div>
      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <img src="./images/france.png" alt="">
          <div class="card-body">
            <h3>France</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut, doloribus!</p>
            <div class="star">
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star "></i>
              <i class="fa-solid fa-star "></i>
            </div>
            <h6>Price: <strong>$500</strong></h6>
            <a href="#book">Book Now</a>
          </div>
        </div>

      </div>
      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <img src="./images/pakistan.png" alt="">
          <div class="card-body">
            <h3>Pakistan</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut, doloribus!</p>
            <div class="star">
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star "></i>
              <i class="fa-solid fa-star "></i>
            </div>
            <h6>Price: <strong>$500</strong></h6>
            <a href="#book">Book Now</a>
          </div>
        </div>

      </div>

    </div>



    <div class="row" style="margin-top: 30px;">

      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <img src="./images/italy.png" alt="">
          <div class="card-body">
            <h3>Italy</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut, doloribus!</p>
            <div class="star">
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star "></i>
              <i class="fa-solid fa-star "></i>
            </div>
            <h6>Price: <strong>$500</strong></h6>
            <a href="#book">Book Now</a>
          </div>
        </div>

      </div>
      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <img src="./images/india.png" alt="">
          <div class="card-body">
            <h3>India</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut, doloribus!</p>
            <div class="star">
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star "></i>
              <i class="fa-solid fa-star "></i>
            </div>
            <h6>Price: <strong>$500</strong></h6>
            <a href="#book">Book Now</a>
          </div>
        </div>

      </div>
      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <img src="./images/us.png" alt="">
          <div class="card-body">
            <h3>United States</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut, doloribus!</p>
            <div class="star">
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star checked"></i>
              <i class="fa-solid fa-star "></i>
              <i class="fa-solid fa-star "></i>
            </div>
            <h6>Price: <strong>$500</strong></h6>
            <a href="#book">Book Now</a>
          </div>
        </div>

      </div>

    </div>


  </div>
</section>
<!-- Section Packages End -->

<!-- Section Services Start -->
<section class="services" id="services">
  <div class="container">

    <div class="main-txt">
      <h1><span>S</span>ervices</h1>
    </div>

    <div class="row" style="margin-top: 30px;">

      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <i class="fas fa-hotel"></i>
          <div class="card-body">
            <h3>Affordable Hotel</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A, eaque.</p>
            <a href="affordable_hotel.php">Book Hotel</a>
          </div>
        </div>

      </div>
      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <i class="fas fa-utensils"></i>
          <div class="card-body">
            <h3>Food & Drinks</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A, eaque.</p>
            <a href="Food & Drinks.php">Order Food & Drinks</a>
          </div>
        </div>

      </div>
      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <i class="fas fa-bullhorn"></i>
          <div class="card-body">
            <h3>Safty Guide</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A, eaque.</p>
            <a href="Safty Guide.php">Rules and Regulation</a>
          </div>
        </div>

      </div>



    </div>


    <div class="row" style="margin-top: 30px;">

      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <i class="fas fa-globe-asia"></i>
          <div class="card-body">
            <h3>Around The World</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A, eaque.</p>
            <a href="Around The World.php">Travel Around The World</a>
          </div>
        </div>

      </div>
      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <i class="fas fa-plane"></i>
          <div class="card-body">
            <h3>Fastest Travel</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A, eaque.</p>
            <a href="Fastest Travel.php">Fast Trip</a>
          </div>
        </div>

      </div>
      <div class="col-md-4 py-3 py-md-0">

        <div class="card">
          <i class="fas fa-hiking"></i>
          <div class="card-body">
            <h3>Adventures</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. A, eaque.</p>
            <a href="Adventures.php">Adventures</a>
          </div>
        </div>

      </div>



    </div>

  </div>
</section>
<!-- Section Services End -->

<!-- Section Gallary Start -->
<section class="gallary" id="gallary">
  <div class="container">

    <div class="main-txt">
      <h1><span>G</span>allary</h1>
    </div>

    <div class="row" style="margin-top: 30px;">
      <div class="col-md-4 py-3 py-md-0">
        <div class="card">
          <img src="./images/g1.png" alt="" height="230px">
        </div>
      </div>
      <div class="col-md-4 py-3 py-md-0">
        <div class="card">
          <img src="/images/g2.png" alt="" height="230px">
        </div>
      </div>
      <div class="col-md-4 py-3 py-md-0">
        <div class="card">
          <img src="./images/g3.png" alt="" height="230px">
        </div>
      </div>
    </div>


    <div class="row" style="margin-top: 30px;">
      <div class="col-md-4 py-3 py-md-0">
        <div class="card">
          <img src="./images/g4.png" alt="" height="230px">
        </div>
      </div>
      <div class="col-md-4 py-3 py-md-0">
        <div class="card">
          <img src="./images/g5.png" alt="" height="230px">
        </div>
      </div>
      <div class="col-md-4 py-3 py-md-0">
        <div class="card">
          <img src="./images/g6.png" alt="" height="230px">
        </div>
      </div>
    </div>

  </div>
</section>
<!-- Section Gallary End -->

<!-- About Start -->
<section class="about" id="about">
  <div class="container">

    <div class="main-txt">
      <h1>About <span>Us</span></h1>
    </div>

    <div class="row" style="margin-top: 50px;">

      <div class="col-md-6 py-3 py-md-0">
        <div class="card">
          <img src="./images/about-img.png" alt="">
        </div>
      </div>

      <div class="col-md-6 py-3 py-md-0">
        <h2>How Travel Agency Work</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident perferendis dolorem, numquam earum at nam beatae voluptate natus consectetur facere, saepe cupiditate ut exercitationem deserunt, facilis quam perspiciatis autem iure illo harum minima. Quas, vitae aperiam laudantium alias asperiores nulla rerum, nihil eveniet perferendis sint illum accusamus officiis aliquam nam.</p>
        <button id="about-btn">Read More...</button>
      </div>

      <script>
        // JavaScript code
          document.getElementById('about-btn').addEventListener('click', function() {
        // Redirect to the next page where information about travel and tour is displayed
           window.location.href = 'about_us.php';
         });
      </script>

    </div>

  </div>
</section>
<!-- About End -->

<!-- Footer Start -->
<footer id="footer">
  <h1><span>T</span>ravel</h1>
  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Temporibus fugiat, ipsa quos nulla qui alias.</p>
  <div class="social-links">
    <i class="fa-brands fa-twitter"></i>
    <i class="fa-brands fa-facebook"></i>
    <i class="fa-brands fa-instagram"></i>
    <i class="fa-brands fa-youtube"></i>
    <i class="fa-brands fa-pinterest-p"></i>
  </div>
  <div class="credit">
    <p>Designed By <a href="#">SA Coding</a></p>
  </div>
  <div class="copyright">
    <p>&copy;Copyright SA Coding. All Rights Reserved</p>
  </div>
</footer>
<!-- Footer End -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
