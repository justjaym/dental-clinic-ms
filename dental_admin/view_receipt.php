<?php include 'header.php'; ?>
<style>
  input {
    text-transform: uppercase;
  }
</style>
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
        <h4 class="page-title">Viewing Appointment #<?= $_GET['id'] ?></h4>

        <div class="ms-auto text-end">

          <a href="view_appointment.php?id=<?= $_GET['id'] ?>" class="btn btn-info col-12" type="button" style="margin-right: 4px;">Back To Appointment Details</a>

        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?= (isset($_POST['accept'])) ? accept_appointment($_POST['accept']) : ''; ?>
    <?= (isset($_POST['reject'])) ? reject_appointment($_POST['reject']) : ''; ?>
    <?= (isset($_POST['paid'])) ? paid_appointment($_POST['paid']) : ''; ?>
    <?php $id = $_GET['id']  ?>
    <?php $clinic_details = get_clinic(get_one("SELECT clinic_id from tbl_appointment where id = $id")->clinic_id); ?>
    <?php $appointment_details = get_one("SELECT DATE_FORMAT(appointment_date,'%m-%d-%Y') as appointment_date, remarks,status_id,paid_id,id,patient_id,image from tbl_appointment where id = $id"); ?>
    <?php $patient_details = get_patient((int)$appointment_details->patient_id); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">


                <form method="post">
                  <div class="table-responsive">
                    <table id="table_eto" class="table table-bordered table-striped ">
                      <thead>
                        <tr>
                          <th>Service</th>
                          <th style="width: 0.1%;">Qty</th>
                          <th >Approx Time</th>
                          <th>Price</th>
                        </tr>
                      </thead>
                      <?php $tmp = 0 ?>
                      <?php $tmptime = 0 ?>

                      <tbody>

                        <?php foreach (get_list("SELECT i.*,s.srvc_name from tbl_appointment_items i inner join tbl_service s on s.id = i.service_id where i.appointment_id = $id") as $key => $res) { ?>
                          <tr>
                            <td><?= $res['srvc_name'] ?></td>
                            <td><?= $res['qty'] ?></td>
                            <td style="text-align:right"><?= convertTime($res['appointment_time']) ?></td>
                            <td style="text-align:right"><?= number_format($res['price'] * $res['qty'], 2) ?></td>
                          </tr>
                          <?php $tmp += ($res['price'] * $res['qty']); ?>
                          <?php $tmptime += ($res['appointment_time'] * $res['qty']); ?>
                        <?php } ?>

                        <tr>
                          <td style="font-weight:bold" colspan="2">TOTAL</td>
                          <td style="text-align:right;font-weight:bold"><?= convertTime($tmptime) ?></td>
                          <td style="text-align:right;font-weight:bold"><?= number_format($tmp, 2) ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </form>
                <p>Patient Teeth Image</p>
                <img src="../images/teeth/<?= $appointment_details->image ?>" alt="" style="witdh:200px;height:200px">
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


  <?php include 'footer.php'; ?>