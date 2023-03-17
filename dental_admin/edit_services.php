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
        <h4 class="page-title">Editing Clinic Staff | ID - <?= $_GET['id'] ?></h4>
        <div class="ms-auto text-end">
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?= (isset($_POST['editservices'])) ? editServices($_POST) : ''; ?>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return confirm('Are you sure?');" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="card-body">
                <?php $id = $_GET['id']; ?>
                <?php $default = get_one("select s.id,s.clinic_id,s.srvc_name,s.srvc_desc,s.srvc_price,s.srvc_time from tbl_service s where s.id = '$id'") ?>
                <input type="hidden" name="id" value="<?= $default->id ?>">
                <input type="hidden" name="clinic_id" value="<?= $default->clinic_id ?>">
                <div class="form-group row">
                  <h4 class="card-title">Service Information Entry</h4>
                  <br><br>
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Enter Service<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="fname" name="srvc_name" required value="<?= $default->srvc_name ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Enter Service Time<span style="color:red">*</span></label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="fname" name="srvc_time" required value="<?= $default->srvc_time ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Description<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="fname" name="srvc_desc" required value="<?= $default->srvc_desc ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Price<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="fname" name="srvc_price" required value="<?= $default->srvc_price ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Image<span style="color:red">*</span></label>
                    <div class="col-sm-9">
                      <input type="file" class="form-control" name="image_koto" accept=".jpg,.jpeg,.png">
                    </div>

                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <a href="services.php" type="button" class="btn btn-secondary">Back to List</a>
              <button type="submit" class="btn btn-info" name="editservices">Update</button>
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