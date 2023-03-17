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
        <h4 class="page-title">Provincial Dental Clinic</h4>

        <div class="ms-auto text-end">

          <a href="clinics.php" class="btn btn-info col-12" type="button" style="margin-right: 4px;">Back To Clinic List</a>

        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?= (isset($_POST['update_cart'])) ? update_cart($_POST) : ''; ?>
    <?= (isset($_POST['remove'])) ? remove_cart_item($_POST['remove']) : ''; ?>
    <?= (isset($_POST['checkout'])) ? checkout(array_merge($_POST, $_SESSION)) : ''; ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <form method="post">
                  <div class="table-responsive">
                    <table id="table_eto" class="table table-bordered table-striped ">
                      <thead>
                        <tr>
                          <th>Service</th>
                          <th style="width: 0.1%;">Qty</th>
                          <th style="word-break: break-all;">Approx Time</th>
                          <th>Price</th>
                          <th style="width: 0.1%;">Actions</th>
                        </tr>
                      </thead>
                      <?php $tmp = 0 ?>
                      <?php $tmptime = 0 ?>
                      <tbody>
                        <?php if (isset($_SESSION['cart'])) { ?>

                          <?php foreach ($_SESSION['cart'] as $key => $res) { ?>
                            <tr>
                              <td><?= $res['name'] ?></td>
                              <td><input type="number" name="qty[<?= $key ?>]" value="<?= $res['qty'] ?>"></td>
                              <td style="text-align: right;"><?= convertTime($res['time'] * $res['qty']) ?></td>
                              <td style="text-align:right"><?= number_format($res['price'] * $res['qty'], 2) ?></td>
                              <td>
                                <button type="submit" name="remove" class="btn btn-info" value="<?= $key ?>">Remove</button>
                              </td>
                            </tr>
                            <?php $tmp += ($res['price'] * $res['qty']); ?>
                            <?php $tmptime += ($res['time'] * $res['qty']); ?>
                          <?php } ?>
                        <?php } ?>
                        <tr>
                          <td style="font-weight:bold" colspan="2">TOTAL</td>
                          <td style="text-align:right;font-weight:bold"><?= convertTime($tmptime) ?></td>
                          <td style="text-align:right;font-weight:bold"><?= number_format($tmp, 2) ?></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <button class="btn btn-info w-100" type="submit" name="update_cart"> Update Cart</button>
                </form>
              </div>
              <?php $clinic_details = get_clinic($_SESSION['clinic_id'] ?? 0); ?>
              <div class="col-md-6">
                <form method="post" onsubmit="return confirm('Are you sure?');">
                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Clinic:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="text" class="form-control" disabled value="<?= isset($clinic_details->name) ? $clinic_details->name : '' ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Dentist:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <select id="" class="form-control" name="dentist_id">
                          <?php if (isset($clinic_details)) { ?>
                            <?php foreach (get_list("select u.id,ui.first_name,ui.last_name from tbl_user u inner join tbl_userinfo ui on ui.id = u.id where u.access_id in(3,2) and u.clinic_id = " . $_SESSION['clinic_id']) as $res) { ?>
                              <option value="<?= $res['id'] ?>"><?= strtoupper($res['first_name'] . ' - ' . $res['last_name']) ?></option>
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
                        <select id="" class="form-control" name="mode_of_payment">
                          <?php if (isset($clinic_details)) { ?>
                            <?php foreach (get_list("select * from tbl_mode_of_payment") as $res) { ?>
                              <option value="<?= $res['id'] ?>"><?= strtoupper($res['name']) ?></option>
                            <?php } ?>
                        </select>
                      <?php } ?>
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
                        <input type="text" name="appointment_date" class="form-control mydatepicker" placeholder="mm-dd-yyyy" value="<?= isset($_POST['appointment_date']) ? $_POST['appointment_date'] : '' ?>" required min="<?= date('m-d-Y') ?>" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-end control-label col-form-label">Remarks:</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <textarea name="remarks" class="form-control"><?= isset($_POST['remarks']) ? $_POST['remarks'] : '' ?></textarea>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-info w-100" type="submit" name="checkout"> Checkout</button>
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