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
		<?php if (isset($_GET['id'])): ?>
			<script type="text/javascript">window.print()</script>
			<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
				
	            <div class="col-md-6">
				<h4>Struk</h4>
				<p>Inventory Me</p>
				<hr>
	            <div class="row">
	                <div class="col-sm-6">Kode Transaksi : <?php echo $id ?></div>
	                <div class="col-sm-6">
	                    <p class="text-right"><span><?php echo "Tanggal Cetak : ".date("Y-m-d"); ?></span></p>
	                </div>
	            </div>
				<table class="table table-striped table-bordered" border="1" cellpadding="5" cellspacing="0" width="80%">
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
			<?php endif ?>
			</div>