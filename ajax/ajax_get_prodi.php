<?php
require_once ('db.php');

$obj = new main;
if(!empty($_GET['id_fakultas'])){
	$data = $_GET['id_fakultas'];
	$result=$obj->listProdi_selectAjax($data);
?>
	<option value="">Pilih Prodi</option>

<?php foreach ($result as $prodi) { ?>

	<option value="<?php echo $prodi["id_prodi"]; ?>"><?php echo $prodi["nama_prodi"]; ?></option>
<?php 	}} ?>

?>