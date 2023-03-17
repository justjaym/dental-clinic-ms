<?php
require_once 'db_conn.php';

require_once 'PHPMailer.php';
require_once 'SMTP.php';
require_once 'Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$_SESSION['conn'] = $conn;

function query($sql)
{
    return mysqli_query($_SESSION['conn'], $sql);
}

function get_inserted_id($sql)
{
    $conn =  $_SESSION['conn'];
    mysqli_query($conn, $sql);
    return mysqli_insert_id($conn);
}

function get_one($sql)
{
    $result = mysqli_query($_SESSION['conn'], $sql);
    while ($row = mysqli_fetch_object($result)) {
        return $row;
    }
    // $obj = get_one("select * from where id = '1' tbl_user limit 1");
    // $obj->id;
}

function get_list($sql)
{
    $result = mysqli_query($_SESSION['conn'], $sql);
    $temp = array();
    while ($row = $result->fetch_assoc()) {
        $temp[] = $row;
    }
    return $temp;
    // $table = get_list("select * from tbl_user");
    // foreach ($table as $res) {
    //     echo $res['id'];
    // }
}

function send_mail($email, $message)
{
    //Create instance of PHPMailer
    $mail = new PHPMailer();
    //Set mailer to use smtp
    $mail->isSMTP();
    //Define smtp host
    $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
    $mail->SMTPAuth = true;
    //Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";
    //Port to connect smtp
    $mail->Port = "587";
    //Set gmail username
    $mail->Username = "casa.amarillo1234@gmail.com";
    //Set gmail password
    $mail->Password = "tjsqhnlyhokswtjg";
    //Email subject
    $mail->Subject = "Casa Amarillo Password";
    //Set sender email
    // $mail->setFrom('casa.amarillo1234@gmail.com');
    $mail->setFrom('PDCMS@gmail.com');
    //Enable HTML
    $mail->isHTML(true);
    //Attachment
    $mail->addAttachment('');
    //Email body
    $mail->Body = $message;
    //Add recipient
    $mail->addAddress($email);
    //Finally send email
    if ($mail->send()) {
        // echo "Email Sent..!";
    } else {
        // echo "Message could not be sent. Mailer Error: " . "" . "{$mail->ErrorInfo}";
    }
    //Closing smtp connection
    $mail->smtpClose();
}
function loginUser($data)
{
    extract($data);
    $result = query("SELECT * FROM `tbl_user` WHERE username = '$username' AND password = '$password' ");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_object($result)) {
            $_SESSION['user'] = $row;
        }
        echo "<script>location.reload();</script>";
    } else {
        echo '<div class="alert alert-danger" role="alert">
                  Invalid Login!
                  </div>';
    }
}

function membershipUser($data)
{
    extract($data);
    if (!empty(get_one("select * from tbl_member where prc_no = '$prc_no' "))) {
        return error_message("Service Name Already Exist");
    }
    $file_name = "default.png";
    if (isset($attachment) && !empty($attachment['name'])) {
        $ext = explode(".", $attachment["name"]);
        $file_name = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($attachment['tmp_name'], "images/members/" . $file_name);
        $file_name = "$file_name";

        $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return error_message("File Type Not Supported");
        }
    }
    query("INSERT INTO `tbl_member` (`prc_no`, `first_name`, `last_name`,`qr`,`barangay_id`,`city_id`,`paid_status_id`) values('$prc_no','$first_name','$last_name','$file_name','$barangay2','$municipality2',1)");
    echo '<div class="alert alert-success" role="alert">
                 Request Created!
                  </div>';
}


function importMembers($data)
{
    extract($data);
    $filename = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            query("INSERT into tbl_member 
(prc_no,first_name,last_name,city,barangay,barangay_id,city_id, qr,paid_status_id)  values 
('" . $getData[0] . "','" . $getData[1] . "','" . $getData[2] . "','" . (!is_numeric($getData[3]) ? $getData[3] : '') . "','" . (!is_numeric($getData[4]) ? $getData[4] : '') . "','" . (is_numeric($getData[3]) ? $getData[3] : '') . "','" . (is_numeric($getData[4]) ? $getData[4] : '') . "','default.png',2)");
        }

        fclose($file);
    }
    query("update tbl_member set barangay = UPPER(barangay), city = UPPER(city)");
    return success_message();
}
function error_message($message = "Error Something Went Wrong")
{
    return '<div class="alert alert-danger" role="alert"> ' . $message . ' </div>';
}

