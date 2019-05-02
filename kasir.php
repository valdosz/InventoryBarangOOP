<?php 
  session_start();

  if (isset($_SESSION['level']) != "Kasir") {
    echo "<script>alert('Anda adalah Kasir !!!');document.location.href='kasir.php'</script>";
  }
  
  if (isset($_GET['logout'])) {
    session_destroy();
    echo "<script>alert('Good Bye Kasir');document.location.href='index.php'</script>";
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
            <li><a href="?menu=transaksi">Transaksi</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome Kasir</a></li>
            <li><a href="?logout">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="fa fa-cog" aria-hidden="true"></span> SportDos<small> Manage Your Inventory</small></h1>
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
              <a href="?menu=transaksi" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Transaksi <span class="badge"></span></a>
              <a href="?menu=datstruk" class="list-group-item"><span class="fa fa-list-alt" aria-hidden="true"></span> Struk <span class="badge"></span></a>
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
                  case 'transaksi':
                    include "kasir_transaksi.php";
                    break;
                  case 'pembayaran':
                    include "kasir_pembayaran.php";
                  break;
                  case 'datstruk':
                    include "kelola_transaksi.php";
                    break;
                  case 'struk':
                    include "struk.php";
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
    <script src="js/sweetalert.min.js"></script>
  </body>
</html>
