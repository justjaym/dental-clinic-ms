<?php include 'header.php'; ?>
<style>
  input {
    text-transform: uppercase;
  }
</style>
<!-- ============================================================== -->
<!-- End status Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and status sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-12 d-flex no-block align-items-center" style="margin-bottom: 6px;">
        <h4 class="page-title">Viewing Dental Record #<?= $_GET['id'] ?></h4>

        <div class="ms-auto text-end">

          <a href="appointments.php" class="btn btn-info col-12" type="button" style="margin-status: 4px;">Back To Appointment List</a>

        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?php

    function update_chart($data)
    {
      extract($data);
      $tmp  = get_defined_vars();
      $where = "";
      foreach ($tmp['data'] as $key => $value) {
        if ($key == 'id' || $key == 'update_chart') continue;
        $where .= " $key = '$value' ,";
      }
      $where = rtrim($where, ",");
      query("update tbl_chart set $where  where patient_id = " . $id);
      return success_message("Chart Updated!");
    }

    ?>
    <?= (isset($_POST['update_chart'])) ? update_chart($_POST) : ''; ?>
    <?php $id = $_GET['id']  ?>

    <style>
      .teeth>td>td {
        width: 20px !important;
        display: inline-block;
      }

      .vl {
        border-left: 5px solid black;
        height: 36%;
        position: absolute;
        left: 50%;
        margin-left: -3px;
        top: 5%;
      }

      .hl {
        border-bottom: 5px solid black;
        height: 18%;
        width: 22%;
        position: absolute;
        left: 39%;
        /* margin-status: -3px; */
        top: 4.5%;
      }
    </style>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="page-title">Dental Record</h5>
            <?php
            $id = $_GET['id'];
            $exists = get_one("select count(id) as `exists` from tbl_chart where patient_id = " . $id)->exists ?? 0;
            if (!$exists) {
              query("insert into tbl_chart (patient_id) values($id)");
            }
            $data = get_one("select * from tbl_chart where patient_id = " . $id);
            ?>
            <form method="post" onsubmit="return ('Are You Sure?')">

              <div class="row">
                <center>
                  <div class="ct">
                    <div class="hl"></div>
                    <div class="vl"></div>
                    <table class="teeth">
                      <tr>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_55" style="width:20px" value="<?= $data->status_1_55 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_54" style="width:20px" value="<?= $data->status_1_54 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_53" style="width:20px" value="<?= $data->status_1_53 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_52" style="width:20px" value="<?= $data->status_1_52 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_51" style="width:20px" value="<?= $data->status_1_51 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_61" style="width:20px" value="<?= $data->status_1_61 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_62" style="width:20px" value="<?= $data->status_1_62 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_63" style="width:20px" value="<?= $data->status_1_63 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_64" style="width:20px" value="<?= $data->status_1_64 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_65" style="width:20px" value="<?= $data->status_1_65 ?>"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="status_2_55" style="width:20px" value="<?= $data->status_2_55 ?>"></td>
                        <td><input type="text" name="status_2_54" style="width:20px" value="<?= $data->status_2_54 ?>"></td>
                        <td><input type="text" name="status_2_53" style="width:20px" value="<?= $data->status_2_53 ?>"></td>
                        <td><input type="text" name="status_2_52" style="width:20px" value="<?= $data->status_2_52 ?>"></td>
                        <td><input type="text" name="status_2_51" style="width:20px" value="<?= $data->status_2_51 ?>"></td>
                        <td><input type="text" name="status_2_61" style="width:20px" value="<?= $data->status_2_61 ?>"></td>
                        <td><input type="text" name="status_2_62" style="width:20px" value="<?= $data->status_2_62 ?>"></td>
                        <td><input type="text" name="status_2_63" style="width:20px" value="<?= $data->status_2_63 ?>"></td>
                        <td><input type="text" name="status_2_64" style="width:20px" value="<?= $data->status_2_64 ?>"></td>
                        <td><input type="text" name="status_2_65" style="width:20px" value="<?= $data->status_2_65 ?>"></td>
                      </tr>
                      <tr>
                        <td>55</td>
                        <td>54</td>
                        <td>53</td>
                        <td>52</td>
                        <td>51</td>
                        <td>61</td>
                        <td>62</td>
                        <td>63</td>
                        <td>64</td>
                        <td>65</td>
                      </tr>
                    </table>
                    <table class="teeth">
                      <tr>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_18" style="width:20px" value="<?= $data->status_1_18 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_17" style="width:20px" value="<?= $data->status_1_17 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_16" style="width:20px" value="<?= $data->status_1_16 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_15" style="width:20px" value="<?= $data->status_1_15 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_14" style="width:20px" value="<?= $data->status_1_14 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_13" style="width:20px" value="<?= $data->status_1_13 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_12" style="width:20px" value="<?= $data->status_1_12 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_11" style="width:20px" value="<?= $data->status_1_11 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_21" style="width:20px" value="<?= $data->status_1_21 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_22" style="width:20px" value="<?= $data->status_1_22 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_23" style="width:20px" value="<?= $data->status_1_23 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_24" style="width:20px" value="<?= $data->status_1_24 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_25" style="width:20px" value="<?= $data->status_1_25 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_26" style="width:20px" value="<?= $data->status_1_26 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_27" style="width:20px" value="<?= $data->status_1_27 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_28" style="width:20px" value="<?= $data->status_1_28 ?>"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="status_2_18" style="width:20px" value="<?= $data->status_2_18 ?>"></td>
                        <td><input type="text" name="status_2_17" style="width:20px" value="<?= $data->status_2_17 ?>"></td>
                        <td><input type="text" name="status_2_16" style="width:20px" value="<?= $data->status_2_16 ?>"></td>
                        <td><input type="text" name="status_2_15" style="width:20px" value="<?= $data->status_2_15 ?>"></td>
                        <td><input type="text" name="status_2_14" style="width:20px" value="<?= $data->status_2_14 ?>"></td>
                        <td><input type="text" name="status_2_13" style="width:20px" value="<?= $data->status_2_13 ?>"></td>
                        <td><input type="text" name="status_2_12" style="width:20px" value="<?= $data->status_2_12 ?>"></td>
                        <td><input type="text" name="status_2_11" style="width:20px" value="<?= $data->status_2_11 ?>"></td>
                        <td><input type="text" name="status_2_21" style="width:20px" value="<?= $data->status_2_21 ?>"></td>
                        <td><input type="text" name="status_2_22" style="width:20px" value="<?= $data->status_2_22 ?>"></td>
                        <td><input type="text" name="status_2_23" style="width:20px" value="<?= $data->status_2_23 ?>"></td>
                        <td><input type="text" name="status_2_24" style="width:20px" value="<?= $data->status_2_24 ?>"></td>
                        <td><input type="text" name="status_2_25" style="width:20px" value="<?= $data->status_2_25 ?>"></td>
                        <td><input type="text" name="status_2_26" style="width:20px" value="<?= $data->status_2_26 ?>"></td>
                        <td><input type="text" name="status_2_27" style="width:20px" value="<?= $data->status_2_27 ?>"></td>
                        <td><input type="text" name="status_2_28" style="width:20px" value="<?= $data->status_2_28 ?>"></td>
                      </tr>
                      <tr>
                        <td>18</td>
                        <td>17</td>
                        <td>16</td>
                        <td>15</td>
                        <td>14</td>
                        <td>13</td>
                        <td>12</td>
                        <td>11</td>
                        <td>21</td>
                        <td>22</td>
                        <td>23</td>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                      </tr>
                    </table>
                    <table class="teeth">
                      <tr>
                        <td>48</td>
                        <td>47</td>
                        <td>46</td>
                        <td>45</td>
                        <td>44</td>
                        <td>43</td>
                        <td>42</td>
                        <td>41</td>
                        <td>31</td>
                        <td>32</td>
                        <td>33</td>
                        <td>34</td>
                        <td>35</td>
                        <td>36</td>
                        <td>37</td>
                        <td>38</td>
                      </tr>
                      <tr>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_48" style="width:20px" value="<?= $data->status_1_48 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_47" style="width:20px" value="<?= $data->status_1_47 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_46" style="width:20px" value="<?= $data->status_1_46 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_45" style="width:20px" value="<?= $data->status_1_45 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_44" style="width:20px" value="<?= $data->status_1_44 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_43" style="width:20px" value="<?= $data->status_1_43 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_42" style="width:20px" value="<?= $data->status_1_42 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_41" style="width:20px" value="<?= $data->status_1_41 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_31" style="width:20px" value="<?= $data->status_1_31 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_32" style="width:20px" value="<?= $data->status_1_32 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_33" style="width:20px" value="<?= $data->status_1_33 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_34" style="width:20px" value="<?= $data->status_1_34 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_35" style="width:20px" value="<?= $data->status_1_35 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_36" style="width:20px" value="<?= $data->status_1_36 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_37" style="width:20px" value="<?= $data->status_1_37 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_38" style="width:20px" value="<?= $data->status_1_38 ?>"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="status_2_48" style="width:20px" value="<?= $data->status_2_48 ?>"></td>
                        <td><input type="text" name="status_2_47" style="width:20px" value="<?= $data->status_2_47 ?>"></td>
                        <td><input type="text" name="status_2_46" style="width:20px" value="<?= $data->status_2_46 ?>"></td>
                        <td><input type="text" name="status_2_45" style="width:20px" value="<?= $data->status_2_45 ?>"></td>
                        <td><input type="text" name="status_2_44" style="width:20px" value="<?= $data->status_2_44 ?>"></td>
                        <td><input type="text" name="status_2_43" style="width:20px" value="<?= $data->status_2_43 ?>"></td>
                        <td><input type="text" name="status_2_42" style="width:20px" value="<?= $data->status_2_42 ?>"></td>
                        <td><input type="text" name="status_2_41" style="width:20px" value="<?= $data->status_2_41 ?>"></td>
                        <td><input type="text" name="status_2_31" style="width:20px" value="<?= $data->status_2_31 ?>"></td>
                        <td><input type="text" name="status_2_32" style="width:20px" value="<?= $data->status_2_32 ?>"></td>
                        <td><input type="text" name="status_2_33" style="width:20px" value="<?= $data->status_2_33 ?>"></td>
                        <td><input type="text" name="status_2_34" style="width:20px" value="<?= $data->status_2_34 ?>"></td>
                        <td><input type="text" name="status_2_35" style="width:20px" value="<?= $data->status_2_35 ?>"></td>
                        <td><input type="text" name="status_2_36" style="width:20px" value="<?= $data->status_2_36 ?>"></td>
                        <td><input type="text" name="status_2_37" style="width:20px" value="<?= $data->status_2_37 ?>"></td>
                        <td><input type="text" name="status_2_38" style="width:20px" value="<?= $data->status_2_38 ?>"></td>
                      </tr>
                    </table>
                    <table class="teeth">
                      <tr>
                        <td>85</td>
                        <td>84</td>
                        <td>83</td>
                        <td>82</td>
                        <td>81</td>
                        <td>71</td>
                        <td>72</td>
                        <td>73</td>
                        <td>74</td>
                        <td>75</td>
                      </tr>
                      <tr>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_85" style="width:20px" value="<?= $data->status_1_85 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_84" style="width:20px" value="<?= $data->status_1_84 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_83" style="width:20px" value="<?= $data->status_1_83 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_82" style="width:20px" value="<?= $data->status_1_82 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_81" style="width:20px" value="<?= $data->status_1_81 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_71" style="width:20px" value="<?= $data->status_1_71 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_72" style="width:20px" value="<?= $data->status_1_72 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_73" style="width:20px" value="<?= $data->status_1_73 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_74" style="width:20px" value="<?= $data->status_1_74 ?>"></td>
                        <td><img src="../images/teeth/t55.png" alt="" height="30px"><br><input type="text" name="status_1_75" style="width:20px" value="<?= $data->status_1_75 ?>"></td>
                      </tr>
                      <tr>
                        <td><input type="text" name="status_2_85" style="width:20px" value="<?= $data->status_2_85 ?>"></td>
                        <td><input type="text" name="status_2_84" style="width:20px" value="<?= $data->status_2_84 ?>"></td>
                        <td><input type="text" name="status_2_83" style="width:20px" value="<?= $data->status_2_83 ?>"></td>
                        <td><input type="text" name="status_2_82" style="width:20px" value="<?= $data->status_2_82 ?>"></td>
                        <td><input type="text" name="status_2_81" style="width:20px" value="<?= $data->status_2_81 ?>"></td>
                        <td><input type="text" name="status_2_71" style="width:20px" value="<?= $data->status_2_71 ?>"></td>
                        <td><input type="text" name="status_2_72" style="width:20px" value="<?= $data->status_2_72 ?>"></td>
                        <td><input type="text" name="status_2_73" style="width:20px" value="<?= $data->status_2_73 ?>"></td>
                        <td><input type="text" name="status_2_74" style="width:20px" value="<?= $data->status_2_74 ?>"></td>
                        <td><input type="text" name="status_2_75" style="width:20px" value="<?= $data->status_2_75 ?>"></td>
                      </tr>
                    </table>
                  </div>

                  <br>
                  <table class="table table-bordered table-striped ">
                    <thead>
                      <tr>
                        <td>Condition</td>
                        <td>Restoration & Prosthethics</td>
                        <td>Surgery</td>
                      <tr>
                    </thead>
                    </tr>
                    <td><b>D</b> - Decayed (Caries indicated for Filling)</td>
                    <td><b>J</b> - Jacked Crown </td>
                    <td><b>X</b> - Extraction due to Caries</td>
                    </tr>
                    <tr>
                      <td><b>M</b> - Missing due to Caries </td>
                      <td><b>A</b> - Amalgam Filling</td>
                      <td><b>XO</b> - Extraction due to Other Causes </td>
                    </tr>
                    <tr>
                      <td><b>F</b> - Filled</td>
                      <td><b>AB</b> - Abutment </td>
                      <td><b>C</b> - Present Teeth</td>
                    </tr>
                    <tr>
                      <td><b>I</b> - Caries Indicated for Extraction</td>
                      <td><b>P</b> - Pontic </td>
                      <td><b>Cm</b> - Congenitally Missing</td>
                    </tr>
                    <tr>
                      <td><b>RF</b> - Roof Fragment</td>
                      <td><b>In</b> - Inlay</td>
                      <td><b>Sp</b> - Supermumerary</td>
                    </tr>
                    <tr>
                      <td><b>MO</b> - Missing due to Other Causes</td>
                      <td><b>Fx</b> - Fixed Cure Composite</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><b>Im</b> - Impacted Tooth</td>
                      <td><b>S</b> - Sealants</td>
                      <td></td>
                    </tr>
                  </table>
                  <div class="col-md-12">

                    <input type="hidden" value="<?= $_GET['id'] ?>" name="id">
                    <button class="btn btn-info" style="width:10%" type="submit" name="update_chart"> UPDATE CHART</button>
                    <button class="btn btn-info" type="button" id="print" onclick="window.print()"> Print</button>

                    <!-- <div class=" text-center">
                      <a href="view_receipt.php?id=<?= $appointment_details->id ?>" class="btn btn-secondary" style="width:20%">View Receipt</a>
                      <a href="view_receipt.php?id=<?= $appointment_details->id ?>" class="btn btn-secondary" style="width:20%">View Record</a>
                    </div> -->

                  </div>
              </div>

            </form>
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