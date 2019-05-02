<?php 
	include 'controller.php';
	$dos = new oop();
	$data = $dos->edit("detailbarang","stok_barang",0);
?>

<button class="btn btn-primary" style="margin-bottom: 5px;"><a href="printbaranghabis.php" style="color: white" target="output"><i class="fa fa-print"> </i> Print</a></button>
<button class="btn btn-success" style="margin-bottom: 5px;"><a href="exportbaranghabis.php" style="color: white" target="output"><i class="fa fa-file"> </i> Export Excel</a></button>

<div class="panel panel-default">
	<div class="panel-heading main-color-bg">
		<div class="panel-title">Laporan Barang</div>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-hover" id="sampleTable">
			<thead>
		        <tr>
		  				<th>Kode </th>
		  				<th>Nama </th>
		  				<th>Merek</th>
		  				<th>Distributor</th>
		  				<th>Harga </th>
		  				<th>Stok </th>
		          		<th>Keterangan</th>
		          		<th>Tgl Masuk</th>
		  		</tr>
	      	</thead>
	      	<tbody>
		          <?php
		          $no = 1; 
		          foreach ($data as $br) { ?>
	        	<tr>
			          <td><?php echo $br['kd_barang'] ?></td>
			          <td><?php echo $br['nama_barang'] ?></td>
			          <td><?= $br['merek'] ?></td>
			          <td><?= $br['nama_distributor']  ?></td>
			          <td><?php echo "Rp.".number_format($br['harga_barang']) ?></td>
			          <td><?php echo $br['stok_barang'] ?></td>
			          <td><?= $br['keterangan']  ?></td>
			          <td><?= $br['tanggal_masuk'] ?></td>
	        	</tr>          
	          <?php $no++; } ?>
	      	</tbody>
		</table>
	</div>
</div>
