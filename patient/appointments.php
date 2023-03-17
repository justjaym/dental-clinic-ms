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

        <h4 class="page-title">My Appointments</h4>
        <div class="ms-auto text-end">
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?= (isset($_POST['cancel'])) ? cancel_appointment($_POST['cancel']) : ''; ?>
    <?= (isset($_POST['accept'])) ? reschedule_appointment($_POST['accept']) : ''; ?>
    <div class="row">
      <div class="col-4">
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="table_eto" class="table table-bordered table-striped ">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Status</th>
                  <th>Clinic</th>
                  <th>Services</th>
                  <th>Location</th>
                  <th>Paid/Unpaid</th>
                  <th>Appointment Date</th>
                  <th>Date Created</th>
                  <th style="width: 0.1%;">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach (get_list("SELECT a.id,DATE_FORMAT(a.appointment_date,'%M %d, %Y') as `appointment_date`,DATE_FORMAT(a.date_created,'%M %d, %Y') as `date_created`,c.name as `clinic`,b.name as `barangay`,m.name as `municipality`,p.name as `paid_status`,s.name as `status`,s.id as status_id from tbl_appointment a inner join tbl_clinic c on c.clinic_id = a.clinic_id inner join tbl_user u on u.clinic_id =a.clinic_id and u.access_id = 2 inner join tbl_userinfo ui on ui.id = u.id inner join tbl_barangay b on b.id = ui.barangay inner join tbl_city m on m.id = ui.municipality inner join tbl_appointment_paid_status p on p.id = a.paid_id inner join tbl_appointment_status s on s.id = a.status_id where a.patient_id='" . $_SESSION['user']->id . "'") as $res) { ?>
                  <tr>
                    <td><?= $res['id'] ?></td>
                    <td><?= strtoupper($res['status']) ?></td>
                    <td><?= strtoupper($res['clinic']) ?></td>
                    <td>

                      <?php foreach (get_list("select s.srvc_name as `name` from tbl_appointment_items a inner join tbl_service s on s.id = a.service_id where a.appointment_id = " . $res['id'])  as $subres) { ?>
                        <span class="badge rounded-pill bg-primary"><?= $subres['name'] ?></span>
                      <?php } ?>
                    </td>

                    <td><?= strtoupper($res['barangay'] . ", " . $res['municipality']) ?></td>
                    <td><?= strtoupper($res['paid_status']) ?></td>

                    <td><?= $res['appointment_date']  ?></td>
                    <td><?= $res['date_created'] ?></td>

                    <td style="width: 0.1%;display:flex">
                      <a href="view_appointment.php?id=<?= $res['id'] ?>" class="btn btn-info me-1" type="button">View </a>
                      <?php if ((int)$res['status_id'] > 1) { ?>
                        <button class="btn btn-danger" type="submit" disabled style="margin-right: 4px;">Cancel </button>
                        <form method="post" onsubmit="return confirm('Are you sure?');"><button class="btn btn-danger" type="submit" name="accept" value="<?= $res['id'] ?>" <?= $res['status_id'] == 3 ? '' : 'disabled' ?>>Accept </button></form>
                      <?php } else { ?>
                        <form method="post" onsubmit="return confirm('Are you sure?');"><button class="btn btn-danger" type="submit" name="cancel" value="<?= $res['id'] ?>" style="margin-right: 4px;">Cancel </button></form>
                        <form method="post" onsubmit="return confirm('Are you sure?');"><button class="btn btn-danger" type="submit" name="accept" value="<?= $res['id'] ?>" <?= $res['status_id'] == 3 ? '' : 'disabled' ?>>Accept </button></form>
                      <?php } ?>

                    </td>
                  </tr>
                <?php } ?>

              </tbody>

            </table>
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