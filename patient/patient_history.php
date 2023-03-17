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


          <?php foreach (get_list("select * from tbl_appointment where patient_id = " . $_SESSION['user']->id) as $res) { ?>
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
                <?php $id = $_SESSION['user']->id  ?>
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