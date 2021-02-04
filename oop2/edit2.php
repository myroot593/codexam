
<?php

require_once ('database.php');
require_once ('sql.php');
$obj = new crud;

if(!$obj->getTable($_GET['id_mahasiswa'],'id_mahasiswa','tb_mahasiswa','id_mahasiswa=:id_mahasiswa')) die("Error : id mahasiswa tidak ada");
if($_SERVER['REQUEST_METHOD']=='POST'):
	$nim  = $_POST['nim'];
	$nama = $_POST['nama_mahasiswa'];
	if($obj->updateTable('tb_mahasiswa', 'nim=:nim,nama_mahasiswa=:nama_mahasiswa', 'id_mahasiswa=:id_mahasiswa', array(":nim"=>$nim, ":nama_mahasiswa"=>$nama,":id_mahasiswa"=>$obj->row['id_mahasiswa']))):
	//if($obj->updateData($nim, $nama, $obj->id_mahasiswa)):
		echo '<div class="alert alert-success">Data berhasil disimpan</div>';
	else:

		echo '<div class="alert alert-danger">Data berhasil disimpan</div>';
	endif;
endif;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tutorial PHP : CRUD OOP PHP Part II</title>

	<link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

</head>
<body>
	<div class="container">
		<div class="card shadow mb-4 mt-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Tutotrial PHP : CRUD PDO OOP PHP PART II : Meringkas Kode - ROOT93.CO.ID</h6>
	            </div>
	        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
		        <div class="card-body">
					<div class="row">
						
						<div class="col-md-4">
							<div class="form-group">
								<label>NIM :</label>
								<input type="text" class="form-control" name="nim" value="<?php echo $obj->row['nim']; ?>"/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>NAMA MAHASISWA :</label>
								<input type="text" class="form-control" name="nama_mahasiswa" value="<?php echo $obj->row['nama_mahasiswa']; ?>"/>
							</div>
						</div>
						<div class="col-md-4">
							
								<button type="submit" class="mt-4 btn btn-md btn-primary"> Simpan</button>
								<a href="index.php" class="mt-4 btn btn-md btn-primary">Kembali</a>
						
						</div>
					</div>
				</div>
			</form>
	
		</div>
	</div>

<script src="../assets/jquery/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>