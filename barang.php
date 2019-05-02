<?php
  include 'controller.php';
  $dos = new oop();
  date_default_timezone_set('Asia/Jakarta');
  $data = $dos->select('table_barang');
  $table = "table_barang";
  $where = "kd_barang";
  @$whereValues = $_GET['id'];
  $form = '?menu=barang';
  $getMerek = $dos->select('table_merek');
  $getDistr = $dos->select('table_distributor');
  $pre = "B";

  $kode = $dos->kode_auto($table, $where, $pre);
  
  if (isset($_POST['simpan'])) {

      $kd_barang = $_POST['kd_barang'];
      $nama_barang = $_POST['nama_barang'];
      $kd_merek = $_POST['kode_merek'];
      $kd_distributor = $_POST['kode_dis'];
      $tanggal = date("Y-m-d H:i:s");
      $harga_barang = $_POST['harga_barang'];
      $stok = $_POST['stok'];
      $ket = $_POST['keterangan'];
      @$gambar = $_POST['gambar'];
      $nama_file = $_FILES['gambar']['name'];
      $tmp_file = $_FILES['gambar']['tmp_name'];
      move_uploaded_file($tmp_file,"img/$nama_file");

      $values = "'$kd_barang','$nama_barang','$kd_merek','$kd_distributor','$tanggal','$harga_barang','$stok','$nama_file','$ket'";

      $dos->simpan($table,$values,$form);

  }

  if (isset($_GET['hapus'])) {
      $dos->delete($table, $where, $whereValues, $form);
  }
  
  if (isset($_POST['updatestok'])) {
    @$kd_barang = $_POST['kd_barang'];
    $stok = $_POST['lama_stok'] + $_POST['baru_stok'];
    $values = "stok_barang = '$stok'";
    $dos->update($table, $values, "kd_barang", $kd_barang, $form);
  }
?>

<a class="btn btn-primary" href="#addbarang" data-toggle="modal" style="margin-bottom: 5px;">Tambah Barang</a>

<!-- Medal Input Barang -->

<div class="modal fade" id="addbarang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Barang</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kd_barang" value="<?= $kode ?>" readonly class="form-control" required>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" placeholder="Masukan Nama Barang.." required>
          </div>
          <div class="form-group">
            <label>Kode Merek</label>
            <select name="kode_merek" class="form-control" required>
            	<option value="">Pilih Merek</option>
              <?php foreach ($getMerek as $mr) {  ?>
              <option value="<?= $mr['kd_merek'] ?>"><?= $mr['kd_merek']  ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Kode Distributor</label>
            <select name="kode_dis" class="form-control" required>
              <option value="">Pilih Distributor</option>
              <?php foreach ($getDistr as $ds) { ?>
            	<option value="<?= $ds['kd_distributor'] ?>"><?= $ds['kd_distributor'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Harga Barang</label>
            <input type="number" name="harga_barang" class="form-control" placeholder="Masukan Harga Barang..." required>
          </div>
          <div class="form-group">
            <label>Stok Barang</label>
            <input type="number" name="stok" class="form-control" placeholder="Masukan Stok Barang..." required>
          </div>
          <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea type="text" name="keterangan" class="form-control" placeholder="Masukan Keterangan..." required></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- Medal Edit_Barang -->

<div class="modal fade" id="tambahhstokk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Tambah Stok</h4>
        </div>
        <div class="modal-body" id="tambahhstokk">
          <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" id="ekd_barang" name="kd_barang" class="form-control" required readonly>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" id="enama_barang" name="nama_barang" class="form-control" required readonly>
          </div>
          <div class="form-group">
            <label>Harga Barang</label>
            <input type="number" name="harga_barang" id="eharga_barang" class="form-control" required readonly>
          </div>
          <div class="form-group">
            <label>Sisa Stok</label>
            <input type="number" name="lama_stok" id="estok_barang" class="form-control" readonly required>
          </div>
          <div class="form-group">
            <label>Tambah Stok</label>
            <input type="number" name="baru_stok" id="tambah_stok" class="form-control" placeholder="Masukan Stok Barang..." required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="updatestok" class="btn btn-primary">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="panel panel-default">
	<div class="panel-heading main-color-bg">
		<div class="panel-title">Data Barang</div>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-hover" id="sampleTable">
			<thead>
        <tr>
  				<th>Kode Barang</th>
  				<th>Nama Barang</th>
  				<th>Harga Barang</th>
  				<th>Stok Barang</th>
          <th>Gambar</th>
          <th>Action</th>
  			</tr>
      </thead>
      <tbody>
          <?php
          $no = 1; 
          foreach ($data as $br) { ?>
        <tr>
          <td id="data-kode<?= $no;  ?>"><?php echo $br['kd_barang'] ?></td>
          <td id="data-nama<?= $no;  ?>"><?php echo $br['nama_barang'] ?></td>
          <td id="data-harga<?= $no;  ?>"><?php echo "Rp.".number_format($br['harga_barang']) ?></td>
          <td id="data-stok<?= $no;  ?>"><?php echo $br['stok_barang'] ?></td>
          <td id="data-gambar<?= $no;  ?>"><img src="img/<?php echo $br['gambar']; ?>" width= "80px;"></td>
          <td>
            <div class="btn-group">
              <a id="tambahh<?= $no;  ?>" data-target="#tambahhstokk" data-toggle="modal" data-id="<?= $br['kd_barang'] ?>" class="btn btn-primary">+ Stok</a>
              <a href="?menu=barang&hapus&id=<?php echo $br['kd_barang'] ?>" class="btn btn-danger">Hapus</a>
            </div>
          </td>
        </tr>
          <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
          <script>
            $(document).ready(function(){
              $("#tambahh<?= $no; ?>").click(function(){
                var kd_barang = $("#data-kode<?= $no;  ?>").html();
                var nama_barang = $("#data-nama<?=$no;  ?>").html();
                var harga_barang = $("#data-harga<?= $no;  ?>").html();
                var stok_lama = $("#data-stok<?= $no;  ?>").html();
                $("#ekd_barang").val(kd_barang);
                $("#enama_barang").val(nama_barang);
                $("#eharga_barang").val(harga_barang);
                $("#estok_barang").val(stok_lama);
              });
            });
          </script>          
          <?php $no++; } ?>
      </tbody>
		</table>
	</div>
</div>
