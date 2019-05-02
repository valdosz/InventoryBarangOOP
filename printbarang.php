<?php 
	include 'controller.php';
	$dos = new oop();
	$data = $dos->select('detailbarang');
?>
		<script>window.print()</script>
		<section class="forms">
			<h1 align="center">Data Barang</h1>
			<table align="center" class="table table-striped" border="1" cellpadding="8" cellspacing="0">
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
				          <td><?php echo $br['harga_barang'] ?></td>
				          <td><?php echo $br['stok_barang'] ?></td>
				          <td><?= $br['keterangan']  ?></td>
				          <td><?= $br['tanggal_masuk'] ?></td>
		        	</tr>          
		          <?php $no++; } ?>
		      	</tbody>
			</table>
		</section>
