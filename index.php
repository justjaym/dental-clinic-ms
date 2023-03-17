<?php include 'header.php'; ?>

<?php $settings = get_one("SELECT * from tbl_settings where id = 1"); ?>
<style>
  .work {
    background: #fff !important;
    padding: 32px;
  }

  /* .img{
  height:200px;
  width:100px;
  border-radius:10px;
  border:3px solid red;
} */
  ul.primary-nav>li>a.active {
    text-decoration: underline black 3px;
  }

  section.active {
    border: 15px solid cyan;
  }

  .primary-img .background .active>img {
    object-fit: cover !important;
  }

  .projector>* {
    margin-top: 8vh;
    height: 92vh !important;
  }

  /* .btn-outline:hover{
    background:red;
  } */
  body {
    font-family: 'Nunito Sans' !important;
  }

  .banner1 {
    color: #89eaf9 !important;
  }
</style>
<!-- banner text -->
<div class="banner">
  <div class="slider-banner">
    <!-- <div data-lazy-background="images/slides/ban.jpg"> -->
    <!-- style="opacity:.8" -->
    <div data-lazy-background="images/slides/banner4.png">
      <h1 class="banner1" data-pos="['68%', '-40%', '5%', '12%']" data-duration="700" data-effect="move">
        Provincial Dental Clinic Management System
      </h1> <br>
      <p class="banner1" data-pos="['75%', '110%', '40%', '12%']" data-duration="700" data-effect="move">
        Provincial Dental Clinic Management System
      </p>
    </div>
  </div>
  <!-- banner text -->
</div>
</section>
<!-- header section -->
<!-- intro section -->
<!-- <section id="intro" class="section intro">
  <div class="container">
    <div class="col-md-8 col-md-offset-2 text-center">
      <h3>Welcome to Smile Zone</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu libero scelerisque ligula sagittis faucibus eget quis lacus.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
	<div class="site-info">
		<div class="phoneInfo"><h6>Call Today: </h6><a href="#">123–123–2323</a>; <a href="#">123–123–2323</a></div>
		<div class="timeInfo"><h6>Opening Hours: </h6> <em>Mon–Fri: 9am–6pm; Sun: 10am–1pm</em></div>
	</div>   
   </div>
  </div>
</section> -->
<!-- intro section -->
<!-- services section -->
<!-- <section id="services" class="services service-section">
  <div class="container">
  <div class="section-header">
                <h2 class="wow fadeInDown animated">Treatments</h2>
                <p class="wow fadeInDown animated">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget risus vitae massa <br> semper aliquam quis mattis quam.</p>
            </div>
    <div class="row">
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-happy"></span>
        <div class="services-content">
          <h5>Cosmetic</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu libero scelerisque ligula sagittis faucibus eget quis lacus.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-layers"></span>
        <div class="services-content">
          <h5>Oral Surgery</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu libero scelerisque ligula sagittis faucibus eget quis lacus.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-wine"></span>
        <div class="services-content">
          <h5>Replacement</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu libero scelerisque ligula sagittis faucibus eget quis lacus.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-hotairballoon"></span>
        <div class="services-content">
          <h5>Orthodontics</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu libero scelerisque ligula sagittis faucibus eget quis lacus.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-heart"></span>
        <div class="services-content">
          <h5>Child Dental </h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu libero scelerisque ligula sagittis faucibus eget quis lacus.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 services text-center"> <span class="icon icon-scope"></span>
        <div class="services-content">
          <h5>Restorative</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu libero scelerisque ligula sagittis faucibus eget quis lacus.</p>
        </div>
      </div>
    </div>
  </div>
