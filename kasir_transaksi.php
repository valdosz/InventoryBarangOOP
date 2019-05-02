<?php 
	include 'controller.php';

	$query = "SELECT max(kd_pretransaksi) as maxKode FROM table_pretransaksi";
	$hasil = mysqli_query($conn,$query);
	$data = mysqli_fetch_array($hasil);
	$antrian = $data['maxKode'];
	$noUrut = (int) substr($antrian, 3, 3);
	$noUrut++;
	$char = "AN";
	$antrian = $char . sprintf("%03s", $noUrut);

	$query = "SELECT max(kd_transaksi) as maxKode FROM table_transaksi";
	$hasil = mysqli_query($conn,$query);
	$data = mysqli_fetch_array($hasil);
	$kodetrans = $data['maxKode'];
	$noUrut = (int) substr($kodetrans, 3, 3);
	$noUrut++;
	$char = "TR";
	$kodetrans = $char . sprintf("%03s", $noUrut);

	$trans     = new oop();
	$barangs   = $trans->select("table_barang");

	if (isset($_GET['beli'])) {
		$id = $_GET['id'];
		$dataR = $trans->selectWhere("table_barang","kd_barang",$id);
	}
	$sum       = $trans->selectSum("table_pretransaksi","sub_total");
	$sql2      = "SELECT COUNT(kd_pretransaksi) as count FROM table_pretransaksi WHERE kd_transaksi = '$kodetrans'";
	$exec2     = mysqli_query($conn,$sql2);
	$assoc2    = mysqli_fetch_assoc($exec2);

	if (isset($_POST['tambah'])) {
		$kd_transaksi    = $_POST['kd_transaksi'];
		$kd_pretransaksi = $_POST['kd_pretransaksi'];
		$barang          = $_POST['kd_barang'];
		$jumlah          = $_POST['jumlah'];
		$total           = $_POST['total'];

		if ($kd_transaksi == "" || $kd_pretransaksi == "" || $barang == "" || $jumlah == "" || $total == "") {
			echo "<script>alert('Lengkapi Field')</script>";;
		}
		else{
			if ($jumlah < 1) {
				echo "<script>alert('Jumlah Barang minimal 1')</script>";
			}else {
				$sisa = $trans->selectWhere("table_barang","kd_barang",$barang);
				if ($sisa['stok_barang'] < $jumlah) {
					echo "<script>alert('Stok Kurang')</script>";
				}else{
					$sql = "SELECT * FROM table_pretransaksi WHERE kd_transaksi = '$kd_transaksi' AND kd_barang = '$barang'";
					$exe = mysqli_query($conn,$sql);
					$num = mysqli_num_rows($exe);
					$dta = mysqli_fetch_assoc($exe);
					if ($num > 0 ) {
						$jumlah = $dta['jumlah'] + $jumlah;
						$value = "jumlah='$jumlah'";
						$insert = $trans->update("table_pretransaksi",$value,"kd_transaksi = '$kd_transaksi' AND kd_barang",$barang,"?menu=transaksi");
						header("location:kasir.php?menu=transaksi");
					}else{
						$value = "'$kd_pretransaksi','$kd_transaksi','$barang','$jumlah','$total'";
						$insert = $trans->simpan("table_pretransaksi",$value,"?menu=transaksi");
						header("location:kasir.php?menu=transaksi");	
					}	
				}
					
			}	
		}
	}

	if (isset($_GET['hapus'])) {
		$id       = $_GET['id'];
		$where    = "kd_pretransaksi";
		$response = $trans->delete("table_pretransaksi",$where,$id,"?menu=transaksi");
	}
 ?>
