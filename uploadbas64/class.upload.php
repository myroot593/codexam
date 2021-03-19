<?php

class upload extends dbh
{
	public function insertImage($name, $base)
	{
		try
		{
			$sql="INSERT INTO foto (name, image) VALUES(:name,:image)";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->bindParam(":name",$name);
			$stmt->bindParam(":image",$base);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			
			echo $e->getMessage();
			return false;
		}
	}
	public function imageFetch()
	{
		try
		{
			$sql="SELECT * FROM foto";
			$stmt=$this->koneksi->query($sql);
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			
		}
	}

	public function uploadBase64($data)
	//method 1
	{
		$this->file_name=$_FILES[$data]['name'];
		$this->file_tmp=$_FILES[$data]['tmp_name'];
		$this->file_size=$_FILES[$data]['size'];
		$this->file_extension=strtolower(pathinfo($this->file_name, PATHINFO_EXTENSION));
		$this->file_valid=array('jpg','jpeg','png');
		$this->file_dir="image/";
		$this->file_target=$this->file_dir.$this->file_name;

		if(in_array($this->file_extension, $this->file_valid)):
			$this->image64=base64_encode(file_get_contents($this->file_tmp));
			$this->image="data::image/".$this->file_extension.";base64,".$this->image64;
			if(move_uploaded_file($this->file_tmp, $this->file_target)):
				if($this->insertImage($this->file_name, $this->image)):
					return true;
				else:
					return false;
				endif;

			endif;
		endif;
	}
	public function getImage2($data)
	{
		//method 2
		# Get information
		$this->file_name=$_FILES[$data]['name'];
		$this->file_tmp=$_FILES[$data]['tmp_name'];
		$this->file_size=$_FILES[$data]['size'];
		# get ekteksion
		$this->file_extension=strtolower(pathinfo($this->file_name, PATHINFO_EXTENSION));
		# get file valid
		$this->file_valid=array('jpg','jpeg','png');
		#target upload
		$this->file_dir="image/";
		# upload with target dir and name of file
		$this->file_target=$this->file_dir.$this->file_name;
		# randon name image store to database if you wanna
		$this->file_item=rand(100,100000).".".$this->file_extension;	
		# get encode to base 64
		$this->image64=base64_encode(file_get_contents($this->file_tmp));
		# store to database with encode data
		$this->image="data::image/".$this->file_extension.";base64,".$this->image64;
			
	}
	public function fileExtension($extension, $valid)
	{
		if(in_array($extension, $valid))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function fileSize($size)
	{
		if($size>300000)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function getError($data)
	{
		if(count($data)>0)
		{
			foreach ($data as $err) {
				echo $err;
			}
		}
	}

	
}

?>
