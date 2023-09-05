
<?php
  $url = $_GET['url'] ?? 'home';
  $url = explode('/',$url);
  $page_name = trim($url[0]);
 ?>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="home">Mentor</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class=" <?= $page_name=='home'? 'active' :'' ?>" href="home">Home</a></li>
          <li><a class=" <?= $page_name=='about'? 'active' :'' ?>" href="about">About</a></li>
          <li><a class=" <?= $page_name=='courses'? 'active' :'' ?>" href="courses">Courses</a></li>
          <li><a class=" <?= $page_name=='trainers'? 'active' :'' ?>" href="trainers">Trainers</a></li>
          <li><a class=" <?= $page_name=='events'? 'active' :'' ?>" href="events">Events</a></li>
          <li><a class=" <?= $page_name=='pricing'? 'active' :'' ?>" href="pricing">Pricing</a></li>
          <li><a class=" <?= $page_name=='contact'? 'active' :'' ?>" href="contact">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="courses.php" class="get-started-btn">Get Started</a>

    </div>
  </header><!-- End Header -->
