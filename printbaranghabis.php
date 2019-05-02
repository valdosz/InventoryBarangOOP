 	<style>
 		@media print{
 			.btn{
 				display: none !important;
 			}
 			header{
 				display: none !important;
 			}
 			aside{
 				display: none !important;
 			}
 			a,hr,br{
 				display: none !important;
 			}
 			.naon{
 				display: none !important;
 			}
 		}
 	</style>
 	<script type="text/javascript">window.print()</script>
	<div class="col-sm-12" style="background: white; padding: 50px;">
		<!-- <div class="tile"> -->
			<h3>Data Barang Habis</h3>
			<?php 
				include "controller.php";
				$qb = new oop();
				$dataB = $qb->edit("detailbarang","stok_barang",0);
				$dateNow = date("Y-m-d");
			 ?>
			<table border="1" cellspacing="0" width="100%;" cellpadding="10">
                <thead>
                  <tr>
                    <th>Kode barang</th>
                    <th>Nama barang</th>
                    <th>Merek</th>
                    <th>Distributor</th>
                    <th>Tanggal Masuk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach($dataB as $ds){ ?>
					<tr>
						<td><?= $ds['kd_barang'] ?></td>
						<td><?= $ds['nama_barang'] ?></td>
						<td><?= $ds['merek'] ?></td>
						<td><?= $ds['nama_distributor'] ?></td>
						<td><?= $ds['tanggal_masuk'] ?></td>
						<td><?= $ds['harga_barang'] ?></td>
						<td><?= $ds['stok_barang'] ?></td>
                  <?php $no++; } ?>
                </tbody>
              </table>
		<!-- </div> -->
	</div>