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
        <h4 class="page-title">Patient History</h4>
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
                <?php $id = $_GET['id'] ?>
                <?php $default = get_one("select u.id,ui.municipality,ui.barangay,ui.email,ui.contact,u.username,u.password,ui.first_name,ui.last_name from tbl_user u inner join tbl_userinfo ui on ui.id = u.id where u.id = '$id'") ?>
                <input type="hidden" name="id" value="<?= $default->id ?>">
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">First Name</label>
                  <div class="col-sm-4">
                    <input disabled type="text" class="form-control" id="fname" name="first_name" required value="<?= $default->first_name ?>">
                  </div>
                  <label for="fname" class="col-sm-1 text-end control-label col-form-label">Last Name</label>
                  <div class="col-sm-4">
                    <input disabled type="text" class="form-control" id="fname" name="last_name" required value="<?= $default->last_name ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Username</label>
                  <div class="col-sm-9">
                    <input disabled type="text" class="form-control" id="fname" name="username" required value="<?= $default->username ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">City/Municipality</label>
                  <div class="col-sm-9">
                    <select disabled name="municipality" id="municipality" class="form-control">
                      <?php foreach (get_list("SELECT * from tbl_city") as $res) { ?>
                        <option value="<?= $res['id'] ?>" <?= ($default->municipality == $res['id']) ? 'selected' : ''  ?>><?= $res['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Barangay</label>
                  <div class="col-sm-9">
                    <select disabled name="barangay" id="barangay" class="form-control">
                      <?php foreach (get_list("SELECT * from tbl_barangay where city_id = '$default->municipality'") as $res) { ?>
                        <option value="<?= $res['id'] ?>" <?= ($default->barangay == $res['id']) ? 'selected' : ''  ?>><?= $res['name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">E-mail</label>
                  <div class="col-sm-9">
                    <input disabled type="email" class="form-control" id="fname" name="email" required value="<?= $default->email ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="fname" class="col-sm-3 text-end control-label col-form-label">Contact No.</label>
                  <div class="col-sm-9">
                    <input disabled type="number" class="form-control" id="fname" name="contact" required value="<?= $default->contact ?>">
                  </div>
                </div>
              </div>

            </div>

          </form>

          <?php foreach (get_list("select * from tbl_appointment where patient_id = " . $_GET['id']) as $res) { ?>
            <div class="table-responsive">
              <h5> Appointment ID# <?= $res['id'] ?> - <?= $res['paid_id'] == 1 ? 'UNPAID' : 'PAID' ?> <span style="float:right">Appointment Date:<?= $res['appointment_date'] ?></span></h5>
              <table id="table_eto" class="table table-bordered table-striped ">
                <thead>
                  <tr>
                    <th>Service</th>
                    <th style="width: 0.1%;">Qty</th>
                    <th>Approx Time</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <?php $tmp = 0 ?>
                <?php $tmptime = 0 ?>
                <?php $id = $_GET['id']  ?>
                <tbody>

                  <?php foreach (get_list("SELECT i.*,s.srvc_name from tbl_appointment_items i inner join tbl_service s on s.id = i.service_id where i.appointment_id = " . $res['id']) as $key => $res2) { ?>
                    <tr>
                      <td><?= $res2['srvc_name'] ?></td>
                      <td><?= $res2['qty'] ?></td>
                      <td style="text-align:right"><?= convertTime($res2['appointment_time']) ?></td>
                      <td style="text-align:right"><?= number_format($res2['price'] * $res2['qty'], 2) ?></td>
                    </tr>
                    <?php $tmp += ($res2['price'] * $res2['qty']); ?>
                    <?php $tmptime += ($res2['appointment_time'] * $res2['qty']); ?>
                  <?php } ?>

                  <tr>
                    <td style="font-weight:bold" colspan="2">TOTAL</td>
                    <td style="text-align:right;font-weight:bold"><?= convertTime($tmptime) ?></td>
                    <td style="text-align:right;font-weight:bold"><?= number_format($tmp, 2) ?></td>
                    <input type="hidden" id="total" value="<?= $tmp ?>" name="total">
                  </tr>
                  <tr>
                    <td style="font-weight:bold" colspan="3">PAID AMOUNT</td>
                    <td style="text-align:right;font-weight:bold"><?= $main->paid_amount ?? 0 ?></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold" colspan="3">CHANGE</td>
                    <td style="text-align:right;font-weight:bold" id="change">
                      <?= $main->change_amount ?? 0 ?>
                      <input type="hidden" name="change_val" id="change_val">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          <?php } ?>
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