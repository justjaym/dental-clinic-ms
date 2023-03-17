  <!-- Modal signup -->
  <div class="modal fade" id="register_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?= (isset($_POST['registeruser'])) ? registerUser($_POST) : ''; ?>

          <h4 class="modal-title">Sign Up</h5>
        </div>
        <div class="modal-body">
          <form method="post" name="landing_signup" onsubmit="return confirm('Are you sure?');">
            <div id="signup_result"></div>
            <div class="row">
              <div class="form-group col-md-6" id="username">
                <label for="inputEmail4">First Name<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="first_name" required>
              </div>
              <div class="form-group col-md-6" id="username">
                <label for="inputEmail4">Last Name<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="last_name" required>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6" id="username">
                <label for="inputEmail4">Username<span style="color:red">*</span></label>
                <input type="text" class="form-control" name="username" required pattern="(?=.*\d)(?=.*[a-z])(?=.*).{6,}" title="Must contain at least one number and lowercase letter, and at least 6 or more characters">
              </div>
              <div class="form-group col-md-6" id="username">
                <label for="inputEmail4">Password<span style="color:red">*</span></label>
                <input type="password" class="form-control" id="fname" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="validate" required><span>Include atleast 8 characters, a number, an upper and lower case letter.</span>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6" id="username">
                <label for="inputEmail4">City/Municipality<span style="color:red">*</span></label>
                <select name="municipality" id="municipality" class="form-control">
                  <?php foreach (get_list("SELECT * from tbl_city") as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-md-6" id="username">
                <label for="inputEmail4">Barangay<span style="color:red">*</span></label>
                <select name="barangay" id="barangay" class="form-control">
                  <?php foreach (get_list("SELECT * from tbl_barangay where city_id = '015501'") as $res) { ?>
                    <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6" id="username">
                <label for="inputEmail4">E-mail<span style="color:red">*</span></label>
                <input type="email" class="form-control" name="email" required>
              </div>
              <div class="form-group col-md-6" id="username">
                <label for="inputEmail4">Contact No.<span style="color:red">*</span></label>
                <input type="number" class="form-control" name="contact" required>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="registeruser" class="btn btn-primary">Sign Up</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal login -->
  <div class="modal fade" id="membership_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Membership</h5>
        </div>
        <form method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?');">
          <div class="modal-body">
            <?php if (isset($_POST['membership'])) membershipUser(array_merge($_POST, $_FILES)); ?>

            <div class="bs-example bs-example-form">


              <div class="row">
                <div class="form-group col-md-6" id="username">
                  <div class="row">
                    <div class="form-group col-md-12" id="username">
                      <label for="inputEmail4">PRC No<span style="color:red">*</span></label>
                      <input type="text" class="form-control" placeholder="PRC No" name="prc_no" pattern="[0-9]{7}" required>
                    </div>
                  </div>
                  <div class=" row">
                    <div class="form-group col-md-6" id="username">
                      <label for="inputEmail4">First Name<span style="color:red">*</span></label>
                      <input type="text" class="form-control" placeholder="First Name" name="first_name" required>
                    </div>
                    <div class="form-group col-md-6" id="username">
                      <label for="inputEmail4">Last Name<span style="color:red">*</span></label>
                      <input type="text" class="form-control" placeholder="Last name" name="last_name" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6" id="username">
                      <label for="inputEmail4">City/Municipality<span style="color:red">*</span></label>
                      <select name="municipality2" id="municipality2" class="form-control">
                        <?php foreach (get_list("SELECT * from tbl_city") as $res) { ?>
                          <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-md-6" id="username">
                      <label for="inputEmail4">Barangay<span style="color:red">*</span></label>
                      <select name="barangay2" id="barangay2" class="form-control">
                        <?php foreach (get_list("SELECT * from tbl_barangay where city_id = '015501'") as $res) { ?>
                          <option value="<?= $res['id'] ?>"><?= $res['name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12" id="username">
                      <label for="inputEmail4"> Attach Receipt</label>
                      <input type="file" class="form-control" name="attachment" required accept=".jpg,.jpeg,.png">
                    </div>

                  </div>
                </div>
                <div class="form-group col-md-6" id="username">
                  <img src="images/qr.jpg" alt="" style="height: auto;width: 360px;object-fit: contain;">
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="membership" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- Modal login -->
  <div class="modal fade" id="login_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Login</h5>
        </div>
        <form method="post" action="index.php?show_modal">
          <div class="modal-body">
            <?php if (isset($_POST['login'])) loginUser($_POST); ?>
            <div id="login_result"></div>
            <div class="bs-example bs-example-form">
              <div class="form-group input-group" id="username">
                <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-user"></i> Username</span>
                <input type="text" class="form-control" placeholder="Username" name="username" required>
              </div>
              <div class="form-group input-group" id="password">
                <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-lock"></i> Password</span>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
              </div>
              <div class="container align-items-center justify-content-center">
                <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#forgot_password">Forgot your password?</a>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <form id="my-form" action="https://formspree.io/f/meqweyob" method="POST">
    <!-- Modal Forgot password -->
    <div class="modal fade" id="forgot_password" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Forgot Password</h5>

          </div>
          <div class="modal-body">

            <!-- modify this form HTML and place wherever you want your form -->
            <div class="bs-example bs-example-form">
              <div class="form-group input-group" id="username">
                <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-user"></i> Enter Email Address</span>
                <input type="email" class="form-control" placeholder="Email" name="email" required id="email">
                <input type="hidden" name="message" id="message" value="<?= "reset password link: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]reset_password.php?id=" ?>">
              </div>

              <p id="my-form-status"></p>
            </div>

            <!-- Place this script at the end of the body tag -->
            <script>
              var form = document.getElementById("my-form");

              async function handleSubmit(event) {
                event.preventDefault();
                let x = document.getElementById("email").value;
                let y = document.getElementById("message").value;

                let id = 0;
                $.get("forgot.php?email=" + x, function(result) {
                  id = parseInt(result);

                  var status = document.getElementById("my-form-status");
                  var data = new FormData();
                  let x = document.getElementById("email").value;
                  let y = document.getElementById("message").value;
                  data.append("email", x);
                  data.append("message", y + id);
                  fetch(event.target.action, {
                    method: form.method,
                    body: data,
                    headers: {
                      'Accept': 'application/json'
                    }
                  }).then(response => {
                    if (response.ok) {
                      status.innerHTML = "Link sent please check your email!";
                      form.reset()
                    } else {
                      response.json().then(data => {
                        if (Object.hasOwn(data, 'errors')) {
                          status.innerHTML = data["errors"].map(error => error["message"]).join(", ")
                        } else {
                          status.innerHTML = "Oops! There was a problem submitting your form"
                        }
                      })
                    }
                  }).catch(error => {
                    status.innerHTML = "Oops! There was a problem submitting your form"
                  });

                });
              }
              form.addEventListener("submit", handleSubmit)
            </script>
          </div>

          <div class="modal-footer">
            <button type="submit" id="my-form-button" class="btn btn-primary">Send Email</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#login_modal">Back</button>
          </div>
        </div>
      </div>
    </div>
  </form>



  <!-- Footer section -->
  <!-- <footer class="footer">
</footer> -->
  <!-- Footer section  -->
  <!-- JS FILES -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.flexslider-min.js"></script>
  <script src="js/jquery.fancybox.pack.js"></script>
  <script src="js/modernizr.js"></script>
  <script src="js/main.js"></script>
  <script type="text/javascript" src="js/jquery.contact.js"></script>
  <script type="text/javascript" src="js/jquery.devrama.slider.min-0.9.4.js"></script>
  <script type="text/javascript">
    $(document).on("change", "#municipality", function() {
      let value = $(this).val();
      $.get("dropdown.php?city=" + value, function(result) {
        $("#barangay").html(result);
      });
    });
    $(document).on("change", "#municipality2", function() {
      let value = $(this).val();
      $.get("dropdown.php?city=" + value, function(result) {
        $("#barangay2").html(result);
      });
    });
    $(document).ready(function() {
      $('.slider-banner').DrSlider({
        'transition': 'fade',
        showNavigation: false,
        progressColor: "#03A9F4"
      });

      <?= isset($_GET['show_modal']) ? '$("#login_modal").modal("show")' : " " ?>
      <?= isset($_GET['show_modal2']) ? '$("#membership_modal").modal("show")' : " " ?>
    });
  </script>
  </body>

  </html>