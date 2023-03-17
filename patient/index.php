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
      <?php $id = $_SESSION['user']->id ?>
      <?php $default = get_one("select u.id,ui.first_name,ui.municipality,ui.barangay,ui.email,ui.contact,u.username,u.password from tbl_user u inner join tbl_userinfo ui on ui.id = u.id where u.id = '$id'") ?>
      <!-- <h4 class="page-title">Welcome </h4> -->

      <div class="ms-auto text-end">
        <div id='calendar'></div>
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: [
        <?php
        $list = get_list("select a.*,i.*,c.*,s.*,ui.first_name,ui.last_name from tbl_appointment a inner join tbl_appointment_items i on i.appointment_id = a.id inner join tbl_clinic c on c.clinic_id = a.clinic_id inner join tbl_service s on s.id = i.service_id inner join tbl_userinfo ui on ui.id = a.dentist_id");
        $ctr = 0;
        $defaultStartTime = (float)8;
        $oldDate = '';
        ?>

        <?php foreach ($list as $res) { ?>
          <?php $ctr++;
          if ($oldDate == '') $oldDate = $res['appointment_date'];
          if ($oldDate != $res['appointment_date']) {
            $oldDate = $res['appointment_date'];
            $defaultStartTime = 8;
          }
          if ($_SESSION['user']->id == $res['patient_id']) { ?> {

              title: '<?= $res['name'] . " " . $res['first_name'] . " " . $res['last_name'] . " " . $res['srvc_name'] ?>',
              start: '<?= $oldDate ?>T<?= str_replace('.', ':', strlen($defaultStartTime) > 1 ? $defaultStartTime : "0" . $defaultStartTime) ?>:00',
              <?php $defaultStartTime = ($oldDate != $res['appointment_date']) ? 8 :  $defaultStartTime + (float) $res['appointment_time'] ?>
              end: '<?= $res['appointment_date'] ?>T<?= str_replace('.', ':', strlen($defaultStartTime) > 1 ? $defaultStartTime : "0" . $defaultStartTime) ?>:00',
              allDay: false
            }
            <?php $oldDate = $res['appointment_date']; ?>
            <?= $ctr > count($list) - 1 ? '' : ','; ?>
          <?php } else { ?>

            {

              <?php $defaultStartTime = ($oldDate != $res['appointment_date']) ? 8 :  $defaultStartTime + (float) $res['appointment_time'] ?>
            }
            <?php $oldDate = $res['appointment_date']; ?>
            <?= $ctr > count($list) - 1 ? '' : ','; ?>

          <?php
          }
          ?>

        <?php          } ?>

      ]
    });
    calendar.render();
  });
</script>