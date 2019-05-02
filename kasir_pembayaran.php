<?php 
	include 'controller.php';
	$dos		= new oop();
	$query 		= "SELECT max(kd_transaksi) as maxKode FROM table_transaksi";
	$hasil 		= mysqli_query($conn,$query);
	$data 		= mysqli_fetch_array($hasil);
	$kodetrans 	= $data['maxKode'];
	$noUrut 	= (int) substr($kodetrans, 3, 3);
	$noUrut++;
	$char 		= "TR";
	$kodetrans 	= $char . sprintf("%03s", $noUrut);

	$sql 		= "SELECT SUM(sub_total) as sub FROM table_pretransaksi WHERE kd_transaksi = '$kodetrans'";
	$query 		= mysqli_query($conn,$sql);
	$assoc     	= mysqli_fetch_assoc($query);

	$sql1      	= "SELECT SUM(jumlah) as jum FROM table_pretransaksi WHERE kd_transaksi = '$kodetrans'";
	$query1    	= mysqli_query($conn,$sql1);
	$assoc1    	= mysqli_fetch_assoc($query1);

	$auth      	= $dos->selectWhere("table_user","username",$_SESSION['username']);

	$sql2      	= "SELECT COUNT(kd_pretransaksi) as count FROM table_pretransaksi WHERE kd_transaksi = '$kodetrans'";
	$query2     = mysqli_query($conn,$sql2);
	$assoc2    	= mysqli_fetch_assoc($query2);

	if ($assoc2['count'] <= 0) {
		header("location:kasir.php?menu=transaksi");
	}

	if (isset($_POST['selesai'])) {
		$total  = $_POST['total'];
		$bayar  = $_POST['bayar'];
		$kem    = $_POST['kembalian'];
		if ($bayar == "" || $kem == "") {
			echo "<script>alert('Silahkan Ketikkan Bayar..')</script>";
		}else{
			if ($bayar < $total) {
				echo "<script>alert('Uang Anda Kurang..')</script>";	
			}else{
				date_default_timezone_set('Asia/Jakarta');
				$date  = date("Y-m-d H:i:s");
				$value = "'$kodetrans','$auth[kd_user]','$assoc1[jum]','$assoc[sub]','$bayar','$kem','$date'";
				$insert = $dos->simpan("table_transaksi",$value,"?menu=struk&id=$kodetrans");
				if ($insert) {
					echo "<script>alert('Berhasil')</script>";
				} else {
					echo "<script>alert('Gagal".mysqli_error($conn)."')</script>";
				}
			}
		}
	}
 ?>
<div class="panel panel-default">
	<div class="panel-heading main-color-bg">
		<div class="panel-title">
			Transaksi Pembayaran
		</div>
	</div>
	<br>
	<div class="panel-body">
		<form method="post">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="tile">
						<div class="form-group">
							<label class="control-label">Kode Transaksi</label>
							<input type="text" name="kd_transaksi" readonly placeholder="Kode Transaksi" class="form-control" value="<?= $kodetrans ?>" required>
						</div>
						<div class="form-group">
							<label class="control-label">Total Harga</label>
							<input type="text" name="total" id="total" readonly placeholder="Total Harga" class="form-control" value="<?= @$assoc['sub'] ?>" required>
						</div>
						<div class="form-group">
							<label class="control-label">Bayar</label>
							<input type="number" name="bayar" id="bayaran" class="form-control" placeholder="Masukan Pembayaran" required>
						</div>
						<div class="form-group">
							<label class="control-label">Kembalian</label>
							<input type="text" readonly placeholder="Kembalian" name="kembalian" id="kembalian" name="nama_barang" class="form-control">
						</div>
						<div class="form-group" align="center">
							<button class="btn btn-primary" name="selesai"><i class="fa fa-cart-plus"></i> Selesai</button>
							<a href="?menu=transaksi" class="btn btn-danger" name="kembali"><i class="fa fa-repeat"></i> Kembali</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function(){
        $('#bayaran').keyup(function(){
        	var bayar = $(this).val();
        	var total = $('#total').val();
        	var kembalian = bayar - total;
        	$('#kembalian').val(kembalian);
        });
	})
</script>