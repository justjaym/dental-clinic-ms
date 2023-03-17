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

        <h4 class="page-title">Manage Clinic Products</h4>

        <div class="ms-auto text-end">
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-4">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Add Products
        </button>
      </div>
      <br>
      <br>
      <div class="card">
        <div class="card-body">
        <?= (isset($_POST['addproduct'])) ? addProduct(array_merge($_POST, $_FILES)) : ''; ?>
        <?= (isset($_POST['deleteproduct'])) ? deleteProduct($_POST['deleteproduct']) : ''; ?>
          <div class="table-responsive">
            <table id="table_eto" class="table table-bordered table-striped ">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Product Name</th>
                  <th>Description</th>
                  <th>Price</th>
                  <th style="width: 0.1%;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php $cid = $_SESSION['user']->clinic_id ?>
                <?php foreach (get_list("SELECT p.id,p.prod_name,p.prod_desc,p.prod_price,p.image from tbl_clinic u inner join tbl_product p on p.clinic_id = u.clinic_id where p.clinic_id=$cid") as $res) { ?>
                  <tr>
                    <td><?= $res['id'] ?></td>
                    <td><img src="../images/products/<?= $res['image'] ?>" alt="" width="30px" height="30px"></td>
                    <td><?= $res['prod_name'] ?></td>
                    <td><?= $res['prod_desc'] ?></td>
                    <td><?= $res['prod_price'] ?></td>
                    <td style="width: 0.1%;display:flex">
                    <a href="edit_products.php?id=<?= $res['id'] ?>" class="btn btn-success me-1" type="button">Edit </a>
                      <form method="post" onsubmit="return confirm('Are you sure?');">
                        <button class="btn btn-danger" type="submit" name="deleteproduct" value="<?= $res['id'] ?>">Delete </button>
                      </form>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>

            </table>
          </div>

        </div>
      </div>



      <!-- MODAL STARTS HERE -->
      <div class="col-md-12">
        <div class="card">
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <form class="form-horizontal" method="post" onsubmit="return confirm('Are you sure?');" enctype="multipart/form-data">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Adding Dental Clinic Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="card-body">
                      <h4 class="card-title">Product Information Entry</h4>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Enter Product Name<span style="color:red">*</span></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="fname" name="prod_name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Description<span style="color:red">*</span></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="fname" name="prod_desc" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Price<span style="color:red">*</span></label>
                        <div class="col-sm-6">
                          <input type="number" class="form-control" id="fname" name="prod_price" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">Product Image<span style="color:red">*</span></label>
                        <div class="col-sm-6">
                          <input type="file" class="form-control" name="image_koto" required accept=".jpg,.jpeg,.png">
                        </div>

                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" name="addproduct">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>


        </div>
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
  $('#table_eto').DataTable();
</script>