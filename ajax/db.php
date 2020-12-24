<?php
class db
{
	private $host="localhost";
	private $user="root";
	private $pass="";
	private $db="codexam";
	protected $con;
	public function __construct()
	{
		$this->con = new mysqli($this->host, $this->user, $this->pass, $this->db);
		if($this->con==false)die('Tidak dapat terhubung ke database'.$this->con->connect_error());
		return $this->con;
	}
}
class main extends db
{
	public function listFakultas()
	{
		$sql ="SELECT id_fakultas, nama_fakultas FROM fakultas";
		$perintah=$this->con->query($sql);
		return $perintah;
	}
	public function listProdi_selectAjax($data)
	{
		$sql="SELECT id_prodi, nama_prodi FROM prodi WHERE id_fakultas='$data'";
		$result=$this->con->query($sql);
		while($row=$result->fetch_assoc()):
			$dataset[]=$row;
		endwhile;
		if(!empty($dataset))return $dataset;
	}
}

?>