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

          <a href="appointments.php" class="btn btn-info col-12" type="button" style="margin-right: 4px;">Back To Appointment List</a>

        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?= (isset($_POST['accept'])) ? accept_appointment($_POST['accept']) : ''; ?>
    <?= (isset($_POST['reject'])) ? reject_appointment($_POST) : ''; ?>
    <?= (isset($_POST['paid'])) ? paid_appointment($_POST['paid']) : ''; ?>
    <?= (isset($_POST['upload'])) ? uplaod_teethv(array_merge($_POST, $_FILES)) : ''; ?>
    <?php $id = $_GET['id']  ?>
    <?php $clinic_details = get_clinic(get_one("SELECT clinic_id from tbl_appointment where id = $id")->clinic_id); ?>
    <?php $appointment_details = get_one("SELECT DATE_FORMAT(appointment_date,'%m-%d-%Y') as appointment_date, remarks,status_id,paid_id,id,patient_id from tbl_appointment where id = $id"); ?>
    <?php $patient_details = get_patient((int)$appointment_details->patient_id); ?>
    <?php $clinic_details = get_clinic(get_one("SELECT clinic_id from tbl_appointment where id = $id")->clinic_id); ?>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

              <div class="col-md-12">
                <form method="post" onsubmit="return confirm('Are you sure?');" enctype="multipart/form-data">
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Clinic:</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= isset($clinic_details->name) ? $clinic_details->name : '' ?>" />
                        <input type="hidden" value="<?= $clinic_details->clinic_id ?>" name="clinic_id" />
                        <input type="hidden" value="<?= $clinic_details->id ?>" name="id" />
                        <input type="hidden" value="<?= $appointment_details->patient_id ?>" name="patient_id" />
                        <input type="hidden" value="<?= $appointment_details->dentist_id ?>" name="dentist_id" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Dentist:</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <select id="" class="form-control" name="dentist_id" disabled>
                          <?php if (isset($clinic_details)) { ?>
                            <?php foreach (get_list("select u.id,ui.first_name,ui.last_name from tbl_user u inner join tbl_userinfo ui on ui.id = u.id where u.access_id in(3,2) and u.clinic_id = " . $clinic_details->clinic_id) as $res) { ?>
                              <option value="<?= $res['id'] ?>" <?= ($clinic_details->dentist_id ?? 0) == $res['id'] ? 'selected' : ''  ?>><?= strtoupper($res['first_name'] . ' - ' . $res['last_name']) ?></option>
                            <?php } ?>
                        </select>
                      <?php } ?>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Mode of Payment:</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <select id="" class="form-control" name="mode_of_payment" style="width:100px">
                          <?php if (isset($clinic_details)) { ?>
                            <?php foreach (get_list("select * from tbl_mode_of_payment") as $res) { ?>
                              <option value="<?= $res['id'] ?>" <?= ($clinic_details->mode_of_payment ?? 0) == $res['id'] ? 'selected' : ''  ?>><?= strtoupper($res['name']) ?></option>
                            <?php } ?>
                        </select>
                      <?php } ?>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Status:</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= get_appointment_status($appointment_details->status_id) ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">PAID/UNDPAID:</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= get_paid_status($appointment_details->paid_id) ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Appointment Date:</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" name="appointment_date" class="form-control mydatepicker" placeholder="mm-dd-yyyy" value="<?= isset($appointment_details->appointment_date) ? $appointment_details->appointment_date : '' ?>" required />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Remarks:</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <textarea name="remarks" class="form-control" disabled><?= isset($appointment_details->remarks) ? $appointment_details->remarks : '' ?></textarea>
                      </div>
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Name (Patient):</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= strtoupper($patient_details->first_name . " " . $patient_details->last_name) ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Contact (Patient):</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= $patient_details->contact ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Email (Patient):</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= $patient_details->email ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Municipality (Patient):</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= get_municipality($patient_details->municipality) ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Barangay (Patient):</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= get_barangay($patient_details->barangay) ?>" />
                      </div>
                    </div>
                  </div>



                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Teeth:</label>
                    <div class="col-sm-6">
                      <div class="input-group">
                        <input type="file" class="form-control" name="file_name" accept=".jpg,.jpeg,.png" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label"></label>
                    <div class="col-sm-6">
                      <table class="table">
                        <tr>
                          <td>Teeth</td>
                          <td>Status</td>
                        </tr>
                        <?php $items = get_one("select * from tbl_chart where patient_id = " . $appointment_details->patient_id)  ?>
                        <!-- <?php print_r($items) ?> -->
                        <?php $status = array(
                          'D' => 'Decayed (Caries indicated for Filling)',
                          'M' => 'Missing due to Caries',
                          'F' => 'Filled',
                          'I' => 'Caries Indicated for Extraction',
                          'RF' => 'Roof Fragment',
                          'MO' => 'Missing due to Other Causes',
                          'Im' => 'Impacted Tooth',
                          'J' => 'Jacked Crown',
                          'A' => 'Amalgam Filling',
                          'AB' => 'Abutment',
                          'P' => 'Pontic',
                          'In' => 'Inlay',
                          'FX' => 'Fixed Cure Composite',
                          'S' => 'Sealants',
                          'X' => 'Extraction due to Caries',
                          'XO' => 'Extraction due to Other Causes',
                          'C' => 'Present Teeth',
                          'Cm' => 'Congenitally Missing',
                          'Sp' => 'Supermumerary'

                        ); ?>



                        <?php

                        $tmp = array();
                        foreach ($items as $key => $value) {
                          if ($key == 'patient_id' || $key == 'clinic_id' || $key == 'id' || empty($value)) {
                            continue;
                          }
                          echo '<tr>';
                          echo '<td>' . str_replace('status_1_', '', str_replace('status_2_', '', $key)) . '</td>';
                          echo '<td>' . (in_array(strtoupper($value), array_keys($status)) ? strtoupper($status[strtoupper($value)]) : '') . '</td>';
                          echo '</tr>';
                        }

                        // $tmp = array();
                        // foreach ($items as $key => $value) {
                        //   if ($key == 'patient_id' || $key == 'clinic_id' || $key == 'id' || empty($value)) {
                        //     continue;
                        //   }
                        //   $tmp[str_replace('status_1_', '', str_replace('status_2_', '', $key))] = (in_array(strtoupper($value), array_keys($status)) ? strtoupper($status[strtoupper($value)]) : '');
                        // }
                        // asort($tmp);
                        // foreach ($tmp as $key => $value) {
                        //   echo "<tr>";
                        //   echo "<td>$key</td>";
                        //   echo "<td>$value</td>";
                        //   echo "</tr>";
                        // }
                        ?>
                      </table>
                    </div>
                    <input type="hidden" value="<?= $appointment_details->id ?>" name="id">

                    <div class=" text-center">
                      <button class="btn btn-info" style="width:10%" type="submit" name="accept" value="<?= $appointment_details->id ?>" <?= ($appointment_details->status_id > 1) ? 'disabled' : '' ?>> ACCEPT</button>
                      <!-- <button class="btn btn-info" style="width:10%" type="submit" name="paid" value="<?= $appointment_details->id ?>" <?= ($appointment_details->paid_id > 1) ? 'disabled' : '' ?>> PAID</button> -->
                      <button class="btn btn-info" style="width:10%" type="submit" name="reject" value="<?= $appointment_details->id ?>" <?= ($appointment_details->status_id > 1) ? 'disabled' : '' ?>> RESCHEDULE</button>
                      <button class="btn btn-info" style="width:10%" type="submit" name="upload"> UPLOAD</button>
                      <a href="view_receipt.php?id=<?= $appointment_details->id ?>" class="btn btn-secondary" style="width:20%">View Receipt</a>
                      <a href="view_record.php?id=<?= $appointment_details->patient_id ?>" class="btn btn-secondary" style="width:20%">View Patient Chart</a>
                    </div>
                </form>
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

  <script>
    jQuery(".mydatepicker").datepicker({
      format: 'mm-dd-yyyy',
      startDate: '+1d'
    });
  </script>