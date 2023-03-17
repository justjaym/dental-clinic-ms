<?php include 'header.php'; ?>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <?php $id = $_GET['id']; ?>
  <?php $default = get_one("select u.id,c.clinic_id,c.image,c.name,ui.municipality,ui.barangay,c.description,ui.email,ui.contact,u.username,u.password,c.prc_no,c.prc_id from tbl_user u inner join tbl_clinic c on c.clinic_id = u.clinic_id inner join tbl_userinfo ui on ui.id = u.id where u.id = '$id'") ?>
  <?php $user = get_one("select ui.first_name,ui.last_name  from tbl_userinfo ui inner join tbl_user u on u.id = ui.id  where u.access_id = 2 and u.clinic_id = " . $default->clinic_id) ?>
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Edit Clinic | <?= $default->name ?></h4>
        <div class="ms-auto text-end">
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?= (isset($_POST['edit'])) ? editClinic(array_merge($_POST, $_FILES)) : ''; ?>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return confirm('Are you sure?');" enctype="multipart/form-data" id="my-form">
            <div class="modal-body">
              <div class="card-body">
                <input type="hidden" name="id" value="<?= $default->id ?>">
                <input type="hidden" name="clinic_id" value="<?= $default->clinic_id ?>">
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Clinic Name<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="fname" name="clinic_name" required value="<?= $default->name ?>">
                  </div>
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">PRC No<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="fname" name="prc_no" required value="<?= $default->prc_no ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">City/Municipality<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <select name="municipality" id="municipality" class="form-control">
                      <?php foreach (get_list("SELECT * from tbl_city") as $res) { ?>
                        <option value="<?= $res['id'] ?>" <?= ($default->municipality == $res['id']) ? 'selected' : ''  ?>><?= $res['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Barangay<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <select name="barangay" id="barangay" class="form-control">
                      <?php foreach (get_list("SELECT * from tbl_barangay where city_id = '$default->municipality'") as $res) { ?>
                        <option value="<?= $res['id'] ?>" <?= ($default->barangay == $res['id']) ? 'selected' : ''  ?>><?= $res['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Username<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="username" name="username" required value="<?= $default->username ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*).{6,}" title="Must contain at least one number and lowercase letter, and at least 6 or more characters">
                  </div>
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Password<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="validate" required value="<?= $default->password ?>" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">First Name<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="fname" name="first_name" required value="<?= $user->first_name ?>">
                  </div>
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Last Name<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="fname" name="last_name" required value="<?= $user->last_name ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">E-mail<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <input type="email" class="form-control" id="email" name="email" required value="<?= $default->email ?>">
                  </div>
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Contact No.<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <input type="number" pattern="" class="form-control" id="fname" name="contact" required value="<?= $default->contact ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Clinic Logo<span style="color:red">*</span></label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="image_koto" accept=".jpg,.jpeg,.png">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Description<span style="color:red">*</span></label>
                  <div class="col-sm-9">
                    <textarea class="form-control" name="description" required><?= $default->description ?></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">PRC ID</label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="prc_id" accept=".jpg,.jpeg,.png">
                  </div>

                  <!-- <img src="../images/clinic/prc/<?= $default->prc_id ?>" alt="" style="witdh:200px;height:200px"> -->
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Mayor's Permit</label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="mayors_permit" accept=".jpg,.jpeg,.png">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Business Permit </label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="business_permit" accept=".jpg,.jpeg,.png">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">DTI Permit</label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="dti" accept=".jpg,.jpeg,.png">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Barangay Clearance</label>
                  <div class="col-sm-9">
                    <input type="file" class="form-control" name="barangay_clearance" accept=".jpg,.jpeg,.png">
                  </div>
                </div>

              </div>

            </div>
            <div class="modal-footer">
              <a href="clinics.php" type="button" class="btn btn-secondary">Back to List</a>
              <button type="button" class="btn btn-info" id="send_email">Send Email</button>
              <button type="submit" class="btn btn-info" name="edit">Update</button>
            </div>
          </form>

        </div>
      </div>

      <!-- Button trigger modal -->





    </div>
  </div>
  <!-- ============================================================== -->
  <!-- End footer -->
  <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>

<?php include 'footer.php'; ?>

<script>
  $(document).on("change", "#municipality", function() {
    let value = $(this).val();
    $.get("../dropdown.php?city=" + value, function(result) {
      $("#barangay").html(result);
    });
  });

  var form = document.getElementById("my-form");

  async function handleSubmit(event) {
    event.preventDefault();
    var status = document.getElementById("my-form-status");
    let email = document.getElementById("email").value;
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    var data = new FormData();
    let message = "Account Successfully Created Username:" + username + "Password:" + password;
    data.append("email", email);
    data.append("message", message);
    fetch("https://formspree.io/f/meqweyob", {
      method: form.method,
      body: data,
      headers: {
        'Accept': 'application/json'
      }
    });

  }
  document.getElementById("send_email").addEventListener("click", handleSubmit)
</script>