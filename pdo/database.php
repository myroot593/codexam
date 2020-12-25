<?php


	
class database
{
	private $host="localhost";
	private $user="root";
	private $pass="";
	private $db="codexam";
	protected $koneksi;
	public function __construct(){

		try
		{
				$this->koneksi = new PDO("mysql:host=$this->host; dbname=$this->db",$this->user, $this->pass);
				$this->koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
				echo $e->getMessage();
		}
		return $this->koneksi;
	}
		
}

?>