function success_message($message = "Successfull")
{
    return '<div class="alert alert-success" role="alert"> ' . $message . ' </div>';
}

function registerClinic($data)
{
    extract($data);

    // $sql = SELECT * FROM tbl_user WHERE username = $username
    // if(!empty(get_one($sql))){
    // return error_message("Already Exist")
    // }
    // ucfirst();

    if (!empty(get_one("select * from tbl_clinic where name = '$clinic_name'"))) {
        return error_message("Clinic Name Already Exist");
    }

    $file_name = "default.png";
    if (isset($image_koto) && !empty($image_koto['name'])) {
        $ext = explode(".", $image_koto["name"]);
        $file_name = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($image_koto['tmp_name'], "../images/clinic/" . $file_name);
        $file_name = "$file_name";


        $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return error_message("File Type Not Supported");
        }
    }

    $file_name_prc = "default.png";
    if (isset($prc_id) && !empty($prc_id['name'])) {
        $ext = explode(".", $prc_id["name"]);
        $file_name_prc = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($prc_id['tmp_name'], "../images/clinic/prc/" . $file_name_prc);
        $file_name_prc = "$file_name_prc";
    }
    $file_name_dti = "default.png";
    if (isset($dti) && !empty($dti['name'])) {
        $ext = explode(".", $dti["name"]);
        $file_name_dti = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($dti['tmp_name'], "../images/clinic/dti/" . $file_name_dti);
        $file_name_dti = "$file_name_dti";
    }
    $file_name_barangay_clearance = "default.png";
    if (isset($barangay_clearance) && !empty($barangay_clearance['name'])) {
        $ext = explode(".", $barangay_clearance["name"]);
        $file_name_barangay_clearance = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($barangay_clearance['tmp_name'], "../images/clinic/barangay_clearance/" . $file_name_barangay_clearance);
        $file_name_barangay_clearance = "$file_name_barangay_clearance";
    }
    $file_name_business_permit = "default.png";
    if (isset($business_permit) && !empty($business_permit['name'])) {
        $ext = explode(".", $business_permit["name"]);
        $file_name_business_permit = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($business_permit['tmp_name'], "../images/clinic/business_permit/" . $file_name_business_permit);
        $file_name_business_permit = "$file_name_business_permit";
    }
    $file_name_mayors_permit = "default.png";
    if (isset($mayors_permit) && !empty($mayors_permit['name'])) {
        $ext = explode(".", $mayors_permit["name"]);
        $file_name_mayors_permit = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($mayors_permit['tmp_name'], "../images/clinic/mayors_permit/" . $file_name_mayors_permit);
        $file_name_mayors_permit = "$file_name_mayors_permit";
    }

    $clinic_id = get_inserted_id("INSERT INTO `tbl_clinic` (name, image, description,prc_id,business_permit,dti,barangay_clearance,prc_no,mayors_permit) values('$clinic_name', '$file_name','$description','$file_name_prc','$file_name_barangay_clearance','$file_name_dti','$file_name_barangay_clearance','$prc_no','file_name_mayors_permit')");
    $id = get_inserted_id("INSERT INTO `tbl_user` (access_id, username, password, clinic_id) values('2', '$username', '$password','$clinic_id')");
    query("INSERT INTO `tbl_userinfo` (id, municipality, barangay, email, contact, first_name, last_name) values($id, '$municipality', '$barangay', '$email', '$contact','$first_name','$last_name')");

    $message = "<h1>Welcome to PCDMS!</h1>";
    $message .= "<style>table,tr,td{border:solid 2px black}</style>";
    $message .= "<table>";
    $message .= "<tr>";
    $message .= "<td>Clinic Name</td>";
    $message .= "<td>PRC No</td>";
    $message .= "<td>Username</td>";
    $message .= "<td>Password</td>";
    $message .= "</tr>";
    $message .= "<tr>";
    $message .= "<td>$clinic_name</td>";
    $message .= "<td>$prc_no</td>";
    $message .= "<td>$username</td>";
    $message .= "<td>$password</td>";
    $message .= "</tr>";
    $message .= "</table>";
    send_mail($email, $message);
    return success_message();
}

