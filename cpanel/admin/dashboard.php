<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }

  $conn = $pdo->open();
?>
<body class="hold-transition ">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard Page
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <!-- Small boxes (Stat box) -->
      <h4>Bookings</h4>
      <div class="row">

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM booking WHERE status=:status ");
                $stmt->execute(['status'=> 'Pending']);
                $prow =  $stmt->fetch();
                echo "<h4>".$prow['numrows']."</h4>";
              ?>
              <p>Pending</p>
            </div>
            <div class="icon">
            <i class="far fa-clone"></i>
            </div>
            &nbsp;
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <?php
                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM booking");
                $stmt->execute(['status'=> 'Approved']);
                $prow =  $stmt->fetch();

                echo "<h4>".$prow['numrows']."</h4>";
              ?>
              <p>Approved</p>
            </div>
            <div class="icon">
            <i class="far fa-clone"></i>
            </div>
            &nbsp;
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM booking WHERE status=:status ");
                $stmt->execute(['status'=> 'Cancel']);
                $prow =  $stmt->fetch();

                echo "<h4>".$prow['numrows']. "</h4>";
              ?>
              <p>Cancellations</p>
            </div>
            <div class="icon">
            <i class="far fa-file-alt"></i>
            </div>
            &nbsp;
          </div>
        </div>
        <!-- ./col -->

      </div>
      <h4>Service Provider</h4>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
             <?php
                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE type=:type ");
                $stmt->execute(['type'=>2]);
                $prow =  $stmt->fetch();

                echo "<h4>".$prow['numrows']. "</h4>";
              ?>
              <p>Total Registered</p>
            </div>
            <div class="icon">
            <i class="fas fa-hotel"></i>
            </div>
            &nbsp;
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE type=:type and status=:status");
                $stmt->execute(['type'=>2,'status'=>1 ]);
                $prow =  $stmt->fetch();

                echo "<h4>".$prow['numrows']. "</h4>";
              ?>
              <p>Block Applicants  </p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            &nbsp;
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
                $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE type=:type and status=:status");
                $stmt->execute(['type'=>2,'status'=>0]);
                $prow =  $stmt->fetch();

                echo "<h4>".$prow['numrows']. "</h4>";
              ?>
              <p>Pending Applicants</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            &nbsp;
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4>0</h4>
              <p>Reviews & Ratings</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            &nbsp;
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


      </section>
      <!-- right col -->
    </div>

  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="#">Helpcare CPanel</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1
    </div>
  </footer>
</div>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->
<script>
  $(function () {
    $('#latestbooking').DataTable({
      responsive: true
    })
    $('#recentaccount').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

</script>
<!-- jQuery -->
<script src="./../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="./../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="./../../dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="./../../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./../../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="./../../dist/js/pages/dashboard3.js"></script>

<!-- <script src="./datatables.min.js"></script>
<link rel="stylesheet" href="./datatables.min.css"> -->
</body>
</html>
