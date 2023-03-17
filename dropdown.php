<?php
include('includes/functions.php');

extract($_GET);

foreach (get_list("SELECT * from tbl_barangay where city_id = '$city'") as $res) {
  echo '<option value="' . $res['id'] . '">' . $res['name'] . '</option>';
}
