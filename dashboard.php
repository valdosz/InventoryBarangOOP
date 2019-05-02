<?php 
    include 'controller.php';

    $dos = new oop();

    $table = "table_merek";
    $kd_merek = "kd_merek";
    $merek = $dos->jumlah($table,$kd_merek);

    $sql = "SELECT COUNT(kd_user) as peg FROM table_user";
    $query = mysqli_query($conn,$sql);
    $assoc = mysqli_fetch_assoc($query);

    $sql1 = "SELECT COUNT(kd_barang) as bar FROM table_barang";
    $query1 = mysqli_query($conn,$sql1);
    $assoc1 = mysqli_fetch_assoc($query1);

    $sql2 = "SELECT COUNT(kd_merek) as mer FROM table_merek";
    $query2 = mysqli_query($conn, $sql2);
    $assoc2 = mysqli_fetch_assoc($query2);

    $sql3 = "SELECT COUNT(kd_distributor) as dis FROM table_distributor";
    $query3 = mysqli_query($conn, $sql3);
    $assoc3 = mysqli_fetch_assoc($query3); 
?>
<div class="panel panel-default">
	<div class="panel-heading main-color-bg">
		<div class="panel-title">Inventory</div>
	</div>
	<div class="panel-body">
		<div class="col-md-3">
			<div class="well dash-box">
                <h2><span class="fa fa-user" aria-hidden="true"></span> <?php echo $assoc['peg']; ?></h2>
                <h4>Pegawai</h4>
            </div>
		</div>
		<div class="col-md-3">
            <div class="well dash-box">
                <h2><span class="fa fa-list-alt" aria-hidden="true"></span> <?= $assoc1['bar'] ?></h2>
                <h4>Barang</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well dash-box">
                <h2><span class="fa fa-pencil" aria-hidden="true"></span> <?= $assoc2['mer'] ?></h2>
                <h4>Merek</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well dash-box">
                <h2><span class="fa fa-user" aria-hidden="true"></span> <?= $assoc3['dis'] ?></h2>
                <h4>Distributor</h4>
            </div>
        </div>
	</div>
</div>