function editClinic($data)
{
    extract($data);
    if (!empty(get_one("select * from tbl_clinic where name = '$clinic_name' and clinic_id <> '$clinic_id' "))) {
        return error_message("Clinic Name Already Exist");
    }

    $file_name = get_one("select * from tbl_clinic where clinic_id = $clinic_id")->image;
    if (isset($image_koto) && !empty($image_koto['name'])) {
        $ext = explode(".", $image_koto["name"]);
        $file_name = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($image_koto['tmp_name'], "../images/clinic/" . $file_name);
        $file_name = "$file_name";
    }

    $file_name_prc = get_one("select * from tbl_clinic where clinic_id = $clinic_id")->prc_id;
    if (isset($prc_id) && !empty($prc_id['name'])) {
        $ext = explode(".", $prc_id["name"]);
        $file_name_prc = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($prc_id['tmp_name'], "../images/clinic/prc/" . $file_name_prc);
        $file_name_prc = "$file_name_prc";
    }

    $file_name_business_permit = get_one("select * from tbl_clinic where clinic_id = $clinic_id")->business_permit;
    if (isset($business_permit) && !empty($business_permit['name'])) {
        $ext = explode(".", $business_permit["name"]);
        $file_name_business_permit = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($business_permit['tmp_name'], "../images/clinic/business_permit/" . $file_name_business_permit);
        $file_name_business_permit = "$file_name_business_permit";
    }

    $file_name_dti = get_one("select * from tbl_clinic where clinic_id = $clinic_id")->dti;
    if (isset($dti) && !empty($dti['name'])) {
        $ext = explode(".", $dti["name"]);
        $file_name_dti = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($dti['tmp_name'], "../images/clinic/dti/" . $file_name_dti);
        $file_name_dti = "$file_name_dti";
    }

    $file_name_barangay_clearance = get_one("select * from tbl_clinic where clinic_id = $clinic_id")->barangay_clearance;
    if (isset($barangay_clearance) && !empty($barangay_clearance['name'])) {
        $ext = explode(".", $barangay_clearance["name"]);
        $file_name_barangay_clearance = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($barangay_clearance['tmp_name'], "../images/clinic/barangay_clearance/" . $file_name_barangay_clearance);
        $file_name_barangay_clearance = "$file_name_barangay_clearance";
    }


    $file_name_mayors_permit = get_one("select * from tbl_clinic where clinic_id = $clinic_id")->mayors_permit;
    if (isset($mayors_permit) && !empty($mayors_permit['name'])) {
        $ext = explode(".", $mayors_permit["name"]);
        $file_name_mayors_permit = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($mayors_permit['tmp_name'], "../images/clinic/mayors_permit/" . $file_name_mayors_permit);
        $file_name_mayors_permit = "$file_name_mayors_permit";
    }

    query("UPDATE `tbl_user` set  username ='$username', password = '$password' where id = $id");
    query("UPDATE `tbl_userinfo` set  municipality ='$municipality', barangay = '$barangay',email='$email',contact='$contact',first_name= '$first_name', last_name='$last_name' where id = $id");
    query("UPDATE `tbl_clinic` set name = '$clinic_name', image ='$file_name',description = '$description',prc_id = '$file_name_prc',business_permit = '$file_name_business_permit',dti = '$file_name_dti',barangay_clearance = '$file_name_barangay_clearance', mayors_permit = '$file_name_mayors_permit',prc_no = '$prc_no' where clinic_id = $clinic_id");
    return success_message("Clinic #$clinic_id Updated Successfully!");
}

