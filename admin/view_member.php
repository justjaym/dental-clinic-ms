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
        <h4 class="page-title">View Clinic | ID - <?= $_GET['id'] ?></h4>
        <div class="ms-auto text-end">
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?= (isset($_POST['edit'])) ? editMember(array_merge($_POST, $_FILES)) : ''; ?>
    <div class="row">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" method="post" onsubmit="return confirm('Are you sure?');" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="card-body">
                <?php $id = $_GET['id']; ?>
                <?php $default = get_one("SELECT c.name as `city`,b.name as `barangay`,s.name as `status`,m.* from tbl_member m left join tbl_barangay b on b.id = m.barangay_id left join tbl_city c on c.id = m.city_id inner join tbl_appointment_status s on s.id = m.paid_status_id  where m.id ='$id'") ?>
                <input type="hidden" name="id" value="<?= $default->id ?>">
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">PRC No<span style="color:red">*</span></label>
                  <div class="col-sm-9">
                    <input disabled type="text" class="form-control" id="fname" name="prc_no" required value="<?= $default->prc_no ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">First Name<span style="color:red">*</span></label>
                  <div class="col-sm-4">
                    <input disabled type="text" class="form-control" id="fname" name="first_name" required value="<?= $default->first_name ?>">
                  </div>
                  <label for="fname" class="col-sm-1 text-end control-label col-form-label">Last Name<span style="color:red">*</span></label>
                  <div class="col-sm-4">
                    <input disabled type="text" class="form-control" id="fname" name="last_name" required value="<?= $default->last_name ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Receipt</label>
                  <div class="col-sm-9">
                    <img src="../images/members/<?= $default->qr ?>" alt="" style="width:200px;height:200px">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">City/Municipality<span style="color:red">*</span></label>
                  <div class="col-sm-9">
                    <select disabled name="municipality" id="municipality" class="form-control">
                      <?php foreach (get_list("SELECT * from tbl_city") as $res) { ?>
                        <option value="<?= $res['id'] ?>" <?= ($default->city_id == $res['id']) ? 'selected' : ''  ?>><?= $res['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Barangay<span style="color:red">*</span></label>
                  <div class="col-sm-9">
                    <select disabled name="barangay" id="barangay" class="form-control">
                      <?php foreach (get_list("SELECT * from tbl_barangay where city_id = '($default->city_id ?? 015501)'") as $res) { ?>
                        <option value="<?= $res['id'] ?>" <?= ($default->barangay_id == $res['id']) ? 'selected' : ''  ?>><?= $res['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

              </div>

            </div>
            <div class="modal-footer">
              <a href="members.php" type="button" class="btn btn-secondary">Back to List</a>
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