<?php
    require_once 'partials/header.php'; 
    require_once 'database/config.php';
    require_once 'helpers/functions.php';


    $query = "SELECT * FROM shop";
    $statement = $con->prepare($query);

    $statement->execute();

    $count = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
  <div class="container" data-aos="fade-up">

    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
      <div class="col-xl-6 col-lg-8">
        <h1>Shop<span>.</span></h1>
        <!-- <h2>We are a team of innovators</h2> -->
      </div>
    </div>

  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= Shop Section ======= -->
  <section id="shop" class="shop">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Shop</h2>
        <p>Buy Our Products Here</p>
      </div>

      <div class="row">

        <?php
            if($count > 0){
               foreach($result as $results){?>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                  <div class="member" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-img">
                      <img src="assets/img/shop/<?= fetchFirstShopImage($con, $results['id']);?>" style="height: 350px; width: 400px;object-fit:cover" class="img-fluid" alt="">
                      <!-- <div class="social">
                        <a href=""><i class="bi bi-twitter"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                      </div> -->
                    </div>
                    <div class="member-info">
                      <h4><?= $results['name'];?></h4>
                      <span style="font-size: 25px;color: #DD6E0F;"><?= moneyFormat($results['prize']);?></span>
                    </div>
                  </div>
                </div>
              <?php
               }
            }
            else{?>
                  <h1>We are out of stock.</h1>
            <?php
            }
        ?>
      </div>

    </div>
  </section><!-- End Team Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div>

      <div>
        <iframe style="border:0; width: 100%; height: 270px;"
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
          frameborder="0" allowfullscreen></iframe>
      </div>

      <div class="row mt-5">

        <div class="col-lg-4">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>info@example.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>+1 5589 55488 55s</p>
            </div>

          </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0">

          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>

        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<?php
    require_once 'partials/footer.php'; 
?>
