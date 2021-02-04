<?php
/* 
	
	| Copyleft : ROOT93
	| Terima kasih sudah membaca dan memahami kode saya. Semua contoh kode dan konsep
	| yang saya tulis bisa Anda pergunakan kembali atau memodifikasinya sesuai dengan
	| kebutuhan.
	| Terima Kasih :)
	| Author=>Ahmad Zaelani
	| ------------------------------------------------------------------------------------------
	| Catatan :
	| Anda bisa melihat tutorial sebelumnya di root93 tentang CRUD OOP PDO PHP
	| ------------------------------------------------------------------------------------------
	| link
	| parameter yang disederhanakan untuk koneksi ke database
	| ------------------------------------------------------------------------------------------
	| selectTable
	| Perintah ini digunakan untuk memilih table, atau meng-GET table berdasarkan nama table
	| dan parameter WHERE. Untuk menggunakannya Anda perlu mendefinisikannnya seperti berikut
	| Tanpa WHERE bisa diakses misal seperti :
	| $obj->selectTable('nama_table',NULLL)
	| Jika misal dengan where diakses pada fungsi lain, maka Anda bisa mendefinisikan
	| parameternya misal seperti :
	| $this->selectTable('nama_table','parameter_data=:parameter_data')
	| dan tentunya cara penggunaanya bisa Anda improvisasi sendiri sesuai konsep PDO OOP PHP 
	| ------------------------------------------------------------------------------------------
	| insertTable
	| Fungsi ini digunakan untuk menggantikan fungsi insertData() sehingga dengan cukup dengan
	| satu fungsi ini bisa beroperasi untuk input data ke berbagai macam tabel tanpa
	| harus membuat fungsi insert dan mendefinisikan ulang didalam query.
	| Untuk menggunakan perintah, Anda bisa mendefinisikan 4 parameter didalam fungsinya
	| yaitu $table, $vartable, $value, dan $array
	| $table untuk mewakili nama table
	| $vartable untuk mendefinisikan kolom tabel
	| $value untuk mendefinisikan nilai kolom tabel
	| $array untuk mendefinisikan eksekusi pada kolom tabel bersama nilainya
	| ------------------------------------------------------------------------------------------
	| getTable
	| Perintah ini bisa digunakan untuk mendapatkan data dari table 
	| dengan memnafatkan perintah selectTable(). Perintah ini menggantikan perintah 
	| sebelumnya detailData() dan detailData_duatest().
	| Pada saat MENCETAK OBJEK, Anda harus mendefinisikan data dengan get $data,
	| $par mendefinisikan kolom table untuk parameter bindParam atau execute dengan array
	| $table untuk mendefinisikan nama table dan $where untuk spesifikasi datanya
	| ------------------------------------------------------------------------------------------
	| deleteData
	| Fungsi ini menggantikan fungsi delete sebelumnya, dengan fungsi ini kita bisa ber
	| operasi untuk mendelete data dari berbagai tabel menggunakan satu fungsi ini
	| ------------------------------------------------------------------------------------------
	| pagination
	| Fungsi ini untuk penyederhanaan pagination halaman/pembagian halaman, terdiri dari
	| dua parameter yaitu fungsi pagination sebagai query dan paginationNumber sebagai
	| penomoran halaman
	| $name sebagai parameter nama pemanggilan get halaman
	| $number sebagai jumlah pembagian perhalaman
			
*/
class crud extends database
{

	protected function link($data)
	{
		$stmt=$this->koneksi->prepare($data);
		return $stmt;
	}
	public function selectTable($table, $where)
	{
		try
		{
			if(!empty($where)):
				$sql="SELECT * FROM $table WHERE $where";
				$stmt=$this->link($sql);
				return $stmt;
			else:
				$sql="SELECT * FROM $table";
				$stmt=$this->link($sql);
				$stmt->execute();
				return $stmt;
			endif;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function insertTable($table, $vartable, $value, $array)
	{
		
		try
		{
			$sql="INSERT INTO $table($vartable) VALUES($value)";
			$stmt=$this->link($sql);
			$stmt->execute($array);
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	public function getTable($data, $par, $table, $where)
	{
		try
		{
			$stmt=$this->selectTable($table, $where);
			$stmt->execute(array(":$par"=>$data));
			$this->row=$stmt->fetch(PDO::FETCH_ASSOC);
			return $this->row;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function updateTable($table, $vartable, $value, $array)
	{
		try
		{
			$sql="UPDATE $table SET $vartable WHERE $value";
			$stmt=$this->link($sql);
			$stmt->execute($array);
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	public function deleteData($table, $vartable, $array)
	{
		try
		{
			$sql="DELETE FROM $table WHERE $vartable";
			$stmt=$this->link($sql);
			$stmt->execute($array);
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return false;
		}

	}
	public function selectTable_limit($table, $start, $finish)
	{
		try
		{
			$sql="SELECT * FROM $table LIMIT $start, $finish";
			$stmt=$this->link($sql);		
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function pagination($name, $table, $number)
	{
		
		$finish = $number;
		//jumlah pembagian perhalaman
		
		$page = isset($_GET[$name]) ? (int)$_GET[$name]:1;
		//jika kondisi get tidak terpenuhi maka nilai page = 1
		
		$start = ($page>1) ? ($page * $finish ) - $finish:0;

		//konisi start akan menjadi 0 jika tidak ada get
		//sehingga default querynya akan menjadi LIMIT 0, $finish

		$stmt=$this->selectTable_limit($table, $start, $finish);
		//eksekusi query dengan fungsi limit
		
		$stmt->execute();
		return $stmt;


	}
	public function paginationNumber($table, $number)
	{
		$stmt=$this->selectTable($table,NULL);
		$total=$stmt->rowCount();
		$no_perpage=ceil($total/$number);

		echo'<ul class="pagination justify-content-center">';
		for ($i=1; $i<=$no_perpage; $i++)
		{ 
               
            echo
            '
             	<li class="page-item">          
	                <a class="page-link" href="?halaman='.$i.'">'.$i.'</a>
	            </li>
            ';
                
        }
        echo'</ul>';
        
	}
	# Fungsi lama yang tidak universal

	public function insertData($nim, $nama)
	{
		try
		{
			$sql="INSERT INTO tb_mahasiswa(nim, nama_mahasiswa) VALUES (:nim, :nama_mahasiswa)";
			$stmt=$this->koneksi->prepare($sql);
			//jika ingin menggunakan bindParam, Anda bisa menghilangkan array di execute
			//$stmt->bindParam(":nim",$nim);
			//$stmt->bindParam(":nama_mahasiswa", $nama);
			//dengan array sebenarnya lebih enak karena ditulis dalam satu baris
			$stmt->execute(array(":nim"=>$nim,":nama_mahasiswa"=>$nama));
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
		
		try
		{
			#$sql="SELECT * FROM tb_mahasiswa WHERE id_mahasiswa=:id_mahasiswa";
			#$stmt=$this->koneksi->prepare($sql);
			$stmt=$this->selectTable('tb_mahasiswa','id_mahasiswa=:id_mahasiswa');
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
		
		try
		{
			$stmt=$this->selectTable('tb_mahasiswa','id_mahasiswa=:id_mahasiswa');			
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
			$stmt->bindParam(":id_mahasiswa",$data);
			$stmt->execute();
			//$stmt->execute(array(":id_mahasiswa"=>$data));
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