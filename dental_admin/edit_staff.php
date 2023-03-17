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
        <h4 class="page-title">Editing Clinic Dentist/Clerk | ID - <?= $_GET['id'] ?></h4>
        <div class="ms-auto text-end">
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?= (isset($_POST['editstaff'])) ? editStaff($_POST) : ''; ?>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return confirm('Are you sure?');" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="card-body">
                <?php $id = $_GET['id']; ?>
                <?php $default = get_one("select u.id,c.clinic_id,ui.first_name,ui.last_name,ui.email,ui.contact,u.username,u.password from tbl_user u inner join tbl_clinic c on c.clinic_id = u.clinic_id inner join tbl_userinfo ui on ui.id = u.id where u.id = '$id'") ?>
                <input type="hidden" name="id" value="<?= $default->id ?>">
                <input type="hidden" name="clinic_id" value="<?= $default->clinic_id ?>">
                <div class="form-group row">
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">First Name<span style="color:red">*</span></label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="fname" name="first_name" required value="<?= $default->first_name ?>">
                  </div>
                  <label for="fname" class="col-sm-1 text-end control-label col-form-label">Last Name<span style="color:red">*</span></label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="fname" name="last_name" required value="<?= $default->last_name ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Username<span style="color:red">*</span></label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="fname" name="username" required value="<?= $default->username ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*).{6,}" title="Must contain at least one number and lowercase letter, and at least 6 or more characters">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Password<span style="color:red">*</span></label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="fname" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="validate" required value="<?= $default->password ?>"><span>Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">E-mail<span style="color:red">*</span></label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="fname" name="email" required value="<?= $default->email ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Contact No.<span style="color:red">*</span></label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="fname" name="contact" required value="<?= $default->contact ?>">
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <a href="staffs.php" type="button" class="btn btn-secondary">Back to List</a>
              <button type="submit" class="btn btn-info" name="editstaff">Update</button>
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