<?php

session_start();
  
  if (isset($_SESSION['level']) != "Manager") {
    echo "<script>alert('Anda adalah Manager !!!');document.location.href='manager.php'</script>";
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>alert('Good Bye Manager');document.location.href='index.php'</script>";
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
    <link rel="stylesheet" type="text/css" href="css/fa/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet">
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
            <li><a href="?menu=kelola_pegawai">Kelola Pegawai</a></li>
            <li><a href="?menu=kelola_pegawai">Kelola Transaksi</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="?menu=profile">Profile</a></li>
            <li><a href="?logout">Logout</a></li>
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
              <a href="?menu=kelola_pegawai" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Kelola Pegawai <span class="badge"><i class="fa fa-user"></i></span></a>

              <a href="?menu=kelola_transaksi" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Kelola Transaksi<span class="badge"><i class="fa fa-usd"></i></span></a>
            </div>

            <div class="list-group">
              <a href="?menu=laporan" class="list-group-item active main-color-bg">
                <span class="fa fa-cog" aria-hidden="true"></span> Laporan Barang
              </a>
              <a href="?menu=laporanbarang" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Semua Barang <span class="badge"><i class="fa fa-archive"></i></span></a>
              <a href="?menu=lap_pertanggal" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Per Tanggal <span class="badge"><i class="fa fa-calendar"></i></span></a>
              <a href="?menu=lap_baranghabis" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Barang Habis<span class="badge"><i class="fa fa-ban"></i></span></a>
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
                  case 'kelola_pegawai':
                    include "kelola_pegawai.php";
                    break;
                  case 'kelola_transaksi':
                    include "kelola_transaksi.php";
                    break;
                  case 'laporanbarang':
                    include "laporanbarang.php";
                    break;
                  case 'lap_pertanggal':
                    include "lapbarangperiode.php";
                    break;
                  case 'lap_baranghabis':
                    include "lap_baranghabis.php";
                    break;
                  case 'profile':
                    include "profile.php";
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
  </body>
</html>
