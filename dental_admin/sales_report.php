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

        <h4 class="page-title">Sales Report</h4>
        <div class="ms-auto text-end">
          <form method="get">
            Date From: <input type="date" name="from" value="<?= $_GET['from'] ?? '' ?>">
            Date To: <input type="date" name="to" value="<?= $_GET['to'] ?? '' ?>">
            <input type="submit" name="filter" value="Filter" class="btn btn-info">
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-4">
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="table_eto" class="table table-bordered table-striped ">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Service</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php $tmp2 = 0 ?>
                <?php $where = !empty($_GET['filter']) ? ' and a.appointment_date BETWEEN  "' . $_GET['from'] . '" and "' . $_GET['to'] . '"' : '' ?>
                <?php if (isset($_GET['filter'])) { ?>
                  <?php foreach (get_list("SELECT a.appointment_date,s.srvc_name,s.srvc_price from tbl_appointment a inner join tbl_appointment_items i on i.appointment_id = a.id inner join tbl_service s on s.id = i.service_id where a.paid_id = 2 and a.clinic_id = " . $_SESSION['user']->clinic_id . $where) as $res) { ?>
                    <tr>
                      <?php $tmp = date_create($res['appointment_date']); ?>
                      <td><?= date_format($tmp, 'F d, Y') ?></td>
                      <td><?= $res['srvc_name'] ?></td>
                      <td><?= $res['srvc_price'] ?></td>


                    </tr>
                    <?php $tmp2 += $res['srvc_price'] ?>
                  <?php } ?>
                <?php } ?>

              </tbody>

            </table>
            <p style="float:right">

              TOTAL = <?= number_format($tmp2, 2) ?>
            </p>

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
  $('#tasdasdsadable_etso').DataTable();
  $(document).on("change", "#status", function() {
    let value = $(this).val();
    window.location = "appointments.php?status=" + value;
  });
</script>