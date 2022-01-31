<?php
    require_once 'partials/header.php'; 
    require_once 'database/config.php';
    require_once 'helpers/functions.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
  <div class="container" data-aos="fade-up">

    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
      <div class="col-xl-6 col-lg-8">
        <h1>Best-fit Technology with Tek-devisal<span>.</span></h1>
        <h2>We are a team of innovators</h2>
      </div>
    </div>
  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Apointment</h2>
        <p>Book an Apointment</p>
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

          <form method="post" id="apointment_form">
            <div class="row">
              <div class="col-md-6 form-group">
                <label for="">Full name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <label for="">Phone number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number"
                  onkeypress="return numberOnly(event);" placeholder="Your Phone number" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <label for="">Service type</label>
                <select class="form-control" name="service" id="service" required>
                  <option value="">Select Service</option>
                  <option value="App Development">App Development</option>
                  <option value="Consultations">Consultations</option>
                  <option value="Project Plan">Project Plan</option>
                  <option value="Payment Automation">Payment Automation</option>
                  <option value="Security and Fire Detection Systems">Security and Fire Detection Systems</option>
                  <option value="Hotel Management System">Hotel Management System</option>
                </select>
              </div>
              <div class="col-md-3 form-group mt-3 mt-md-0">
                <label class="control-label">Appointment Date</label>
                <div class='input-group date' id='datetimepicker1' name="date">
                  <input type='date' class="form-control" id="date" name="date" required />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <div class="col-md-3 form-group mt-3 mt-md-0">
                <div id="time_div"></div>
                <!-- <label class="control-label">Appointment Time</label>
                <div class='input-group date' id='datetimepicker1' name="time">
                  <select class="form-control" name="time" id="time" required>
                    <option value="">Select Time</option>
                    
                  </select>
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div> -->
              </div>

            </div>

            <div class="form-group mt-3">
              <label for="">Reason for apointment</label>
              <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message"
                required></textarea>
            </div>
            <!-- <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div> -->
            <div class="text-center"><button type="submit" class="btn btn-info apoint">Book Apointment</button></div>
          </form>

        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<?php
    require_once 'partials/footer.php'; 
?>

<script src="assets/js/js_helpers.js"></script>

<script>
   $("#date").change(function () {
    $.ajax({
          url: "database/Apointments/fetch_time_based_on_date.php",
          method: "POST",
          // dataType: "json",
          // beforeSend: function(){
          //   $(".apoint").attr("disabled", true);
          // },
          data: {
              "date" : $('#date').val(),
          },
          success: function(data) {
            // $(".apoint").removeAttr("disabled");
            if(data == ""){
              }else{
                  $("#time_div").html(data);
              }
          }
      });
    });
</script>
<script>
  $(document).on('submit', '#apointment_form', function (event) {
    event.preventDefault();
    $.ajax({
      url: "database/Apointments/add_apointment.php",
      method: "POST",
      data: new FormData(this),
      // dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function(){
          $(".apoint").attr("disabled", true);
      },
      success: function (data) {
        // $('.spinner-border').hide();    
        $(".apoint").prop("disabled", false);
        if (data == 1) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Apointment booked successfully',
            showConfirmButton: false,
            timer: 1500,
          }).then((result) => {
            $('#apointment_form')[0].reset();
          });
        } else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: data,
            showConfirmButton: false,
            timer: 1500,
          });
        }
      }
    });
  });
</script>