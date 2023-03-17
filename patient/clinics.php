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
      <div class="col-9 d-flex no-block align-items-center">
        <h4 class="page-title">Provincial Dental Clinic</h4>

        <div class="ms-auto text-end">
        </div>
      </div>
      <div class="col-3 d-flex no-block align-items-center">
        <input type="search" class="form-control" id="cono1" placeholder="Search">

        <div class="ms-auto text-end">
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div style="margin-bottom:20px">
      <a href="clinics.php?" class="btn btn-secondary" style="word-break: break-all; "> All</a>
      <?php foreach (get_list("select distinct srvc_name from tbl_service limit 4") as $res) { ?>
        <a href="clinics.php?category=<?= $res['srvc_name'] ?>" class="btn btn-secondary" style="word-break: break-all; "> <?= $res['srvc_name'] ?></a>
      <?php } ?>
    </div>

    <div class="row" id="clinic_container">

      <?php $ctr = 1; ?>
      <?php $where = isset($_GET['category']) ? ' s.srvc_name LIKE "%' . $_GET['category'] . '%"' : ' 1=1' ?>
      <?php foreach (get_list("SELECT c.`image`,c.name as `clinic_name`,m.name as `municipality`,b.name as `barangay`,ui.email,ui.contact,u.id,u.clinic_id, group_concat(distinct s.srvc_name) as service_name from tbl_user u inner join tbl_userinfo ui on ui.id = u.id inner join tbl_clinic c on c.clinic_id = u.clinic_id inner join tbl_city m on m.id = ui.municipality inner join tbl_barangay b on b.id = ui.barangay left join tbl_service s on s.clinic_id = c.clinic_id where  $where group by c.clinic_id") as $res) { ?>
        <div class="col-md-3" data-searchable="<?= strtolower($res['municipality'] . "," . $res['barangay'] . "," . $res['service_name'] . "," . $res['clinic_name']) ?>">
          <div class="card">

            <h4 class="card-title" style="text-align:center;margin:0px;padding:10px;font-weight:bold"><?= strtoupper($res['clinic_name']) ?> #<?= $res['clinic_id'] ?></h4>
            <img src="../images/clinic/<?= $res['image'] ?>" alt="" class="img-fluid border-top" style="max-height: 150px;object-fit:contain">
            <ul>
              <li class="cdetails"><i class="fa fa-map-marker "></i> <?= strtoupper($res['municipality']) ?></li>
              <li><i class="fa fa-map-marker "></i> <?= strtoupper($res['barangay']) ?></li>
              <li><i class="fa fa-envelope "></i> <?= ucfirst($res['email']) ?></li>
              <li><i class="fa fa-phone "></i> <?= strtoupper($res['contact']) ?></li>
            </ul>
            <div class="border-top">
              <div class="card-body">
                <a href="view_clinic.php?clinic_id=<?= $res['clinic_id'] ?>" class="btn btn-info col-12" type="button">Select Clinic</a>
              </div>
            </div>
          </div>
        </div>




      <?php } ?>


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
  $(document).on("change", "#municipality", function() {
    let value = $(this).val();
    $.get("../dropdown.php?city=" + value, function(result) {
      $("#barangay").html(result);
    });
  });


  $('#table_eto').DataTable();

  var searchField = document.querySelector("input[type='search']");
  searchField.addEventListener('keypress', function() {
    var input, filter, container, div, content, i;
    input = document.getElementById("myInput");
    container = document.getElementById("clinic_container");
    div = container.getElementsByTagName("div");
    for (i = 0; i < div.length; i++) {
      content = div[i].dataset.searchable;
      if (content) {
        if (content.includes(searchField.value)) {
          div[i].style.display = "";
        } else {
          div[i].style.display = "none";
        }
      }
    }
    // if (searchField.value == '') {
    //   displayAll();
    // }
  });

  // function displayAll() {
  //   let items = document.querySelectorAll("div[data-searchable]");
  //   items.forEach(element => {
  //     element.style.display = "block";
  //   });
  // }
</script>