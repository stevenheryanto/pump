<!DOCTYPE html>
<html class="no-js">
<head>
	<script type="text/javascript" src="http://ds.dibiakcom.net/jquery/jquery-latest.js"></script>
	<link type="text/css" rel="stylesheet" media="screen" href="http://ds.dibiakcom.net/reset.css" />
	<link type="text/css" rel="stylesheet" media="screen" href="http://ds.dibiakcom.net/font-awesome.css" />
	<link type="text/css" rel="stylesheet" media="screen" href="style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Pump</title>
	<style>
		#vlow {width: 30px;}
		#low {width: 70px;}     
	</style>
	<script type="text/javascript">
		function calc() {
		
		var price = document.myForm.price.value;
		
		var mawala = document.myForm.mawala.value;
		var makhira = document.myForm.makhira.value;
		var mkeluara = document.myForm.mkeluara.value;
		var mjuala = document.myForm.mjuala.value;
		
		var dawala = document.myForm.dawala.value;
		var dakhira = document.myForm.dakhira.value;
		var dkeluara = document.myForm.dkeluara.value;
		var djuala = document.myForm.djuala.value;
		
		var mawalb = document.myForm.mawalb.value;
		var makhirb = document.myForm.makhirb.value;
		var mkeluarb = document.myForm.mkeluarb.value;
		var mjualb = document.myForm.mjualb.value;
		
		var dawalb = document.myForm.dawalb.value;
		var dakhirb = document.myForm.dakhirb.value;
		var dkeluarb = document.myForm.dkeluarb.value;
		var djualb = document.myForm.djualb.value;
		
		var jmeter = document.myForm.jmeter.value;
		var jdigital = document.myForm.jdigital.value;
		var tmeter = document.myForm.tmeter.value;
		var tdigital = document.myForm.tdigital.value;
		
		mkeluara = makhira - mawala;
		document.myForm.mkeluara.value =  round(mkeluara);
		mjuala = mkeluara * price;
		document.myForm.mjuala.value = round(mjuala);
		
		dkeluara = dakhira - dawala;
		document.myForm.dkeluara.value = round(dkeluara);
		djuala = dkeluara * price;
		document.myForm.djuala.value = round(djuala);
		
		mkeluarb = makhirb - mawalb;
		document.myForm.mkeluarb.value =  round(mkeluarb);
		mjualb = mkeluarb * price;
		document.myForm.mjualb.value = round(mjualb);
		
		dkeluarb = dakhirb - dawalb;
		document.myForm.dkeluarb.value = round(dkeluarb);
		djualb = dkeluarb * price;
		document.myForm.djualb.value = round(djualb);

		jmeter = mkeluara + mkeluarb;
		document.myForm.jmeter.value = round(jmeter);
		jdigital = dkeluara + dkeluarb;
		document.myForm.jdigital.value = round(jdigital);

		tmeter = jmeter * price;
		document.myForm.tmeter.value = round(tmeter);
		tdigital = jdigital * price;
		document.myForm.tdigital.value = round(tdigital);
		
		var nontunai = document.myForm.nontunai.value; 
		var jnontunai = document.myForm.jnontunai.value; 
		var sisakas = document.myForm.sisakas.value;
		var tjual = document.myForm.tjual.value; 
		var saldokas = document.myForm.saldokas.value; 

		document.myForm.liternont.value = nontunai;
		jnontunai = nontunai * price;
		document.myForm.jnontunai.value = round(jnontunai);
		document.myForm.tjual.value = document.myForm.tdigital.value;
		saldokas = tjual - jnontunai;
		document.myForm.saldokas.value = saldokas;
		
		var setoran1 = document.myForm.setoran1.value;
		document.myForm.sisakas.value = saldokas - setoran1;
		var setoran2 = document.myForm.setoran2.value;
		var lekur = setoran2 - sisakas;
		if (lekur > 0){
			document.myForm.lebih.value = lekur;
			document.myForm.kurang.value = 0;
		} else {
			document.myForm.kurang.value = lekur * (-1);
			document.myForm.lebih.value = 0;		
		}
		}

		function round(acak){
			var temp = new Number(acak+'').toFixed(parseInt(3));
			return parseFloat(temp);
		}
		
		function validate(){
			var idpump = document.myForm.idpump.value;
			var nosela = document.myForm.nosela.value;
			var noselb = document.myForm.noselb.value;
			if(nosela == noselb){
				alert("Nomor nosel harus beda");
				return false;
			}
			if(idpump != 1 ){
				if (nosela == 3 || nosela == 4){
					alert("Pompa " +idpump+ " tidak punya nosel nomor " +nosela);
					return false;
				}
				if (noselb == 3 || noselb == 4){
					alert("Pompa " +idpump+ " tidak punya nosel nomor " +noselb);
					return false;
				}
			}
		}
	</script>
