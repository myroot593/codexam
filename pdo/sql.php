<?php
class crud extends database
{
	
	
	public function showData()
	{
		$sql ="SELECT * FROM tb_mahasiswa";
		$stmt=$this->koneksi->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	public function insertData($nim, $nama)
	{
		try
		{
			$sql="INSERT INTO tb_mahasiswa(nim, nama_mahasiswa) VALUES (:nim, :nama_mahasiswa)";
			$stmt=$this->koneksi->prepare($sql);
				$stmt->bindParam(":nim",$nim);
				$stmt->bindParam(":nama_mahasiswa", $nama);
				$stmt->execute();
				return true;
		}
		catch(PDOException $e)
		{
				echo $e->getMessage();
				return false;
				
			
		}
	}
	public function detailData($data)
	{
		# GET DATA
		try
		{
			$sql ="SELECT id_mahasiswa, nim, nama_mahasiswa FROM tb_mahasiswa WHERE id_mahasiswa=:id_mahasiswa";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->bindParam(":id_mahasiswa",$data);
			$stmt->execute();
			$stmt->bindColumn(1, $this->id_mahasiswa);
			$stmt->bindColumn(2, $this->nim);
			$stmt->bindColumn(3, $this->nama_mahasiswa);
			$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount()==1):
				return true;
			else:
				return false;
			endif;

			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			
		}
	}
	public function detailData_duatest($data)
	{
		# Sample GET DATA by ID
		try
		{
			$sql ="SELECT id_mahasiswa, nim, nama_mahasiswa FROM tb_mahasiswa WHERE id_mahasiswa=:id_mahasiswa";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->execute(array(":id_mahasiswa"=>$data));
			$this->row=$stmt->fetch(PDO::FETCH_ASSOC);
			return $this->row;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function updateData($nim, $nama, $data)
	{
		try
		{
			$sql="UPDATE tb_mahasiswa SET nim=:nim, nama_mahasiswa=:nama_mahasiswa WHERE id_mahasiswa=:id_mahasiswa";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->bindParam(":nim",$nim);
			$stmt->bindParam(":nama_mahasiswa",$nama);
			$stmt->bindParam(":id_mahasiswa",$data);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	public function delete ($data)
	{
		try{
			$sql="DELETE FROM tb_mahasiswa WHERE id_mahasiswa=:id_mahasiswa";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->execute(array("id_mahasiswa"=>$data));
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
}
?>