<?php

require_once('database.php');
require_once('Absenclass.php');
$obj = new Absensiswa;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Absensi masuk siswa</title>
</head>
<body>
<?php

	# Sebelum kita menampilkan formulir, kita cek dulu apakah dia sudah absen sebelumnya
	if($obj->cek_Absenmasuk(1))
	{
	//jika sudah absen sebelumnya arahkan ke index.php

				echo 
				'
				<script> 
					window.alert("Anda sudah absen hari ini");
					window.location.href="index.php";
					

				</script>
				';
	}
	else
	{
	//jika belum, tampilkan formulirnya
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			//format tanggal akan dibuat seperti format di mysql
			$tgl_masuk = date('Y-m-d'); 
			$jam_masuk = date('H:i:s');
			if($obj->insert_Absenmasuk(1,$tgl_masuk, $jam_masuk))
			{
				echo 
				'
				<script> 
					window.alert("Anda berhasil absen hari ini");
					window.location.href="index.php";
					

				</script>
				';
				
			}
			else
			{
				echo 
				"
				<script> 
					alert('Anda gagal absen hari ini');
				</script>
				";
				
			}
		}
?>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
	<table style="border: 1px solid #ccc;" width="500px">
		<tr>
			<td colspan="2">Formulir Absen masuk</td>
		</tr>
		<tr>
			<td>Siap untuk absen ?</td>
			<td><input type="submit" name="absen" value="Klik Absen"></td>
		</tr>
		

	</table>
	
</form>


<?php }?>

	</body>
</html>