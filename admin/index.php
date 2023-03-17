<?php include 'header.php'; ?>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
  <style>
    .img-height {
      height: 400px;
      object-fit: contain;
    }
  </style>
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">



      <div class="ms-auto text-end my-5">
        <div class="row">

          <div class="col-md-6">
            <div class="card">
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="bg-dark p-10 text-white text-center">
                    <i class="mdi mdi-account fs-3 mb-1 font-16"></i>
                    <h5 class="mb-0 mt-1"><?= get_one("SELECT count(clinic_id) as `result` from tbl_clinic")->result ?? 0 ?></h5>
                    <small class="font-light">Total Clinic</small>
                  </div>
                </div>
              </form>
            </div>
          </div>


          <div class="col-md-6">
            <div class="card">
              <form class="form-horizontal">
                <div class="card-body">
                  <div class="bg-dark p-10 text-white text-center">
                    <i class="mdi mdi-account fs-3 mb-1 font-16"></i>
                    <h5 class="mb-0 mt-1"><?= get_one("SELECT count(id) as `result` from tbl_member")->result ?? 0 ?></h5>
                    <small class="font-light">Total Member</small>
                  </div>
                </div>
              </form>
            </div>
          </div>


        </div>
      </div>

    </div>

  </div>
  <footer class="footer text-center">
  </footer>
  <!-- ============================================================== -->
  <!-- End footer -->
  <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>

<?php include 'footer.php'; ?>