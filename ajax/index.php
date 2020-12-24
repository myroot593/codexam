
<?php

require_once ('db.php');

$obj = new main;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Menyederhanakan Input</title>

	<link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

</head>
<body>
	<script type="text/javascript">
		function getprodi(){
			var str='';
			var val=document.getElementById('list-fakultas');
			for(i=0; i<val.length; i++){
				if(val[i].selected){
					str += val[i].value + ',';
				}
			}
			var str=str.slice(0, str.length -1);
			$.ajax({
				type:"GET",
				url:"ajax_get_prodi.php",
				data:'id_fakultas='+str,
				success:function(data){
					$("#list-prodi").html(data);
				}
			});
		}
	</script>
	<div class="container">
		<div class="card shadow mb-4 mt-4">
	            <div class="card-header py-3">
	                <h6 class="m-0 font-weight-bold text-primary">Tutotrial PHP : Menampilkan Option Lain Saat Salah Satu Option Dipilih - ROOT93.CO.ID</h6>
	            </div>
	        <div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<select class="form-control" name="fakultas" id="list-fakultas" onChange="getprodi();">
							<option value="">Pilih fakultas</option>
								<?php
									$fakultas=$obj->listFakultas();
									while($row=$fakultas->fetch_array()){
										echo'
											<option value="'.$row['id_fakultas'].'">
												'.$row['nama_fakultas'].'
											</option>
										';

									}
									$fakultas->free_result();
									
								?>
						</select>
					</div>
					<div class="col-md-6">
						<select class="form-control" name="prodi" id="list-prodi" size="5">
							
								
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="../assets/jquery/jquery.min.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
