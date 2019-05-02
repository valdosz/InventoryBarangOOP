<?php
  session_start(); 
  if (isset($_SESSION['level']) != "Admin") {
    echo "<script>alert('Anda adalah admin !!!');document.location.href='admin.php'</script>";
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>alert('Good Bye Admin');document.location.href='index.php'</script>";
  }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Me</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fa/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Inventory Me</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="?menu">Dashboard</a></li>
            <li><a href="?menu=barang">Barang</a></li>
            <li><a href="?menu=distributor">Distributor</a></li>
            <li><a href="?menu=merek">Merek</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li><a href="">Welcome Admin</a></li>
            <li><a href="?logout" name="">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="fa fa-cog" aria-hidden="true"></span> SportDos <small> Manage Your Inventory</small></h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="?menu" class="list-group-item active main-color-bg">
                <span class="fa fa-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="?menu=barang" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Barang <span class="badge"><i class="fa fa-cog"></i></span></a>
              <a href="?menu=distributor" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Distributor <span class="badge"><i class="fa fa-users"></i></span></a>
              <a href="?menu=merek" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Merek <span class="badge"><i class="fa fa-barcode"></i></span></a>
            </div>

            <div class="list-group">
              <a href="?menu=laporanbarang" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Laporan Barang <span class="badge"><i class="fa fa-file"></i></span></a>
            </div>

            <div class="well">
              <h4>Disk Space Used</h4>
              <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                      60%
              </div>
            </div>
            <h4>Bandwidth Used </h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
            </div>
          </div>
            </div>
          </div>
          <div class="col-md-9">
              <?php
                @$menu = $_GET['menu'];
                switch ($menu) {
                  case 'barang':
                    include "barang.php";
                    break;
                  case 'distributor':
                    include "distributor.php";
                    break;
                  case 'merek':
                    include "merek.php";
                    break;
                  case 'laporanbarang':
                    include "laporanbarang.php";
                    break;
                  default:
                    include "dashboard.php";
                    break;
                }
               ?>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright Muhamad Rivaldi, &copy; 2018</p>
    </footer>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      $('#sampleTable').DataTable();
      $('#disTable').DataTable();
    </script>
  </body>
</html>