function editStaff($data)
{
    extract($data);
    if (!empty(get_one("select * from tbl_user where username = '$username' and id <> '$id'"))) {
        return error_message("Name Already Exist");
    }

    query("UPDATE `tbl_user` set  username ='$username', password = '$password' where id = $id");
    query("UPDATE `tbl_userinfo` set  first_name ='$first_name', last_name = '$last_name',email='$email',contact='$contact' where id = $id");
    return success_message("Staff Updated Successfully!");
}

function editMember($data)
{
    extract($data);
    if (!empty(get_one("select * from tbl_member where prc_no = '$prc_no' and id <> '$id'"))) {
        return error_message("PRC No Already Exist");
    }

    query("UPDATE `tbl_member` set  prc_no ='$prc_no', first_name = '$first_name',  last_name = '$last_name' , barangay_id = '$barangay' , city_id = '$municipality' where id = $id");
    return success_message("Member Updated Successfully!");
}

function editServices($data)
{
    extract($data);
    if (!empty(get_one("select * from tbl_service where srvc_name = '$srvc_name' and id <> '$id'"))) {
        return error_message("Name Already Exist");
    }

    $file_name = get_one("select * from tbl_product where id = $id")->image;
    if (isset($image_koto) && !empty($image_koto['name'])) {
        $ext = explode(".", $image_koto["name"]);
        $file_name = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($image_koto['tmp_name'], "../images/services/" . $file_name);
        $file_name = "$file_name";
    }

    query("UPDATE `tbl_service` set  srvc_name ='$srvc_name', srvc_desc = '$srvc_desc', srvc_price = '$srvc_price',srvc_time = '$srvc_time',srvc_img ='$file_name' where id = $id");
    return success_message("Service Updated Successfully!");
}

function editProducts($data)
{
    extract($data);
    if (!empty(get_one("select * from tbl_product where prod_name = '$prod_name' and id <> '$id'"))) {
        return error_message("Name Already Exist");
    }

    $file_name = get_one("select * from tbl_product where id = $id")->image;
    if (isset($image_koto) && !empty($image_koto['name'])) {
        $ext = explode(".", $image_koto["name"]);
        $file_name = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($image_koto['tmp_name'], "../images/products/" . $file_name);
        $file_name = "$file_name";
    }

    query("UPDATE `tbl_product` set  prod_name ='$prod_name', prod_desc = '$prod_desc', prod_price = '$prod_price', image ='$file_name' where id = $id");
    return success_message("Product Updated Successfully!");
}

function editClinicDetails($data)
{
    extract($data);
    if (!empty(get_one("select * from tbl_clinic where name = '$clinic_name' and clinic_id <> '$clinic_id'"))) {
        return error_message("Clinic Name Already Exist");
    }

    $file_name = get_one("select * from tbl_clinic where clinic_id = $clinic_id")->image;
    if (isset($image_koto) && !empty($image_koto['name'])) {
        $ext = explode(".", $image_koto["name"]);
        $file_name = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($image_koto['tmp_name'], "../images/clinic/" . $file_name);
        $file_name = "$file_name";
    }

    query("UPDATE `tbl_userinfo` set  municipality ='$municipality', barangay = '$barangay',email='$email',contact='$contact' where id = $id");
    query("UPDATE `tbl_clinic` set name = '$clinic_name', image ='$file_name' where clinic_id = $clinic_id");
    return success_message("Clinic Updated Successfully!");
}

function editUserDetails($data)
{
    extract($data);
    if (!empty(get_one("select * from tbl_user where username = '$username' and id <> '$id'"))) {
        return error_message("Username Name Already Exist");
    }

    query("UPDATE `tbl_userinfo` set  first_name ='$first_name', last_name ='$last_name', municipality ='$municipality', barangay = '$barangay',email='$email',contact='$contact' where id = $id");
    query("UPDATE `tbl_user` set username = '$username', password ='$password' where id = $id");
    return success_message("Details Updated Successfully!");
}

function deleteClinic($id)
{
    query("DELETE from `tbl_clinic` where clinic_id = $id");
    query("DELETE from `tbl_user` where clinic_id = $id");
    return success_message("Clinic Deleted Successfully!");
}
function deleteMember($id)
{
    query("DELETE from `tbl_member` where id = $id");
    return success_message("Member Deleted Successfully!");
}

