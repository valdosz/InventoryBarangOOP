<?php 
    include 'controller.php';

    $dos = new oop();
    $data = $dos->querySelect("SELECT * FROM table_user WHERE level ='Admin' Or level='Kasir'");
    $table = "table_user";
    $where = "kd_user";
    @$whereValues = $_GET['id'];
    $form = "?menu=kelola_pegawai";
    $pre = "P";

    $kode = $dos->kode_auto($table, $where, $pre);
    if (isset($_POST['simpan'])) {
        $kd_pegawai = $_POST['kd_pegawai'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $jabatan = $_POST['jabatan'];
        $username = $_POST['username'];
        $password = base64_encode($_POST['password']);
        $value = "'$kd_pegawai','$nama_pegawai','$username','$password','$jabatan'";
        $dos->simpan($table,$value,$form);
    }

    if (isset($_GET['hapus'])) {
        $dos->delete($table,$where, $whereValues, $form);
    }

?>



<a class="btn btn-primary" href="#addpegawai" data-toggle="modal" style="margin-bottom: 5px;"><i class="fa fa-plus"></i> Karyawan</a>

<!-- Medal Input Barang -->

<div class="modal fade" id="addpegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pegawai</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Kode Pegawai</label>
          <input type="text" name="kd_pegawai" readonly value="<?= $kode ?>" class="form-control">
        </div>
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="nama_pegawai" class="form-control" placeholder="Masukan Nama Lengkap...">
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukan Username...">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukan Password...">
        </div>
        <div class="form-group">
          <label>Jabatan</label>
          <select name="jabatan" class="form-control">
          	<option value="Admin">Admin</option>
            <option value="Kasir">Kasir</option>
            <option value="Manager">Manager</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="panel panel-default">
	<div class="panel-heading main-color-bg">
		<div class="panel-title">Data Karyawan</div>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-hover" id="sampleTable">
			<thead>
        <tr>
  				<th>Kode Pegawai</th>
  				<th>Nama Pegawai</th>
  				<th>Jabatan Pegawai</th>
          <th>Action</th>
  			</tr>
      </thead>
      <?php 
        $no = 1;
        foreach ($data as $pg) { ?>
      <tbody>
        <tr>
          <td><?= $pg['kd_user'] ?></td>
          <td><?= $pg['nama_user'] ?></td>
          <td><?= $pg['level'] ?></td>
          <td>
              <a href="?menu=kelola_pegawai&hapus&id=<?= $pg['kd_user'] ?>" class="btn btn-danger"><i class="fa fa-trash"> </i> Pecat</a>
          </td>
        </tr>
      </tbody>
      <?php $no++; } ?>
		</table>
	</div>
</div>