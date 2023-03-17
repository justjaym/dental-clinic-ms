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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: [
        <?php
        $list = get_list("select a.*,ui.*,i.*,c.*,s.*,a.id as appointment_id from tbl_appointment a inner join tbl_appointment_items i on i.appointment_id = a.id inner join tbl_clinic c on c.clinic_id = a.clinic_id inner join tbl_service s on s.id = i.service_id inner join tbl_userinfo ui on  ui.id = a.patient_id where a.clinic_id = " . $_SESSION['user']->clinic_id);
        // echo
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
          ?> {

            title: '<?= $res['first_name'] . " " . $res['last_name'] . " - " . $res['srvc_name'] ?>',
            start: '<?= $oldDate ?>T<?= str_replace('.', ':', strlen($defaultStartTime) > 1 ? $defaultStartTime : "0" . $defaultStartTime) ?>:00',
            <?php $defaultStartTime = ($oldDate != $res['appointment_date']) ? 8 :  $defaultStartTime + (float) $res['appointment_time'] ?>
            end: '<?= $res['appointment_date'] ?>T<?= str_replace('.', ':', strlen($defaultStartTime) > 1 ? $defaultStartTime : "0" . $defaultStartTime) ?>:00',
            allDay: false,
            url: 'view_appointment.php?id=<?= $res['appointment_id'] ?>'
          }
          <?php $oldDate = $res['appointment_date']; ?>
          <?= $ctr > count($list) - 1 ? '' : ','; ?>





        <?php          } ?>

      ]
    });
    calendar.render();
  });
</script>
<?php include 'footer.php'; ?>