</section> -->
<section id="contact" class="section">
  <div class="container">
    <div class="section-header">
      <h3 class="wow fadeInDown animated">Already a member of the Association and wants to have your own Dental Clinic Account? Click <u><a href="request.php">Here</a></u></h3>
      <p class="wow fadeInDown animated">Here at PDCMS you can now register your own Clinic online! <br><b> Not yet a member of the Association?</b> Click <u> <a href="#" data-toggle="modal" data-target="#membership_modal">Here</a></u></p>
    </div>
    <div class="card">
      <div class="card-body">
        <h3 class="card-title mb-0">For Inquiries Please Contact Us</h3>
        <br>
        <h5>pdaoffice1908@gmail.com || (+63) 917 6856 800</h5>
      </div>

      <!-- <table class="table">
        <thead>
          <tr>
            <th scope="col">Requirements to send:</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <?= str_replace("\n", "<br>", $settings->requirements) ?>
            </td>

          </tr>
        </tbody>
      </table> -->

    </div>
  </div>
</section>
<!-- services section  -->
<!--About-->
<section id="content-3-10" class="content-block data-section nopad content-3-10">
  <div class="image-container col-sm-6 col-xs-12 pull-left">
    <div class="background-image-holder">

    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-6 col-xs-12 content">
        <div class="editContent">
          <h3>About Us</h3>
        </div>
        <div class="editContent">
          <strong>Personalized Care</strong>
          <p>Our company provides a comprehensive dental clinic management system for provincial dental clinics. Our mission is to streamline clinic operations and improve patient care by offering a solution that is efficient, user-friendly, and accessible.<br>With our cutting-edge technology, dentists and clinic staff can manage appointments, patient records, billing, and other important tasks with ease.<br>Our goal is to empower provincial dental clinics with the tools they need to provide high-quality care to their communities.</p>
        </div>
        <a href="#gallery" class="btn btn-outline btn-outline outline-dark">Our Gallery</a>
      </div>
    </div><!-- /.row-->
  </div><!-- /.container -->
</section>


<!-- gallery section -->
<section id="gallery" class="gallery section">
  <div class="container-fluid">
    <div class="section-header">
      <!-- style="color:red" -->
      <h2 class="wow fadeInDown animated">Gallery</h2>
      <!-- <p class="wow fadeInDown animated">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eget risus vitae massa <br> semper aliquam quis mattis quam.</p> -->
    </div>
    <div class="row m-5 p-5">
      <div class="col-lg-4 col-md-6 col-sm-6 work"> <a href="images/portfolio/c1.jpg" class="work-box"> <img src="images/portfolio/c1.jpg" alt="">
          <div class="overlay">
            <div class="overlay-caption">
              <p><span class="icon icon-magnifying-glass"></span></p>
            </div>
          </div>
          <!-- overlay -->
        </a> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 work"> <a href="images/portfolio/c2.jpg" class="work-box"> <img src="images/portfolio/c2.jpg" alt="">
          <div class="overlay">
            <div class="overlay-caption">
              <p><span class="icon icon-magnifying-glass"></span></p>
            </div>
          </div>
          <!-- overlay -->
        </a> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 work"> <a href="images/portfolio/c3.jpg" class="work-box"> <img src="images/portfolio/c3.jpg" alt="" class="img">
          <div class="overlay">
            <div class="overlay-caption">
              <p><span class="icon icon-magnifying-glass"></span></p>
            </div>
          </div>
          <!-- overlay -->
        </a> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 work"> <a href="images/portfolio/c4.jpg" class="work-box"> <img src="images/portfolio/c4.jpg" alt="">
          <div class="overlay">
            <div class="overlay-caption">
              <p><span class="icon icon-magnifying-glass"></span></p>
            </div>
          </div>
          <!-- overlay -->
        </a> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 work"> <a href="images/portfolio/c5.jpg" class="work-box"> <img src="images/portfolio/c5.jpg" alt="">
          <div class="overlay">
            <div class="overlay-caption">
              <p><span class="icon icon-magnifying-glass"></span></p>
            </div>
          </div>
          <!-- overlay -->
        </a> </div>
      <div class="col-lg-4 col-md-6 col-sm-6 work"> <a href="images/portfolio/c6.jpg" class="work-box"> <img src="images/portfolio/c6.jpg" alt="">
          <div class="overlay">
            <div class="overlay-caption">
              <p><span class="icon icon-magnifying-glass"></span></p>
            </div>
          </div>
          <!-- overlay -->
        </a> </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>