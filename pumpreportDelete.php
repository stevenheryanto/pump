<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<?php 
		require_once 'meekrodb.2.1.class.php';
		$id = $_POST['id'];
		DB::delete('laporan', "idlap=%s", $id);
	?>
</body>
</html>
