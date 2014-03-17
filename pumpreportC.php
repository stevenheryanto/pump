<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="0;url=pumpreportCreate.php" />
	<title>Pump</title>
</head>
<body> 
<?php
	require_once 'meekrodb.2.1.class.php';	
	$employee = $_POST['employee'];
	$idshift = $_POST['idshift'];	
	$idpump = $_POST['idpump'];
	echo "-". $idpump ."-";
	$price = $_POST['price'];
	$tanggal = $_POST['tanggal'];
	
	$nosela = $_POST['nosela'];	
	$mawala = $_POST['mawala'];	
	$dawala = $_POST['dawala'];	
	$makhira = $_POST['makhira'];	
	$dakhira = $_POST['dakhira'];	
	$mkeluara = $_POST['mkeluara'];
	$dkeluara = $_POST['dkeluara'];
	$mjuala = $_POST['mjuala'];
	$djuala = $_POST['djuala'];
	
	$noselb = $_POST['noselb'];	
	$mawalb = $_POST['mawalb'];	
	$dawalb = $_POST['dawalb'];	
	$makhirb = $_POST['makhirb'];	
	$dakhirb = $_POST['dakhirb'];	
	$mkeluarb = $_POST['mkeluarb'];
	$dkeluarb = $_POST['dkeluarb'];
	$mjualb = $_POST['mjualb'];
	$djualb = $_POST['djualb'];
	
	$jmeter = $_POST['jmeter'];
	$tmeter = $_POST['tmeter'];
	$jdigital = $_POST['jdigital'];
	$tdigital = $_POST['tdigital'];
	$nontunai = $_POST['nontunai'];
	$setoran1 = $_POST['setoran1'];
	$setoran2 = $_POST['setoran2'];
	
	$liternont = $_POST['liternont'];
	$sisakas = $_POST['sisakas'];
	$tjual = $_POST['tjual'];
	$jnontunai = $_POST['jnontunai'];
	$saldokas = $_POST['saldokas'];
	$lebih = $_POST['lebih'];
	$kurang = $_POST['kurang'];
	
	
	DB::insert('laporan', array(
		'employee' => $employee,
		'idshift' => $idshift,
		'idpump' => $idpump,
		'price' => $price,
		'tanggal' => $tanggal,
		
		'nosela' => $nosela,
		'mawala' => $mawala,
		'dawala' => $dawala,
		'makhira' => $makhira,
		'dakhira' => $dakhira,
		'mkeluara' => $mkeluara,
		'dkeluara' => $dkeluara,
		'mjuala' => $mjuala,
		'djuala' => $djuala,
		
		'noselb' => $noselb,
		'mawalb' => $mawalb,
		'dawalb' => $dawalb,
		'makhirb' => $makhirb,
		'dakhirb' => $dakhirb,
		'mkeluarb' => $mkeluarb,
		'dkeluarb' => $dkeluarb,
		'mjualb' => $mjualb,
		'djualb' => $djualb,
		
		'jmeter' => $jmeter,
		'tmeter' => $tmeter,
		'jdigital' => $jdigital,
		'tdigital' => $tdigital,
		'nontunai' => $nontunai,
		'setoran1' => $setoran1,
		'setoran2' => $setoran2,
		
		'liternont' => $liternont,
		'sisakas' => $sisakas,
		'tjual' => $tjual,
		'jnontunai' => $jnontunai,
		'saldokas' => $saldokas,
		'lebih' => $lebih,
		'kurang' => $kurang,
	));
?>

</body>
</html>