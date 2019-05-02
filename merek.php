<?php 
	include 'controller.php';
	$dos = new oop();

	$table = "table_merek";
	$where = "kd_merek";
	@$whereValues = $_GET['id'];
	$form = "?menu=merek";
	$data = $dos->select($table);
	$pre = "M";

	$kode = $dos->kode_auto($table, $where, $pre);

	if (isset($_POST['simpan'])) {
		$kd_merek = $_POST['kd_merek'];
		$merek = $_POST['merek'];
		$values = "'$kd_merek','$merek'";
		$dos->simpan($table,$values,$form);
	}

	if (isset($_GET['hapus'])) {
		$dos->delete($table,$where,$whereValues,$form);
	}

?>



<a class="btn btn-primary" href="#addmerek" data-toggle="modal" style="margin-bottom: 5px;">Tambah Merek</a>
<!-- Medal Input Distributor -->

<div class="modal fade" id="addmerek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
		    <form method="post">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Add Merek</h4>
		      </div>
		      <div class="modal-body">
			        <div class="form-group">
			          <label>Kode Merek</label>
			          <input type="text" class="form-control" readonly value="<?= $kode ?>" name="kd_merek">
			        </div>
			        <div class="form-group">
			          <label>Nama Merek</label>
			          <input type="text" name="merek" autofocus class="form-control" placeholder="Masukan Nama Merek.." required>
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

<!-- Medal Edit -->

<div class="modal fade" id="medalbuatedit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
		    <form method="post">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Edit Merek</h4>
		      </div>
		      <div class="modal-body" id="medalbuatedit">
			        <div class="form-group">
			          <label>Kode Merek</label>
			          <input type="text" id="kd_merekko" class="form-control" readonly value="" name="kd_merek">
			        </div>
			        <div class="form-group">
			          <label>Nama Merek</label>
			          <input type="text" name="merek" autofocus id="merekko" class="form-control" required>
			        </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" name="simpan" class="btn btn-primary">Update</button>
		      </div>
		  </div>
		    </form>
    	</div>
  	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading main-color-bg">
		<div class="panel-title">Data Merek</div>
	</div>
	<div class="panel-body">
		<table class="table table-bordered table-hover" id="sampleTable">
			<thead>
				<tr>
					<th>Kode Merek</th>
					<th>Nama Merek</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				foreach ($data as $me) { ?>
				<tr>
					<td id="data-kode<?= $no; ?>"><?= $me['kd_merek'] ?></td>
					<td id="data-merek<?= $no; ?>"><?= $me['merek']?></td>
					<td align="center">
						<div class="btn-group">	
							<a class="btn btn-primary" id="editt<?= $no; ?>" data-target="#medalbuatedit" data-toggle="modal" style="margin-bottom: 5px;" data-id="<?= $me['kd_merek'] ?>">Edit</a>
							<a href="?menu=merek&hapus&id=<?= $me['kd_merek'] ?>" class="btn btn-danger">Hapus</a>
						</div>
					</td>
				</tr>
				<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
				<script>
					$(document).ready(function() {
		              $("#editt<?= $no;  ?>").click(function(){
		                var kd_merek = $("#data-kode<?= $no;  ?>").html();
		                var merek = $("#data-merek<?= $no;  ?>").html();
		                $("#kd_merekko").val(kd_merek);
		                $("#merekko").val(merek);
		            });
		          });
				</script>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>