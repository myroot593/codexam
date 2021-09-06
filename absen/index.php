<?php

require_once('database.php');
require_once('Absenclass.php');
$obj = new Absensiswa;

$d = $obj->data_Absen(1); //kita set usernya misal punya id satu

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Data Absensi - Tutorial PHP Supaya user hanya bisa input sekali dalam sehari - root93</title>
</head>
<body>
	<div style="margin-top: 20px;">
		<p> Anggap saja disini user sedang aktif dengan membawa sesion yang berisi idnya <br>
		. Jadi kita query berdasarkan iduser pada session</p>
		<table border="1" width="500">

				<tr>
					<th colspan="4">Tutorial PHP - root93</th>

				</tr>
				<tr>

					<th colspan="2"><a href="absen_masuk.php">Absen masuk</a></th>
					<th colspan="2"><a href="absen_keluar.php">Absen keluar</a></th>
				<tr>
					<th>UserId</th>
					<th>Tgl Masuk</th>
					<th>Jam masuk</th>
					<th>Jam Keluar</th>
				</tr>
				<?php
					if($d->rowCount()>0)
					{
					while($row = $d->fetch(PDO::FETCH_ASSOC)){
				?>
				<tr>
					<th><?=$row['userid'];?></th>
					<th><?=$row['tgl_masuk'];?></th>
					<th><?=$row['jam_masuk'];?></th>
					<th><?=$row['jam_keluar'];?></th>
				</tr>
				<?php }}?>

			
		</table>
	</div>
</body>
</html>