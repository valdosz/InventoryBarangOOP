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
				<?php if (!isset($_GET['id'])): ?>
				<script type="text/javascript">window.print()</script>
				<h4>Data Semua Transaksi</h4>
					<p><b><i>Inventory ME</i></b></p>
				<hr>
				<p class="text-right"><?php echo "Tanggal Cetak : ".date("Y-m-d"); ?></p>
				<table class="table table-hover table-bordered" border="1" width="100%;" align="center" cellpadding="8" cellspacing="0">
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
		    <?php endif ?>