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
	//pertama kita coba dapatkan dulu id absen berdasarkan data useridnya untuk proses update
	//jika variabel bernilai kosong maka kita kembalikan ke index
	if(empty($obj->get_idabsen(1)))
	{
		echo 
					'
					<script> 
						window.alert("Anda harus melakukan absen masuk terlebih dahulu");
						window.location.href="index.php";
						

					</script>
					';
	}
	else
	{				
		//Selanjutnya kita cek dulu apakah dia sudah melakukan absen keluar sebelumnya
		if($obj->cek_Absenkeluar(1))
		{
		//jika sudah absen sebelumnya arahkan ke index.php

					echo 
					'
					<script> 
						window.alert("Anda sudah absen keluar hari ini");
						window.location.href="index.php";
						

					</script>
					';
		}
		else
		{
		//tapi jika belum, kita lakukan query ke id user untuk mendapatkan id absen berdasarkan tgl masuk
		//jika dia belum melaukan absen masuk maka dia akan dikembalikan ke halaman utama
			if($_SERVER['REQUEST_METHOD']=='POST')
			{
				//format tanggal akan dibuat seperti format di mysql
			
		
				$tgl_keluar = date('Y-m-d');
				$jam_keluar = date('H:i:s');

				if($obj->update_Absenkeluar($tgl_keluar,$jam_keluar,$obj->id_absen))
				{
					echo 
					'
					<script> 
						window.alert("Anda berhasil absen kelaur hari ini");
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
			<td colspan="2">Formulir Absen keluar</td>
		</tr>
		<tr>
			<td>Siap untuk absen ?</td>
			<td><input type="submit" name="absen" value="Klik Absen keluar"></td>
		</tr>
		

	</table>
	
</form>


<?php }}?>

	</body>
</html>