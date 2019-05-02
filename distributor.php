<?php 
	include 'controller.php';
	$dos = new oop();	

	// 
		$data = $dos->select("table_distributor");
		$table = "table_distributor";
		$where = "kd_distributor";
		@$whereValues = $_GET['id'];
		$form = '?menu=distributor';
		$pre = "D";

		$kode = $dos->kode_auto($table, $where, $pre);

	if (isset($_GET['hapus'])) {
		$dos->delete($table,$where,$whereValues,$form);
	}

	if (isset($_POST['update'])) {
		@$kd_distributor = $_POST['kd_distributor'];
		@$nama_distributor = $_POST['nama_distributor'];
		@$alamat = $_POST['alamat'];
		$table = "table_distributor";
		@$telpon = $_POST['notelp'];
		$values = "kd_distributor='$kd_distributor',nama_distributor='$nama_distributor',alamat='$alamat',no_telp='$telpon'";
		$dos->update($table, $values, "kd_distributor", $kd_distributor, $form);
	}

	if (isset($_POST['simpan'])) {
		@$kd_distributor = $_POST['kd_distributor'];
		@$nama_distributor = $_POST['nama_distributor'];
		@$alamat = $_POST['alamat'];
		@$telpon = $_POST['notelp'];
		$values = "'$kd_distributor', '$nama_distributor','$alamat','$telpon'";
		$dos->simpan($table, $values, $form);
	}


?>
<a class="btn btn-primary" href="#adddistributor" data-toggle="modal" style="margin-bottom: 5px;">+ Distributor</a>
    <script src="js/jquery-3.2.1.min.js"></script>
<!-- Medal Input Distributor -->

<div class="modal fade" id="adddistributor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
		    <form method="post">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Add Distributor</h4>
		      </div>
		      <div class="modal-body">
			        <div class="form-group">
			          <label>Kode Distributor</label>
			          <input type="text" name="kd_distributor" readonly class="form-control" value="<?php echo $kode ?>" required>
			        </div>
			        <div class="form-group">
			          <label>Nama Distributor</label>
			          <input type="text" name="nama_distributor"  class="form-control" placeholder="Masukan Nama Distributor.." value="" required>
			        </div>
			        <div class="form-group">
			          <label>Alamat</label>
			          <textarea type="text" name="alamat" class="form-control" value="" placeholder="Masukan Alamat" required></textarea>
			        </div>
			        <div class="form-group">
			          <label>No Telephone</label>
			          <input type="number" maxlength="13" name="notelp" class="form-control" value="" placeholder="Masukan Nomor Telephone.." required>
			        </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
		      </div>
		  </div>
		    </form>
    	</div>
  	</div>
</div>

<!--Edit Data-->
<div class="modal fade" id="modalbuatedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
		    <form method="post">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>Edit Distributor</h4>
		      </div>
		      <div class="modal-body" id="modaledit">
			        <div class="form-group">
			          <label>Kode Distributor</label>
			          <input type="text" name="kd_distributor" readonly id="kd_dist" class="form-control" value="" required>
			        </div>
			        <div class="form-group">
			          <label>Nama Distributor</label>
			          <input type="text" name="nama_distributor" autofocus="true" id="nama_dist"  class="form-control" placeholder="Masukan Nama Distributor.." value="" required>
			        </div>
			        <div class="form-group">
			          <label>Alamat</label>
			          <textarea type="text" name="alamat" id="alamat_dist" class="form-control" value="" placeholder="Masukan Alamat" required></textarea>
			        </div>
			        <div class="form-group">
			          <label>No Telephone</label>
			          <input type="number" name="notelp" id="no_telp_dist" class="form-control" value="" placeholder="Masukan Nomor Telephone.." required>
			        </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" name="update" class="btn btn-primary">Update</button>
		      </div>
		  </div>
		    </form>
    	</div>
  	</div>
</div>


<!-- -->
<div class="panel panel-default">
	<div class="panel-heading main-color-bg">
		<div class="panel-title">Data Distributor</div>
	</div>
	<div class="panel-body">
		<table class="table table-bordered table-hover" id="sampleTable">
			<thead>
				<tr>
					<th>Kode Distributor</th>
					<th>Nama Distributor</th>
					<th>Alamat</th>
					<th>No Telephone</th>
					<th>Action</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 
				$no = 1;
				foreach ($data as $dc) { ?>
				<tr>
					<td id="data-kode<?= $no; ?>"><?php echo $dc['kd_distributor']; ?></td>
					<td id="data-nama<?= $no; ?>"><?php echo $dc['nama_distributor']; ?></td>
					<td id="data-alamat<?= $no; ?>"><?php echo $dc['alamat']; ?></td>
					<td id="data-telp<?= $no; ?>"><?php echo $dc['no_telp']; ?></td>
					<td>
						<div class="btn-group">
							<a class="btn btn-primary" id="editt<?= $no;  ?>" data-target="#modalbuatedit" data-toggle="modal" style="margin-bottom: 5px;" data-id="<?= $dc['kd_distributor'] ?>">Edit</a>
							<a href="?menu=distributor&hapus&id=<?= $dc['kd_distributor'] ?>" class="btn btn-danger">Hapus</a>
						</div>
					</td>
				</tr>
				<script>
		          $(document).ready(function() {
		              $("#editt<?= $no;  ?>").click(function(){
		                var kd_distributor = $("#data-kode<?= $no;  ?>").html();
		                var nama_distributor = $("#data-nama<?= $no;  ?>").html();
		                var alamat = $("#data-alamat<?= $no;  ?>").html();
		                var notelp = $("#data-telp<?= $no;  ?>").html();
		                $("#kd_dist").val(kd_distributor);
		                $("#nama_dist").val(nama_distributor);
		                $("#alamat_dist").val(alamat);
		                $("#no_telp_dist").val(notelp);
		            });
		          });
		      </script>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>


