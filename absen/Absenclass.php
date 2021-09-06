<?php 
class Absensiswa extends Database
{
	
	public function data_Absen($userid)
	{
		try
		{
			$sql = "SELECT * FROM absen_masuk WHERE userid=$userid";
			$stmt = $this->koneksi->prepare($sql);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function cek_Absenmasuk($userid)
	{
		try
		{
			$sql = "SELECT * FROM absen_masuk WHERE tgl_masuk=CURRENT_DATE() AND userid=$userid";
			$stmt = $this->koneksi->query($sql);
			if($stmt->execute())
			{
				if($stmt->rowCount()==1)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function cek_Absenkeluar($userid)
	{
		try
		{
			$sql = "SELECT * FROM absen_masuk WHERE tgl_keluar=CURRENT_DATE() AND userid=$userid";
			$stmt = $this->koneksi->prepare($sql);
			$stmt->execute();
			if($stmt->rowCount()==1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function get_idabsen($userid)
	{
		//mendapatkan id absen berdasarkan id user yang aktif
		try
		{
			$sql = "SELECT id_absen FROM absen_masuk WHERE tgl_masuk=CURRENT_DATE() AND userid=$userid";
			$stmt = $this->koneksi->prepare($sql);
			$stmt->execute();
			$stmt->bindColumn(1,$this->id_absen);
			$stmt->fetch(PDO::FETCH_BOUND);
			return $this->id_absen?$this->id_absen:''; //akan menghasilkan string kosong jika tidak ada
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function insert_Absenmasuk($userid, $tgl_masuk, $jam_masuk)
	{
		try
		{
			$sql = "INSERT INTO absen_masuk(userid, tgl_masuk, jam_masuk) VALUES(:userid,:tgl_masuk, :jam_masuk)";
			$stmt = $this->koneksi->prepare($sql);
			$stmt->bindParam(":userid",$userid);
			$stmt->bindParam(":tgl_masuk",$tgl_masuk);
			$stmt->bindParam(":jam_masuk",$jam_masuk);

			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}	
	}
	public function update_Absenkeluar($tgl_keluar, $jam_keluar, $id_absen)
	{
		try
		{
			$sql = "UPDATE absen_masuk SET tgl_keluar=:tgl_keluar, jam_keluar=:jam_keluar WHERE id_absen=:id_absen";
			$stmt = $this->koneksi->prepare($sql);
			$stmt->bindParam(":tgl_keluar",$tgl_keluar);
			$stmt->bindParam(":jam_keluar",$jam_keluar);
			$stmt->bindParam(":id_absen",$id_absen);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function __destruct()
	{
		return true;
	}
}