</head>
<body>
	<form name="myForm" action="pumpreportC.php" method="post" onsubmit="return validate()">
		<label>Operator: </label>
		<select name="employee">
		<?php
			require_once 'meekrodb.2.1.class.php';
			$listemployee = DB::query("SELECT * FROM employees WHERE company = %i ORDER BY name", 8);
			foreach ($listemployee as $lemployee) {
				echo "<option value=".$lemployee['id'].">".$lemployee['name']."</option>";
			}
		?>
		</select>
		<label>Shift: </label> 
		<select name="idshift">
		<?php
			$listshift = DB::query("SELECT * FROM shift");
			foreach ($listshift as $lshift) {
				echo "<option value=".$lshift['idshi'].">".$lshift['shname']."</option>";
			}
		?>
		</select>
		<br>
		<label>Pompa: </label>
		<select name="idpump">
		<?php
			$listpompa = DB::query("SELECT * FROM pompa");
			foreach ($listpompa as $lpompa) {
				echo "<option value=".$lpompa['idpom'].">".$lpompa['produk']." (".$lpompa['nosel_unit']. " unit)"."</option>";
			}
		?>
		</select>
		<label>Harga: </label> 
		<input id="low" type="number" name="price" onclick="calc()" onkeyup="calc()" min=5500 step=100 max=15000 required>
		<br>
		<label>Tanggal: </label> 
		<input type="date" name="tanggal" required>
		<br><br>
		<label>Nosel A: </label> 
		<input id="vlow" type="number" name="nosela" min=1 max=4 required>
		<br>
		<label>Meter Awal: </label> 
		<input type="number" name="mawala" onclick="calc()" onkeyup="calc()" min=0.000 step=0.001  max=999999999.999 required>
		<label>Digital Awal: </label>
		<input type="number" name="dawala" onclick="calc()" onkeyup="calc()" min=0.000 step=0.001 max=999999999.999 required>
		<br>
		<label>Meter Akhir: </label> 
		<input type="number" name="makhira" onclick="calc()" onkeyup="calc()" min=0.000 step=0.001 max=999999999.999 required>
		<label>Digital Akhir: </label>
		<input type="number" name="dakhira" onclick="calc()" onkeyup="calc()" min=0.000 step=0.001 max=999999999.999 required>
		<br>
		<label>Meter Keluar: </label> 
		<input type="text" name="mkeluara" readonly>
		<label>Selisih Digital: </label>
		<input type="text" name="dkeluara" readonly>
		<br>
		<label>Meter Jual: </label> 
		<input type="text" name="mjuala" readonly>
		<label>Digital Jual: </label>
		<input type="text" name="djuala" readonly>
		<br><br>
		<label>Nosel B: </label> 
		<input id="vlow" type="number" name="noselb" min=0 max=4>
		<br>
		<label>Meter Awal: </label> 
		<input type="number" name="mawalb" onclick="calc()" onkeyup="calc()" min=0.000 step=0.001 max=999999999.999>
		<label>Digital Awal: </label>
		<input type="number" name="dawalb" onclick="calc()" onkeyup="calc()" min=0.000 step=0.001 max=999999999.999>
		<br>
		<label>Meter Akhir: </label> 
		<input type="number" name="makhirb" onclick="calc()" onkeyup="calc()" min=0.000 step=0.001 max=999999999.999>
		<label>Digital Akhir: </label>
		<input type="number" name="dakhirb" onclick="calc()" onkeyup="calc()" min=0.000 step=0.001 max=999999999.999>
		<br>
		<label>Meter Keluar: </label> 
		<input type="text" name="mkeluarb" readonly>
		<label>Selisih Digital: </label>
		<input type="text" name="dkeluarb" readonly>
		<br>
		<label>Meter Jual: </label> 
		<input type="text" name="mjualb" readonly>
		<label>Digital Jual: </label>
		<input type="text" name="djualb" readonly>
		<br>
		<br>
		<label>Jumlah Meter: </label> 
		<input type="text" name="jmeter" readonly>
		<label>Jumlah Digital: </label>
		<input type="text" name="jdigital" readonly>
		<br>
		<label>Total Meter: </label> 
		<input type="text" name="tmeter" readonly>
		<label>Total Digital: </label>
		<input type="text" name="tdigital" readonly>
		<br>
		<br>
		<label>Non Tunai: </label> 
		<input type="number" name="nontunai" onclick="calc()" onkeyup="calc()" min=0 step=0.001 max=999999.999>
		<label>Setoran 1: </label> 
		<input type="number" name="setoran1" onclick="calc()" onkeyup="calc()" min=0 step=1 max=999999999 required>
		<br>
		<label>Liter Non Tunai: </label>
		<input type="text" name="liternont" readonly>
		<label>Sisa Kas: </label> 
		<input type="text" name="sisakas" readonly>
		<br>
		<label>Total Penjualan: </label>
		<input type="text" name="tjual" readonly>
		<label>Setoran 2: </label> 
		<input type="number" name="setoran2" onclick="calc()" onkeyup="calc()" min=0 step=1 max=999999999>
		<br>
		<label>Jual Non Tunai: </label>
		<input type="text" name="jnontunai" readonly>
		<label>Lebih: </label> 
		<input type="text" name="lebih" readonly>
		<br>
		<label>Saldo Kas: </label>
		<input type="text" name="saldokas" readonly>
		<label>Kurang: </label> 
		<input type="text" name="kurang" readonly>
		<label>&nbsp; </label>
		<input class="button" name="submit" type="submit" value="Submit">
		<br>
		</form>

	<li id="bottom">
	<a href=pumpreportShift.php><i class="icon-time icon-4x"></i></a>	
	<a href=pumpreportOperator.php><i class="icon-user icon-4x"></i></a>	
	<a href=pumpreportRead.php><i class="icon-list icon-4x"></i></a>
	</li>

</body>
</html>