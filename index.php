<?php 
    session_start();
    include 'controller.php';
    $dos = new oop();

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = base64_encode($_POST['password']);
        $level    = $_POST['level'];
        $dos->login($username,$password,$level);
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login InventoryDos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/fa/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
      .app-name{
            color: #009688;
            text-align: center;
        }
        .app-meta{
            text-align: center;
            margin-top: -3px;
            color: #C7C6C6;
            font-style: italic;
        }
        .divider{
            margin: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .iv-panel{
            margin-top: 25px;
        }
        .btn-default{
            background-color: #009688;
        }

    </style>
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
          <a class="navbar-brand" href="#">Inventory Login</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

        </div>
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"> Inventory Dos <small> Login</small></h1>
          </div>
        </div>
      </div>
    </header>
  
      <section id="main">
    <div class="container">
          <div class="row">
              <div class="col-sm-4 col-sm-offset-4">
                  <form action="" method="POST">
                      <div class="panel panel-default iv-panel">
                          <div class="panel-body">
                              <h1 class="app-name">Inventory</h1>
                              <p class="app-meta">Aplikasi Penjualan Barang Berkualitas</p>
                              <hr>
                              <div class="form-group">
                                  <p>Username</p>
                                  <input type="text" name="username" class="form-control" required>
                              </div>
                              <div class="form-group">
                                  <p>Password</p>
                                  <input type="password" name="password" class="form-control" required>
                              </div>
                              <div class="form-group">
                                  <p>Level</p>
                                  <select value="" name="level" class="form-control">
                                      <option value="Admin">Admin</option>
                                      <option value="Kasir">Kasir</option>
                                      <option value="Manager">Manager</option>
                                  </select>
                              </div>
                          </div>
                          <div class="panel-footer">
                              <button type="submit" name="login" class="btn btn-default">Login <i class="fa fa-sign-in"></i></button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright Muhamad Rivaldi, &copy; 2018</p>
    </footer>
    <script type="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
