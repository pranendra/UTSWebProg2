<?php
$update = (isset($_GET['action']) AND $_GET['action'] == 'update') ? true : false;
if ($update) {
	$sql = $connection->query("SELECT * FROM user WHERE id='$_GET[key]'");
	$row = $sql->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($update) {
		$sql = "UPDATE user SET no_ktp='$_POST[no_ktp]', nama='$_POST[nama]', email='$_POST[email]', alamat='$_POST[alamat]', no_telp='$_POST[telp]', username='$_POST[username]'";
		if ($_POST["password"] != "") {
			$sql .= ", password='".md5($_POST["password"])."'";
		}
		$sql .= " WHERE id='$_GET[key]' AND level='admin'";
	} else {
		$sql = "INSERT INTO user (no_ktp, nama, email, no_telp, alamat, username, password, level) VALUES ('$_POST[no_ktp]', '$_POST[nama]', '$_POST[email]', '$_POST[telp]', '$_POST[alamat]', '$_POST[username]', '".md5($_POST["password"])."' , '$_POST[level]')";
	}
  if ($connection->query($sql)) {
    echo alert("Berhasil!", "?page=admin");
  } else {
		echo alert("Gagal!", "?page=admin");
  }
}
if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
  $connection->query("DELETE FROM user WHERE id='$_GET[key]' AND level='admin'");
	echo alert("Berhasil!", "?page=admin");
}
?>
<div class="row">
	<div class="col-md-4 hidden-print">
	    <div class="panel panel-<?= ($update) ? "warning" : "info" ?>">
	        <div class="panel-heading"><h3 class="text-center"><?= ($update) ? "EDIT" : "TAMBAH" ?></h3></div>
	        <div class="panel-body">
	            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
	                <input type="hidden" name="level" value="admin">
	                <div class="form-group">
	                    <label for="telp">No. KTP</label>
	                    <input type="text" name="no_ktp" class="form-control" <?= (!$update) ?: 'value="'.$row["no_ktp"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="nama">Nama</label>
	                    <input type="text" name="nama" class="form-control" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="telp">Telp</label>
	                    <input type="text" name="telp" class="form-control" <?= (!$update) ?: 'value="'.$row["no_telp"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="email">Email</label>
	                    <input type="text" name="email" class="form-control" <?= (!$update) ?: 'value="'.$row["email"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="alamat">Alamat</label>
	                    <input type="text" name="alamat" class="form-control" <?= (!$update) ?: 'value="'.$row["alamat"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="username">Username</label>
	                    <input type="text" name="username" class="form-control" <?= (!$update) ?: 'value="'.$row["username"].'"' ?>>
	                </div>
	                <div class="form-group">
	                    <label for="password">Password</label>
	                    <input type="password" name="password" class="form-control">
			                <?php if ($update): ?>
												<span class="help-block">*) Kosongkan jika tidak diubah</span>
											<?php endif; ?>
	                </div>
	                <button type="submit" class="btn btn-<?= ($update) ? "warning" : "info" ?> btn-block">Simpan</button>
	                <?php if ($update): ?>
										<a href="?page=admin" class="btn btn-info btn-block">Batal</a>
									<?php endif; ?>
	            </form>
	        </div>
	    </div>
	</div>
	<div class="col-md-8">
	    <div class="panel panel-info">
	        <div class="panel-heading"><h3 class="text-center">DAFTAR ADMIN</h3></div>
	        <div class="panel-body">
	            <table class="table table-condensed">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>KTP</th>
	                        <th>Nama</th>
	                        <th>Telp</th>
	                        <th>Email</th>
	                        <th>Username</th>
	                        <th>Alamat</th>
	                        <th class="hidden-print"></th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php $no = 1; ?>
	                    <?php if ($query = $connection->query("SELECT * FROM user WHERE level='admin'")): ?>
	                        <?php while($row = $query->fetch_assoc()): ?>
	                        <tr>
	                            <td><?=$no++?></td>
															<td><?=$row['no_ktp']?></td>
															<td><?=$row['nama']?></td>
															<td><?=$row['no_telp']?></td>
															<td><?=$row['email']?></td>
															<td><?=$row['username']?></td>
															<td><?=$row['alamat']?></td>
	                            <td class="hidden-print">
	                                <div class="btn-group">
	                                    <a href="?page=admin&action=update&key=<?=$row['id']?>" class="btn btn-warning btn-xs">Edit</a>
	                                    <a href="?page=admin&action=delete&key=<?=$row['id']?>" class="btn btn-danger btn-xs">Hapus</a>
	                                </div>
	                            </td>
	                        </tr>
	                        <?php endwhile ?>
	                    <?php endif ?>
	                </tbody>
	            </table>
	        </div>
			    <div class="panel-footer hidden-print">
			        <a onClick="window.print();return false" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i></a>
			    </div>
	    </div>
	</div>
</div>