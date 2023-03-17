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
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center">
        <h4 class="page-title">Editing Clinic Details</h4>
        <div class="ms-auto text-end">
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?= (isset($_POST['edituser'])) ? editUserDetails($_POST) : ''; ?>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return confirm('Are you sure?');" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="card-body">
                <?php $id = $_SESSION['user']->id ?>
                <?php $default = get_one("select u.id,ui.municipality,ui.barangay,ui.email,ui.contact,u.username,u.password,ui.first_name,ui.last_name from tbl_user u inner join tbl_userinfo ui on ui.id = u.id where u.id = '$id'") ?>
                <input type="hidden" name="id" value="<?= $default->id ?>">
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">First Name</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="fname" name="first_name" required value="<?= $default->first_name ?>">
                  </div>
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Last Name</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="fname" name="last_name" required value="<?= $default->last_name ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Username</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="fname" name="username" required value="<?= $default->username ?>">
                  </div>
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Password</label>
                  <div class="col-sm-3">
                    <input type="password" class="form-control" id="fname" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="validate" required value="<?= $default->password ?>" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">City/Municipality</label>
                  <div class="col-sm-3">
                    <select name="municipality" id="municipality" class="form-control">
                      <?php foreach (get_list("SELECT * from tbl_city") as $res) { ?>
                        <option value="<?= $res['id'] ?>" <?= ($default->municipality == $res['id']) ? 'selected' : ''  ?>><?= $res['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Barangay</label>
                  <div class="col-sm-3">
                    <select name="barangay" id="barangay" class="form-control">
                      <?php foreach (get_list("SELECT * from tbl_barangay where city_id = '$default->municipality'") as $res) { ?>
                        <option value="<?= $res['id'] ?>" <?= ($default->barangay == $res['id']) ? 'selected' : ''  ?>><?= $res['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">E-mail</label>
                  <div class="col-sm-3">
                    <input type="email" class="form-control" id="fname" name="email" required value="<?= $default->email ?>">
                  </div>
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Contact No.</label>
                  <div class="col-sm-3">
                    <input type="number" class="form-control" id="fname" name="contact" required value="<?= $default->contact ?>">
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-info" name="edituser">Update</button>
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
</script>