function deleteStaff($id)
{
    query("DELETE from `tbl_user` where id = $id");
    query("DELETE from `tbl_userinfo` where id = $id");
    return success_message("Staff Deleted Successfully!");
}

function deleteService($id)
{
    query("DELETE from `tbl_service` where id = $id");
    return success_message("Service Deleted Successfully!");
}

function deleteProduct($id)
{
    query("DELETE from `tbl_product` where id = $id");
    return success_message("Product Deleted Successfully!");
}

function registerStaff($data)
{
    extract($data);
    $clinic_id = $_SESSION['user']->clinic_id;
    // ucfirst();
    $id = get_inserted_id("INSERT INTO `tbl_user` (access_id, username, password, clinic_id) values('$access_id', '$username', '$password','$clinic_id')");
    query("INSERT INTO `tbl_userinfo` (id, email, contact, first_name, last_name) values($id, '$email', '$contact', '$first_name', '$last_name')");
    return success_message();
}

function registerUser($data)
{
    extract($data);

    // ucfirst();
    $id = get_inserted_id("INSERT INTO `tbl_user` (access_id, username, password) values('5', '$username', '$password')");
    query("INSERT INTO `tbl_userinfo` (id, municipality, barangay, email, contact, first_name, last_name) values($id, '$municipality', '$barangay', '$email', '$contact', '$first_name', '$last_name')");
    return success_message();
}

function addProduct($data)
{
    extract($data);
    $clinic_id = $_SESSION['user']->clinic_id;
    if (!empty(get_one("select * from tbl_product where prod_name = '$prod_name' and clinic_id = '$clinic_id'"))) {
        return error_message("Product Name Already Exist");
    }

    $file_name = "default.png";
    if (isset($image_koto) && !empty($image_koto['name'])) {
        $ext = explode(".", $image_koto["name"]);
        $file_name = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($image_koto['tmp_name'], "../images/products/" . $file_name);
        $file_name = "$file_name";
    }


    query("INSERT INTO `tbl_product` (clinic_id, prod_name, prod_desc, prod_price, image) values($clinic_id, '$prod_name', '$prod_desc', '$prod_price', '$file_name')");
    return success_message();
}

function addService($data)
{
    extract($data);

    $clinic_id = $_SESSION['user']->clinic_id;
    if (!empty(get_one("select * from tbl_service where srvc_name = '$srvc_name' and clinic_id = '$clinic_id'"))) {
        return error_message("Service Name Already Exist");
    }

    $file_name = "default.png";
    if (isset($image_koto) && !empty($image_koto['name'])) {
        $ext = explode(".", $image_koto["name"]);
        $file_name = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($image_koto['tmp_name'], "../images/services/" . $file_name);
        $file_name = "$file_name";
    }


    query("INSERT INTO `tbl_service` (clinic_id, srvc_name, srvc_desc, srvc_price, srvc_time, srvc_img) values($clinic_id, '$srvc_name', '$srvc_desc', '$srvc_price','$srvc_time','$file_name')");
    return success_message();
}

function add_to_cart($data)
{
    extract($data);
    if (!isset($_SESSION['clinic_id'])) {
        $_SESSION['clinic_id'] = $clinic_id;
    } else {
        if ($_SESSION['clinic_id'] != $clinic_id) {
            $_SESSION['cart'] = null;
            $_SESSION['clinic_id'] = $clinic_id;
        };
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'][$service_id] = array('price' => $price, 'qty' => $qty, 'name' => $name, 'time' => $time);
    } else {
        if (!isset($_SESSION['cart'][$service_id])) {
            $_SESSION['cart'][$service_id] = array('price' => $price, 'qty' => $qty, 'name' => $name, 'time' => $time);
        } else {
            $_SESSION['cart'][$service_id]['qty'] = $_SESSION['cart'][$service_id]['qty'] + $qty;
            $_SESSION['cart'][$service_id]['time'] = $_SESSION['cart'][$service_id]['time'] * $qty;
        }
    }
    return success_message("Service Added Successfully!");
}