<div class="panel panel-default">
	<div class="panel-heading main-color-bg">
		<div class="panel-title">
			Transaksi
		</div>
	</div>
	<div class="panel-body">
		<form method="post">
			<div class="row">
				<div class="col-md-4">
					<div class="tile">
						<div class="row">
							<div class="col-sm-6">
								<label for="" class="control-label">Kd Transaksi</label>
								<input type="text" class="form-control" value="<?= $kodetrans; ?>" readonly name="kd_transaksi">
							</div>
							<div class="col-sm-6">
								<label for="" class="control-label">Kd Antrian</label>
								<input type="text" class="form-control" value="<?= $antrian; ?>" readonly name="kd_pretransaksi" id="antrian">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" name="kd_barang" readonly placeholder="Kode barang" value="<?= @$dataR['kd_barang'] ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								<a class="btn btn-primary" href="#modaldos" data-toggle="modal"><i class="fa fa-search"></i> Barang</a>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Harga</label>
							<input type="text" name="harga_barang" id="harga" readonly placeholder="Harga" class="form-control" value="<?= @$dataR['harga_barang'] ?>" required>
						</div>
						<div class="form-group">
							<label class="control-label">Jumlah</label>
							<input type="text" name="jumlah" id="jum" class="form-control" required>
						</div>
						<div class="form-group">
							<label class="control-label">Total</label>
							<input type="text" readonly placeholder="Total Harga" name="total" id="tot" min="0" autocomplete="off" name="nama_barang" class="form-control">
						</div>
						<div class="form-group">
							<button class="btn btn-primary" name="tambah"><i class="fa fa-plus"></i> Tambah</button>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-7">
					<div class="tile">
						<h3 style="margin-top: 0px; text-align: center;">Keranjang Barang</h3>
						<hr>
						<?php if ($assoc2['count'] > 0 || isset($_POST['btnAdd'])): ?>	
							<a class="btn btn-success" id="pembayaran" href="?menu=pembayaran">Lanjutkan ke pembayaran <i class="fa fa-cart-arrow-down"></i></a>
						<?php endif ?>
						<br><br>
						<?php
							$kr    = new oop();

							$query = "SELECT max(kd_transaksi) as maxKode FROM table_transaksi";
							$hasil = mysqli_query($conn,$query);
							$data = mysqli_fetch_array($hasil);
							$kodetrans = $data['maxKode'];
							$noUrut = (int) substr($kodetrans, 3, 3);
							$noUrut++;
							$char = "TR";
							$kodetrans = $char . sprintf("%03s", $noUrut);

							$datas     = $kr->edit("table_pretransaksi","kd_transaksi","$kodetrans");
							$sql       = "SELECT SUM(sub_total) as sub FROM table_pretransaksi WHERE kd_transaksi = '$kodetrans'";
							$exec      = mysqli_query($conn,$sql);
							$assoc     = mysqli_fetch_assoc($exec);
						 ?>
						<table class="table table-striped table-hover">
								<tr>
									<th>Kode Antrian</th>
									<th>Kode Barang</th>
									<th>Jumlah</th>
									<th>Total</th>
									<th>Action</th>	
								</tr>
								<?php 
									if (count($datas) > 0) {
							        $no = 1;
							        foreach($datas as $dd){  ?>

								<tr>
									<td><?= $dd['kd_pretransaksi']; ?></td>
									<td><?= $dd['kd_barang']; ?></td>
									<td><?= $dd['jumlah']; ?></td>
									<td><?= "Rp.".number_format($dd['sub_total']) ?></td>
									<td class="text-center">
										<a href="?menu=transaksi&hapus&id=<?php echo $dd['kd_pretransaksi'] ?>" class="btn btn-danger">Hapus</a>
									</td>
								</tr>
								<?php $no++; } ?>
							    <?php if (!$assoc['sub'] == ""): ?>
							    	<tr>
							    		<td colspan="4">Total Harga</td>
							    		<td><?php echo "Rp.".number_format($assoc['sub']) ?></td>
							    	</tr>
							    <?php endif ?>
							    <?php } else{ ?>
							    	<td colspan="5" class="text-center">Tidak ada antrian</td>
							    <?php } ?>
						</table>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>



<div class="modal fade model-wide" id="modaldos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<h3>Pilih Barang</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            	<table class="table table-hover table-bordered" id="sampleTable">
            		<thead>
            			<tr>
            				<td>Kode Barang</td>
            				<td>Nama Barang</td>
            				<td>Harga</td>
            				<td>Stok</td>
            			</tr>
            		</thead>
            		<tbody>
            			<?php foreach($barangs as $brs){ ?>
            			<tr>
            				<td><a href="kasir.php?menu=transaksi&beli&id=<?php echo $brs['kd_barang'] ?>"><?php echo $brs['kd_barang'] ?></a></td>
            				<td><?php echo $brs['nama_barang'] ?></td>
            				<td><?php echo $brs['harga_barang'] ?></td>
            				<td><?php echo $brs['stok_barang'] ?></td>
            			</tr>
            			<?php } ?>
            		</tbody>
            	</table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script>
	$(document).ready(function(){
		$('#barang_nama').change(function(){
			var barang = $(this).val();
			$.ajax({
				type:"POST",
				url :'ajaxTransaksi.php',
				data:{'selectData' : barang},
				success: function(data){
					$("#harga").val(data);
					$("#jum").val();
					var jum   = $("#jum").val();
					var kali  = data * jum;
					$("#tot").val(kali);
				}
			})
        });


        $('#jum').keyup(function(){
        	var jumlah  = $(this).val();
        	var harga   = $('#harga').val();
        	var kali    = harga * jumlah;
        	$("#tot").val(kali);
        });

        $('#bayar').keyup(function(){
        	var bayar = $(this).val();
        	var total = $('#tot').val();
        	var kembalian = bayar - total;
        	$('#kem').val(kembalian);
        })
	})
</script>
