
<?php

require_once ('koneksi.php');
require_once ('sql.php');

$obj = new crud;
if($_SERVER['REQUEST_METHOD']=='POST'):
	$nim  = $_POST['nim'];
	$nama = $_POST['nama_mahasiswa'];
	if($obj->insertData($nim, $nama)):
		echo '<div class="alert alert-success">Data berhasil disimpan</div>';
	else:

		echo '<div class="alert alert-danger">Data berhasil disimpan</div>';
	endif;
endif;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tutorial PHP : CRUD OOP PHP</title>

	<link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

</head>
<body>
	<div class="container">
		<div class="card shadow mb-4 mt-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Tutotrial PHP : CRUD OOP PHP - ROOT93.CO.ID</h6>
	            </div>
	        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		        <div class="card-body">
					<div class="row">
						
						<div class="col-md-4">
							<div class="form-group">
								<label>NIM :</label>
								<input type="text" class="form-control" name="nim"/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>NAMA MAHASISWA :</label>
								<input type="text" class="form-control" name="nama_mahasiswa"/>
							</div>
						</div>
						<div class="col-md-4">
							
								<button type="submit" class="mt-4 btn btn-md btn-primary"> Simpan</button>
						
						</div>
					</div>
				</div>
			</form>
			<table class="table table-striped">
				<tr>
					<th>NO</th>
					<th>NIM</th>
					<th>NAMA MAHASISWA</th>
					<td>AKSI</td>
				</tr>
				<?php 
				$no=1;
					$data=$obj->tampilMahasiswa();
					while($row=$data->fetch_array()){
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['nim']; ?></td>
					<td><?php echo $row['nama_mahasiswa']; ?></td>
					<td>
						<?php echo "<a class='btn btn-sm btn-primary' href='edit.php?id_mahasiswa=".$row['id_mahasiswa']."'>edit</a>"; ?>
						<?php echo "<a class='btn btn-sm btn-primary' href='delete.php?id_mahasiswa=".$row['id_mahasiswa']."'>delete</a>"; ?>
					</td>
				</tr>
				<?php $no+=1; }?>
			</table>
		</div>
	</div>

<script src="../assets/jquery/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
