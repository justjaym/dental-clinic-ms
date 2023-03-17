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
    <?= (isset($_POST['editproducts'])) ? editProducts(array_merge($_POST, $_FILES)) : ''; ?>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return confirm('Are you sure?');" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="card-body">
                <?php $id = $_GET['id']; ?>
                <?php $default = get_one("select p.id,p.clinic_id,p.prod_name,p.prod_desc,p.prod_price from tbl_product p where p.id = '$id'") ?>
                <input type="hidden" name="id" value="<?= $default->id ?>">
                <input type="hidden" name="clinic_id" value="<?= $default->clinic_id ?>">
                <h4 class="card-title">Product Information Entry</h4>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Enter Product Name<span style="color:red">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="fname" name="prod_name" required value="<?= $default->prod_name ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Description<span style="color:red">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="fname" name="prod_desc" required value="<?= $default->prod_desc ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Price<span style="color:red">*</span></label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="fname" name="prod_price" required value="<?= $default->prod_price ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Product Image<span style="color:red">*</span></label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" name="image_koto" accept=".jpg,.jpeg,.png">
                        </div>

                      </div>
              </div>

            </div>
            <div class="modal-footer">
              <a href="products.php" type="button" class="btn btn-secondary">Back to List</a>
              <button type="submit" class="btn btn-info" name="editproducts">Update</button>
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