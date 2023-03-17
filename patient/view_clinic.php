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
      <div class="col-12 d-flex no-block align-items-center" style="margin-bottom: 6px;">
        <h4 class="page-title">Provincial Dental Clinic</h4>

        <div class="ms-auto text-end" style="margin-left: 48.8vw!important">
          <div class="d-flex">
            <a href="clinics.php" class="btn btn-info col-6" type="button" style="margin-right: 4px;">Clinic List</a>
            <a href="view_cart.php" class="btn btn-info col-6" type="button">Checkout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">

    <?= (isset($_POST['service_id'])) ? add_to_cart($_POST) : ''; ?>
    <div class="row">
      <?php $clinic_id = $_GET['clinic_id']; ?>
      <?php $clinic = get_one("SELECT c.`image`,c.description,c.name as `clinic_name`,m.name as `municipality`,b.name as `barangay`,ui.email,ui.contact,u.id,u.clinic_id,concat(ui.first_name,' ',ui.last_name) as fullname from tbl_user u inner join tbl_userinfo ui on ui.id = u.id inner join tbl_clinic c on c.clinic_id = u.clinic_id inner join tbl_city m on m.id = ui.municipality inner join tbl_barangay b on b.id = ui.barangay where u.clinic_id = $clinic_id") ?>
      <div class="col-md-12">
        <div class="card">
          <div class="row">
            <div class="col-md-4 text-center">
              <img src="../images/clinic/<?= $clinic->image ?>" alt="" class="img-fluid border-top" style="max-height:200px;object-fit:contain">
            </div>
            <div class="col-md-8" style="padding: 20px;">
              <h5 class="text-center"><?= strtoupper($clinic->clinic_name) ?></h5>
              <p>
                <?= ucfirst($clinic->description) ?>
              </p>
              <div class="row">
                <div class="col-md-6">
                  <ul style=" list-style-type: none;">
                    <li><i class="fa fa-map-marker"></i> MUNICIPALITY: <?= strtoupper($clinic->municipality) ?></li>
                    <li><i class="fa fa-map-marker"></i> BARANGAY: <?= strtoupper($clinic->barangay) ?></li>
                  </ul>
                </div>
                <div class="col-md-6">
                  <ul style=" list-style-type: none;">
                    <li><i class="fa fa-envelope"></i> EMAIL: <?= ucfirst($clinic->email) ?></li>
                    <li><i class="fa fa-phone"></i> CONTACT: <?= strtoupper($clinic->contact) ?></li>
                  </ul>
                </div>
                <!-- <div class="col-md-12">
                  <p style="float:right;margin-right:50px"><i>DENTIST ADMIN: <span style="text-decoration: underline;"><?= strtoupper($clinic->fullname) ?> </i></span></p>
                </div> -->
              </div>

            </div>

          </div>
        </div>
      </div>


      <?php $products =  get_list("SELECT * from tbl_product p where p.clinic_id = $clinic_id") ?>
      <?php if (!empty($products)) { ?>
        <div class="row">
          <div class="col-12">
            <h4 class="page-title text-center" style="margin-bottom:14px">Products</h4>
          </div>
        </div>
        <div class="row d-flex flex-row flex-nowrap" style="overflow-y: auto; ">
          <?php foreach ($products as $res) { ?>
            <div class="col-md-3">

              <div class="card">
                <img src="../images/products/<?= $res['image'] ?>" alt="" style="height:150px;object-fit:contain">
                <div class="card-body">
                  <h5 class="card-title"><?= strtoupper($res['prod_name']) ?></h5>
                  <p class="card-text"> <?= ucfirst($res['prod_desc']) ?></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>

      <?php $services =  get_list("SELECT * from tbl_service s where s.clinic_id = $clinic_id") ?>
      <?php if (!empty($services)) { ?>
        <div class="row">
          <div class="col-12">
            <h4 class="page-title text-center" style="margin-bottom:14px">Services</h4>
          </div>
        </div>
        <div class="row">
          <?php foreach ($services as $res) { ?>
            <div class="col-md-3">
              <div class="card">
                <div class="d-flex" style="justify-content: space-between;padding:10px 20px">
                  <h4 class="card-title" style="margin-bottom: 0px;"><?= strtoupper($res['srvc_name']) ?></h4>
                  <h4 class="card-title" style="font-weight: bold; margin-bottom: 0px;"><?= number_format($res['srvc_price'], 2); ?></h4>
                </div>
                <div class="card-body border-top">
                  <p>


                    <?= convertTime($res['srvc_time']) ?><br>
                    <?= ucfirst($res['srvc_desc']) ?>
                  </p>
                </div>
                <div class="border-top">
                  <div class="card-body">
                    <form method="post">
                      <div class="input-group">
                        <input type="number" class="form-control" name="qty" value="1">
                        <input type="hidden" name="price" value="<?= $res['srvc_price'] ?>">
                        <input type="hidden" name="clinic_id" value="<?= $res['clinic_id'] ?>">
                        <input type="hidden" name="name" value="<?= $res['srvc_name'] ?>">
                        <input type="hidden" name="time" value="<?= $res['srvc_time'] ?>">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-info" name="service_id" value="<?= $res['id'] ?>">Add To Cart</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>


    </div>
  </div>



  <!-- ============================================================== -->
  <!-- End footer -->
  <!-- ============================================================== -->

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


  $('#table_eto').DataTable();
</script>