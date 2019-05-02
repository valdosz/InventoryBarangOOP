<?php
	include 'controller.php';
	$dos = new oop();
	$datat = $dos->select("transaksi_terbaru");

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$dataDetail = $dos->edit("view_transaksi","kd_transaksi",$id);
		$dataD = $dos->edit("table_transaksi","kd_transaksi",$id);
		$total  = $dos->selectSumWhere("transaksi","sub_total","kd_transaksi='$id'");
        $jumlah_barang = $dos->selectSumWhere("transaksi","jumlah","kd_transaksi='$id'");
	}
?>
<div class="panel panel-default">
	<div class="panel-heading main-color-bg">
		<div class="panel-title">Laporan Penjualan</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-sm-9">
			<?php if (isset($_GET['id'])): ?>
				<h4>Struk</h4>
				<p>Inventory Me</p>
				<hr>
	            <div class="row">
	                <div class="col-sm-6">Kode Transaksi : <?php echo $id ?></div>
	                <div class="col-sm-6">
	                    <p class="text-right"><span><?php echo "Tanggal Cetak : ".date("Y-m-d"); ?></span></p>
	                </div>
	            </div>
				<table class="table table-striped table-bordered" width="80%">
					<tr>
						<td>Kode Antrian</td>
						<td>Nama Barang</td>
		                <td>Harga Satuan</td>
						<td>Jumlah</td>
						<td>Sub Total</td>
					</tr>
					<?php foreach ($dataDetail as $dd): ?>
					<tr>
						<td><?= $dd['kd_pretransaksi'] ?></td>
						<td><?= $dd['nama_barang'] ?></td>
		                <td><?= $dd['harga_barang'] ?></td>
						<td><?= $dd['jumlah'] ?></td>
						<td><?= "Rp.".number_format($dd['sub_total']) ?></td>
					</tr>
					<?php endforeach ?>
					<tr>
		                <td colspan="2"></td>
		                <td>Jumlah Pembelian</td>
		                <td><?php echo $jumlah_barang['sum'] ?></td>
		                <td></td>
		            </tr>
		            <tr>
						<td colspan="2"></td>
						<td colspan="2">Total</td>
						<td><?= "Rp.".number_format($total['sum']); ?></td>
					</tr>
					<?php foreach ($dataD as $bos) : ?>
					<tr>
						<td colspan="2"></td>
						<td colspan="2">Bayar</td>
						<td><?= "Rp.".number_format($bos['bayar']) ?></td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td colspan="2">Kembalian</td>
						<td><?= "Rp.".number_format($bos['kembalian']) ?></td>

					</tr>
					<?php endforeach ?>
					
					
				</table>
	            <p>Tanggal Beli : <?php echo $dd['tanggal_beli']; ?></p>
			<br>
			<a target="output" class="btn btn-primary" href="printstruk.php?id=<?php echo $id ?>">Print</a>
			<?php endif ?>
			<?php if (!isset($_GET['id'])): ?>
				<h4>Data Semua Transaksi</h4>
					<p><b><i>Inventory ME</i></b></p>
				<hr>
				<p class="text-right"><?php echo "Tanggal Cetak : ".date("Y-m-d"); ?></p>
				<table class="table table-hover table-bordered" width="100%;" align="center">
		            <thead>
		            	<tr>
		            		<td>Kode Transaksi</td>
		            		<td>Jumlah Beli</td>
		            		<td>Total Harga</td>
		            		<td>Tanggal Beli</td>
		            	</tr>
		            </thead>
		            <tbody>
		            	<?php foreach ($datat as $dts): ?>
		            	<tr>
		            		<td><?= $dts['kd_transaksi'] ?></td>
		            		<td><?= $dts['jumlah_beli'] ?></td>
		            		<td><?= "Rp.".number_format($dts['total_harga']).",-" ?></td>
		            		<td><?= $dts['tanggal_beli'] ?></td>
		            	</tr>
		            	<?php endforeach ?>
		            	<?php 
		            	$grand = $dos->selectSum("transaksi","sub_total");
		            	?>
		            	<tr>
		            	 	<td colspan="2"></td>
		            	 	<td>Grand Total</td>
		            	 	<td><?php echo "Rp.".number_format($grand['sum']).",-" ?></td>
		            	</tr>

		            </tbody>
		        </table>
		        <a href="printtransaksi.php" target="output" type="submit" class="btn btn-primary">Print</a>
			<?php endif ?>
			</div>
<!-- Mencari Data Transaksi  -->
			<div class="col-sm-3">
				<div class="tile">
					<h4>Cari Transaksi</h4>
					<hr>
					<form method="post">
						<div class="form-group">
							<a class="btn btn-primary btn-block" href="#modaldos" data-toggle="modal">Pilih Barang</a>
						</div>
			                <a href="?menu=kelola_transaksi" class="btn btn-danger btn-block"><i class="fa fa-repeat"></i> Reload</a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Pilih Transaksi -->
<div class="modal fade bd-example-modal-lg" id="modaldos">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            	<h3>Pilih Transaksi</h3>
            </div>
            <div class="modal-body modal-lg">
            	<table class="table table-hover table-bordered" id="sampleTable" width="100%;" align="center">
            		<thead>
            			<tr>
            				<td>Kode Transaksi</td>
            				<td>Nama Penjual</td>
            				<td>Jumlah Beli</td>
            				<td>Total Harga</td>
            				<td>Tanggal Beli</td>
            			</tr>
            		</thead>
            		<?php 
            			foreach ($datat as $key) :
            		?>
            		<tbody>
            			<tr>
            				<td><a href="manager.php?menu=kelola_transaksi&id=<?php echo $key['kd_transaksi'] ?>"><?php echo $key['kd_transaksi']; ?></a></td>
            				<td><?= $key['nama_user'] ?></td>
            				<td><?= $key['jumlah_beli'] ?></td>
            				<td><?= "Rp.".number_format($key['total_harga']) ?></td>
            				<td><?= $key['tanggal_beli'] ?></td>
            			</tr>
            		</tbody>
            	<?php endforeach; ?>
            	</table>
            </div>
            <div class="modal-footer">
	        	<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
	      	</div>
        </div>
    </div>
</div>