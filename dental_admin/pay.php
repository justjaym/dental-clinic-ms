<?php include 'header.php'; ?>
<style>
  input {
    text-transform: uppercase;
  }

  @media print {
    .myDivToPrint {
      background-color: white;
      height: 100%;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      margin: 0;
      padding: 15px;
      font-size: 14px;
      line-height: 18px;
    }
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
        <h4 class="page-title">Appointment #<?= $_GET['id'] ?></h4>

        <div class="ms-auto text-end">

          <a href="appointments.php" class="btn btn-info col-12" type="button" style="margin-right: 4px;">Back To Appointment</a>

        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid myDivToPrint">
    <?php function pay($data)
    {
      extract($data);
      if ($total > $paid_amount) {
        return error_message("Paid Ammount Insuficient!");
      }

      query("update tbl_appointment set paid_amount = '$paid_amount', change_amount = '$change_val', paid_id = 2 where id = $pay");
      return success_message("Transaction Paid!");
    } ?>
    <?= (isset($_POST['pay'])) ? pay($_POST) : ''; ?>
    <?php $main = get_one("select * from tbl_appointment where id = " . $_GET['id']); ?>
    
    <form method=" post" onsubmit="return confirm('Are you sure?');">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="table-responsive">
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
                            <input type="hidden" id="total" value="<?= $tmp ?>" name="total">
                          </tr>
                          <tr>
                            <td style="font-weight:bold" colspan="3">PAID AMOUNT</td>
                            <td style="text-align:right;font-weight:bold"><input type="number" name="paid_amount" id="paid_amount" value="<?= $main->paid_amount ?? 0 ?>" <?= $main->paid_id == 2 ? 'disabled' : '' ?>></td>
                            
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
                  
                </div>
                <script>
                  var paid_amount = document.getElementById('paid_amount');
                  
                  function totalPrice() {
                    var grand_total = 0;
                    var total = document.getElementById('total');
                    var change = document.getElementById('change');
                    var change_val = document.getElementById('change_val');
                    grand_total = parseInt(paid_amount.value) - parseInt(total.value);
                    change_val.value = grand_total;
                    change.innerText = grand_total;
                  }
                  paid_amount.addEventListener("change", () => {
                    totalPrice();
                  });
                  </script>
                <?php $clinic_details = get_clinic(get_one("SELECT clinic_id from tbl_appointment where id = $id")->clinic_id); ?>
                <?php $appointment_details = get_one("SELECT DATE_FORMAT(appointment_date,'%m-%d-%Y') as appointment_date, remarks,status_id,paid_id,id from tbl_appointment where id = $id"); ?>
                
                
                <div class="col-md-6">
                  
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Clinic:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= isset($clinic_details->name) ? $clinic_details->name : '' ?>" />
                      </div>
                    </div>
                  </div>
                  
                  <input type="hidden" name="id" value="<?= $appointment_details->id ?>">
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Dentist:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <select id="" class="form-control" name="dentist_id" disabled>
                          <?php if (isset($clinic_details)) { ?>
                            <?php foreach (get_list("select u.id,ui.first_name,ui.last_name from tbl_user u inner join tbl_userinfo ui on ui.id = u.id where u.access_id = 3 and u.clinic_id = " . $clinic_details->clinic_id) as $res) { ?>
                              <option value="<?= $res['id'] ?>" <?= ($clinic_details->dentist_id ?? 0) == $res['id'] ? 'selected' : ''  ?>><?= strtoupper($res['first_name'] . ' - ' . $res['last_name']) ?></option>
                            <?php } ?>
                        </select>
                      <?php } ?>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Mode of Payment:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <select id="" class="form-control" name="mode_of_payment" style="width: 100px;" disabled>
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
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= get_appointment_status($appointment_details->status_id) ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">PAID/UNDPAID:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= get_paid_status($appointment_details->paid_id) ?>" />
                      </div>
                    </div>
                  </div>



                  <!-- <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Dental Admin:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= isset($clinic_details->fullname) ? $clinic_details->fullname : '' ?>" />
                      </div>
                    </div>
                  </div> -->

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Municipality:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= isset($clinic_details->municipality) ? $clinic_details->municipality : '' ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Barangay:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= isset($clinic_details->barangay) ? $clinic_details->barangay : '' ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Email:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= isset($clinic_details->email) ? $clinic_details->email : '' ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Contact:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= isset($clinic_details->contact) ? $clinic_details->contact : '' ?>" />
                      </div>
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Appointment Date:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" name="appointment_date" disabled class="form-control mydatepicker" placeholder="mm-dd-yyyy" value="<?= isset($appointment_details->appointment_date) ? $appointment_details->appointment_date : '' ?>" required />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Remarks:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <textarea name="remarks" class="form-control" disabled><?= isset($appointment_details->remarks) ? $appointment_details->remarks : '' ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div style="display:flex">

                    <button class="btn btn-info w-50 me-1" type="submit" name="pay" value="<?= $appointment_details->id ?>" <?= $main->paid_id == 2 ? 'disabled' : '' ?>> Pay</button>
                    <button class="btn btn-info w-50" type="button" id="print"  onclick="window.print()"> Print</button>
                    <!-- <?= $main->paid_id == 1 ? 'disabled' : '' ?> -->
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>

    </form>


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
    });
  </script>