function get_clinic($id = 0)
{
    return !empty($id)  ? get_one("SELECT c.*,ui.*,b.name as `barangay`, cc.name as `municipality`, concat(ui.first_name,' ', ui.last_name) as `fullname` from tbl_clinic c inner join tbl_user u on u.clinic_id = c.clinic_id and u.access_id = 2 inner join tbl_userinfo ui on ui.id = u.id inner join tbl_city cc on cc.id = ui.municipality inner join tbl_barangay b on b.id = ui.barangay where c.clinic_id = $id limit 1") : null;
}

function get_patient($id = 0)
{
    return !empty($id) ? get_one("SELECT * from tbl_userinfo where id = $id") : '';
}

function get_barangay($id = 0)
{
    return !empty($id) ? get_one("SELECT name from tbl_barangay where id = $id")->name : '';
}

function get_municipality($id = 0)
{
    return !empty($id) ? get_one("SELECT name from tbl_city where id = $id")->name : '';
}


function get_paid_status($id = 0)
{
    return !empty($id) ? get_one("SELECT name from tbl_appointment_paid_status where id = $id")->name : '';
}


function get_appointment_status($id = 0)
{
    return !empty($id) ? get_one("SELECT name from tbl_appointment_status where id = $id")->name : '';
}


function update_cart($data)
{
    extract($data);
    if (empty($qty)) {
        return error_message("Error Cart Is Empty!");
    }
    foreach ($qty as $key => $res) {
        if ($res <= 0) {
            unset($_SESSION['cart'][$key]);
        } else {
            $_SESSION['cart'][$key]['qty'] = $res;
        }
    }
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['clinic_id']);
    }
    return success_message("Cart Updated Successfully!");
}

function remove_cart_item($id)
{
    unset($_SESSION['cart'][$id]);
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['clinic_id']);
    }
    return success_message("Cart Item Removed Successfully!");
}

function checkout($data)
{
    extract($data);
    if (!isset($clinic_id) || !isset($cart)) {
        return error_message("Error Cart Is Empty!");
    }
    $time = 0;
    foreach ($_SESSION['cart'] as $key => $res) {
        $time += (float)$res['time'] * $res['qty'];
    }
    $actual_appointment_date = DateTime::createFromFormat("m-d-Y", $appointment_date)->format('Y-m-d');

    $existing_time = 0;

    foreach (get_list("select i.appointment_time as `appointment_time` from tbl_appointment a inner join tbl_appointment_items i on i.appointment_id = a.id  where a.appointment_date = '$actual_appointment_date'") as $res) {
        $existing_time += (float)$res['appointment_time'];
    }
    // echo "<pre>";
    // print_r($_SESSION['cart']);
    // var_dump($existing_time);
    // var_dump($time);
    // var_dump($existing_time + $time);
    // die;
    if ($existing_time + $time >= 9) {
        return error_message("Appointment Date Slot Is Full Already!");
    }

    $tmp = get_one("SELECT count(appointment_date) as result from tbl_appointment where clinic_id = $clinic_id and appointment_date = '$actual_appointment_date' and status_id = 1 group by appointment_date limit 1");
    $is_slot_available = $tmp->result ?? 0;
    if ((int)$is_slot_available >= 5) {
        return error_message("Appointment Date Slot Is Full Already!");
    }
    $date_created = date("Y-m-d");
    $id = get_inserted_id("INSERT INTO tbl_appointment (patient_id,clinic_id,appointment_date,remarks,date_created,dentist_id,mode_of_payment) VALUES($user->id,$clinic_id,'$actual_appointment_date','$remarks','$date_created','$dentist_id','$mode_of_payment')");
    foreach ($cart as $key => $res) {
        $qty = $res['qty'];
        $price = $res['price'];
        $time = $res['time'];
        query("INSERT INTO tbl_appointment_items (appointment_id,service_id,qty,price,appointment_time) VALUES($id,$key,'$qty','$price','$time')");
    }

    foreach (get_list("select id from tbl_user where access_id in (1,2,3,4) clinic_id = " . $clinic_id) as $res) {
        query("INSERT INTO tbl_notification (appointment_id, patient_id,dentist_id,clinic_id) values('$id', '$user->id','$id','$clinic_id')");
    }

    unset($_SESSION['cart'], $_SESSION['clinic_id']);
    return success_message("Checkout Successfully");
}

