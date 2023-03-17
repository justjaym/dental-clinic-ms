<?php
include("includes/functions.php");
$id = $_GET['id'];
$exist = get_one("select id from tbl_userinfo where id = '$id' ")->id ?? 0;

if (!$exist) die;
if (isset($_GET['save'])) {
  $new_password = $_GET['new_password'];
  query("update tbl_user set password =  '$new_password' where id = $id");
  echo '<script>alert("New password saved!")</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>


  <form method="get">
    <div class="bs-example bs-example-form">
      <div class="form-group input-group" id="username">
        <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-user"></i> New Password</span>
        <input type="text" class="form-control" placeholder="New Password" name="new_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="validate">
        <input type="hidden" name="id" value="<?= $id ?>">
      </div>
      <div class="form-group input-group" id="password">
        <button type="submit" class="btn btn-secondary" name="save"> Save</button>
      </div>

    </div>
  </form>
</body>

</html>