<?php
require_once('db.php');
require_once('class.upload.php');

$obj = new upload;

$error = array();

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$obj->getImage2('image');

		if(!$obj->fileExtension($obj->file_extension, $obj->file_valid)):
				array_push($error, "Maaf ektensi file salah");
		elseif($obj->fileSize($obj->file_size)):
			array_push($error,"Maaf file terlalu besar");
		
		endif;
		

		/* With no rename new image
		if(count($error)==0):
			if(move_uploaded_file($obj->file_tmp, $obj->file_target)):
				if($obj->insertImage($obj->file_name, $obj->image)):
					echo "Gambar berhasil di upload";
				else:
					echo "Gambar gagal di upload";
				endif;
			else:
				echo "Gagal mengunggah gambar";
			endif;
		endif;
		*/
		if(count($error)==0):
			if(move_uploaded_file($obj->file_tmp,$obj->file_dir.$obj->file_item)):
				if($obj->insertImage($obj->file_item, $obj->image)):
					echo "Gambar berhasil di upload";
				else:
					echo "Gambar gagal di upload";
				endif;
			else:
				echo "Gagal mengunggah gambar";
			endif;
		endif;



	
}

$obj->getError($error);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		<input type="file" name="image">
		<input type="submit" name="upload" value="upload">
	</form>
	<table class="table table-bordered">
					<tr>
						<th>NO</th>
						<th>FOTO DB</th>
						<th>FOTO BASE64</th>
						
					</tr>
					<?php 
					
						$data=$obj->imageFetch();
					
						while($row=$data->fetch(PDO::FETCH_ASSOC)){
					?>
					<tr>
						
						<td><img src="image/<?php echo $row['name']; ?>" width="100px"></td>
						<td><img src="<?php echo $row['image']; ?>" width="100px"></td>
						
					</tr>
					<?php  } $data->closeCursor();?>

									
									
				</table>
</body>
</html>