function cancel_appointment($id)
{
    query("UPDATE `tbl_appointment` set status_id = 4 where id = '$id'");
    return success_message("Appointment Cancelled Successfully!");
}

function reschedule_appointment($id)
{
    query("UPDATE `tbl_appointment` set status_id = 2 where id = '$id'");
    return success_message("Rescheduled Accepted Successfully!");
}

function approveMember($id)
{
    query("UPDATE `tbl_member` set paid_status_id = 2 where id = '$id'");
    return success_message("Member Approved Successfully!");
}
function accept_appointment($id)
{
    query("UPDATE `tbl_appointment` set status_id = 2 where id = $id");
    return success_message("Appointment Accepted Successfully!");
}
function delete_appointment($id)
{
    query("DELETE from `tbl_appointment` where id = $id");
    return success_message("Appointment Deleted Successfully!");
}
function reject_appointment($data)
{
    extract($data);
    $y = date_create($appointment_date);
    $x = date_format($y, "Y-m-d");
    query("UPDATE `tbl_appointment` set status_id = 3, appointment_date = '$x' where id = '$id'");
    foreach (get_list("select id from tbl_user where access_id in (1,2,3,4) clinic_id = " . $clinic_id) as $res) {
        query("INSERT INTO tbl_notification (appointment_id, patient_id,dentist_id,clinic_id) values('$id', '$patient_id','$id','$clinic_id')");
    }
    return success_message("Appointment Rescheduled Successfully!");
}
function paid_appointment($id)
{
    query("UPDATE `tbl_appointment` set paid_id = 2 where id = '$id'");

    return success_message("Appointment Paid Successfully!");
}
function uplaod_teethv($data)
{
    // echo "<pre>";
    extract($data);
    // print_r($appointment_date);

    $filename = get_one("select * from tbl_clinic where clinic_id = $clinic_id")->image;
    if (isset($file_name) && !empty($file_name['name'])) {
        $ext = explode(".", $file_name["name"]);
        $filename = 'file_' . date('YmdHis') . "." . end($ext);
        move_uploaded_file($file_name['tmp_name'], "../images/teeth/" . $filename);
        $filename = "$filename";
    }
    // $x = date_format(date_create($appointment_date), "Y/m/d");
    query("update tbl_appointment set image =  '$filename' where id  = $id");
    return success_message("Teeth upload Successfully!");
}

function editSettings($data)
{
    extract($data);
    query("UPDATE `tbl_settings` set requirements = '$requirements' where id = 1");
    return success_message("Yes!");
}
function convertDate($date)
{

    // $tmp = date_create($date . " 00:00:00");
    // return $tmp;
    try {
        return DateTime::createFromFormat("F d, Y", $date);
    } catch (\Throwable $th) {
        $tmp =  false;
        return '';
    }
    // if ($tmp) {
    //     return  date_format($tmp, 'F d, Y');
    // }
    // return '';
}
function convertTime($data)
{
    if ($data < 1) {
        return $data * 60 . "mins";
    }
    return $data . " Hours";
}
// SELECT x.first_name,x.last_name,c.name,b.name `barangay` FROM tbl_userinfo x inner join tbl_city c on c.id = x.municipality inner join tbl_barangay b on b.id = x.barangay;


// table_1				table_2
// id   name           id city
// 1    foo            1  bayamabng
// 2    bar       		2  san carlos
// 3    john			4  basista


// select * from table_1 x left join table_2 y on  y.id = x.id

// table_1				table_2
// id   name           id city
// 1    foo            1  bayamabng
// 2    bar       		2  san carlos
// 3    john			NULL NULL

// select * from table_1 x INNER  join table_2 y on  y.id = x.id

// table_1				table_2
// id   name           id city
// 1    foo            1  bayamabng
// 2    bar       		2  san carlos

// select * from table_1 x RIGHT join table_2 y on  y.id = x.id

// table_1				table_2
// id   name           id city
// 1    foo            1  bayamabng
// 2    bar       		2  san carlos
// NULL NULL			4  basista
