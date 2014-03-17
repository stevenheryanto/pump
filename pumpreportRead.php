<!DOCTYPE html>
<html class="no-js">
<head>
	<script type="text/javascript" src="http://ds.dibiakcom.net/jquery/jquery-latest.js"></script>
	<script src="Chart.js"></script>
	<link type="text/css" rel="stylesheet" media="screen" href="http://ds.dibiakcom.net/reset.css" />
	<link type="text/css" rel="stylesheet" media="screen" href="http://ds.dibiakcom.net/font-awesome.css" />
	<link type="text/css" rel="stylesheet" media="screen" href="style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Pump</title>
</head>
<body>
	<?php
		require_once 'meekrodb.2.1.class.php';
		$emp = $_POST['employee'];
		$shf = $_POST['idshift'];
		$pum = $_POST['idpump'];
		$tan = $_POST['tanggal'];
		$satu = $_POST['satu'];
		$dua = $_POST['dua'];
	?>
	<form action="pumpreportRead.php" method="post">
		<select name="employee">
		<?php
			$listemployee = DB::query("SELECT * FROM employees WHERE company = %i ORDER BY name", 8);
			echo "<option value=0> --- Operator --- </option>";
			foreach ($listemployee as $lemployee) {
				echo "<option value=".$lemployee['id'].">".$lemployee['name']."</option>";
			}
		?>
		</select>
		<select name="idshift">
		<?php
			$listshift = DB::query("SELECT * FROM shift");
			echo "<option value=0> --- Shift --- </option>";
			foreach ($listshift as $lshift) {
				echo "<option value=".$lshift['idshi'].">".$lshift['shname']."</option>";
			}
		?>
		</select>
		<select name="idpump">
		<?php
			$listpompa = DB::query("SELECT * FROM pompa");
			echo "<option value=0> --- Pompa --- </option>";
			foreach ($listpompa as $lpompa) {
				echo "<option value=".$lpompa['idpom'].">".$lpompa['produk']." (".$lpompa['nosel_unit']. " unit)"."</option>";
			}
		?>
		</select>
		<input type="date" name="tanggal">
		<select name="satu">
		<option value=0 <?php if($satu == 0) echo 'selected'?>>Jual Meter</option>
		<option value=1 <?php if($satu == 1) echo 'selected'?>>Total Meter</option>
		<option value=2 <?php if($satu == 2) echo 'selected'?>>Jual Digital</option>
		<option value=3 <?php if($satu == 3) echo 'selected'?>>Total Digital</option>
		<option value=4 <?php if($satu == 4) echo 'selected'?>>Non Tunai</option>
		<option value=5 <?php if($satu == 5) echo 'selected'?>>Jual Non Tunai</option>
		<option value=6 <?php if($satu == 6) echo 'selected'?>>Setoran 1</option>
		<option value=7 <?php if($satu == 7) echo 'selected'?>>Setoran 2</option>
		<option value=8 <?php if($satu == 8) echo 'selected'?>>Lebih</option>
		<option value=9 <?php if($satu == 9) echo 'selected'?>>Kurang</option>
		</select>		
		
		<select name="dua">
		<option value=0 <?php if($dua == 0) echo 'selected'?>>Jual Meter</option>
		<option value=1 <?php if($dua == 1) echo 'selected'?>>Total Meter</option>
		<option value=2 <?php if($dua == 2) echo 'selected'?>>Jual Digital</option>
		<option value=3 <?php if($dua == 3) echo 'selected'?>>Total Digital</option>
		<option value=4 <?php if($dua == 4) echo 'selected'?>>Non Tunai</option>
		<option value=5 <?php if($dua == 5) echo 'selected'?>>Jual Non Tunai</option>
		<option value=6 <?php if($dua == 6) echo 'selected'?>>Setoran 1</option>
		<option value=7 <?php if($dua == 7) echo 'selected'?>>Setoran 2</option>
		<option value=8 <?php if($dua == 8) echo 'selected'?>>Lebih</option>
		<option value=9 <?php if($dua == 9) echo 'selected'?>>Kurang</option>
		</select>
		<input class="button" name="submit" type="submit" value="Submit">
	</form>
		
	<?php
			//per hari & shift
		//kinerja: per orang & bulan
		$where = new WhereClause('and');
		if ($emp != 0){
			$where->add('employee=%i', $emp);
		}
		if ($shf != 0){
			$where->add('idshift=%i', $shf);
		}
		if ($pum != 0){
			$where->add('idpump=%i', $pum);
		}
		if ($tan != null){
			//$where->add('DAY(tanggal)=%s', substr($tan,8,2));
			//$where->add('MONTH(tanggal)=%s', substr($tan,5,2));
			//$where->add('YEAR(tanggal)=%s', substr($tan,0,4));
			$where->add('tanggal=%s', $tan);
		}
		$where->add('laporan.idshift = shift.idshi');
		$where->add('laporan.idpump = pompa.idpom');
		$where->add('laporan.employee = employees.id');	
		$results = DB::query("SELECT * FROM laporan, employees, shift, pompa WHERE %l ORDER BY tanggal DESC LIMIT 30", $where);
		echo "<ul id='fl_table' class='luas'>";
		$jm = 0;
		$tm = 0;
		$jd = 0;
		$td = 0;
		$nt = 0;
		$jn = 0;
		$s1 = 0;
		$s2 = 0;
		$le = 0;
		$ku = 0;
		echo "<li>".
			"<div>Tanggal</div>".
			"<div class='hi'>Operator</div>".
			"<div class='lo'>Shift</div>".
			"<div class='lo'>Pompa</div>".
			"<div class='lo'>Nosel A</div>".
			"<div class='lo'>Nosel B</div>".
			"<div>Jual Meter</div>".
			"<div>Total Meter</div>".
			"<div>Jual Digital</div>".
			"<div>Total Digital</div>".
			"<div>Non Tunai</div>".
			"<div>Jual Non Tunai</div>".
			"<div>Setoran1</div>".
			"<div>Setoran 2</div>".
			"<div>Lebih</div>".
			"<div>Kurang</div>";
		echo "</li>";
		foreach ($results as $row){				
			echo "<li>".
			"<div> <a href='pumpreportUpdate.php?id=".$row['idlap']."'>". $row['tanggal'] ."</div>".
			"<div class='hi'>". $row['name'] ."</div>".
			"<div class='lo'>". $row['shname'] ."</div>".
			"<div class='lo'>". $row['produk'] ."</div>".
			"<div class='lo'>". $row['nosela'] ."</div>".
			"<div class='lo'>". $row['noselb'] ."</div>".
			"<div>". $row['jmeter'] ."</div>".
			"<div>". $row['tmeter'] ."</div>".
			"<div>". $row['jdigital'] ."</div>".
			"<div>". $row['tdigital'] ."</div>".
			"<div>". $row['nontunai'] ."</div>".
			"<div>". $row['jnontunai'] ."</div>".
			"<div>". $row['setoran1'] ."</div>".
			"<div>". $row['setoran2'] ."</div>".
			"<div>". $row['lebih'] ."</div>".
			"<div>". $row['kurang'] ."</a></div>";
			echo "</li>";
			$jm += $row['jmeter'];
			$tm += $row['tmeter'];
			$jd += $row['jdigital'];
			$td += $row['tdigital'];
			$nt += $row['nontunai'];
			$jn += $row['jnontunai'];
			$s1 += $row['setoran1'];
			$s2 += $row['setoran2'];
			$le += $row['lebih'];
			$ku += $row['kurang'];			
		}
		echo "<br><li>".
		"<div>Total: </div>".
		"<div class='hi'>&nbsp; </div>".
		"<div class='lo'>&nbsp; </div>".
		"<div class='lo'>&nbsp; </div>".
		"<div class='lo'>&nbsp; </div>".
		"<div class='lo'>&nbsp; </div>".
		"<div>". $jm ."</div>".
		"<div>". $tm ."</div>".
		"<div>". $jd ."</div>".
		"<div>". $td ."</div>".
		"<div>". $nt ."</div>".
		"<div>". $jn ."</div>".
		"<div>". $s1 ."</div>".
		"<div>". $s2 ."</div>".
		"<div>". $le ."</div>".
		"<div>". $ku ."</div>".
		"<li>";
		echo "</ul>";
		$counter = DB::count();
		//echo "<br><br>counter: ".$counter;
	?>
	<li id="bottom">
	<a href=pumpreportCreate.php><i class="icon-plus-sign icon-4x"></i></a>	
	<a href=pumpreportShift.php><i class="icon-time icon-4x"></i></a>	
	<a href=pumpreportOperator.php><i class="icon-user icon-4x"></i></a>	
	</li>
	<br>
	<canvas id="myChart" width="1200" height="400"></canvas>
	<script>
		<?php 
		echo "var myData = [";
		foreach ($results as $row){
			switch($satu){
			case 0:
				$sa = 'jmeter';
				break;
			case 1:
				$sa = 'tmeter';
				break;
			case 2:
				$sa = 'jdigital';
				break;
			case 3:
				$sa = 'tdigital';
				break;
			case 4:
				$sa = 'nontunai';
				break;
			case 5:
				$sa = 'jnontunai';
				break;
			case 6:
				$sa = 'setoran1';
				break;
			case 7:
				$sa = 'setoran2';
				break;
			case 8:
				$sa = 'lebih';
				break;
			case 9:
				$sa = 'kurang';
				break;
			};		
			switch($dua){
			case 0:
				$du = 'jmeter';
				break;
			case 1:
				$du = 'tmeter';
				break;
			case 2:
				$du = 'jdigital';
				break;
			case 3:
				$du = 'tdigital';
				break;
			case 4:
				$du = 'nontunai';
				break;
			case 5:
				$du = 'jnontunai';
				break;
			case 6:
				$du = 'setoran1';
				break;
			case 7:
				$du = 'setoran2';
				break;
			case 8:
				$du = 'lebih';
				break;
			case 9:
				$du = 'kurang';
				break;
			};
			echo "{ 0: "."'". $row['tanggal'] ."'".", 1: ". $row[$sa].", 3: ". $row['jmeter'].", 2: ". $row[$du]." },";
			//$row = 0;
		}
		echo "];";
		?>

		Array.prototype.mapProperty = function(property) {
			return this.map(function (obj) {
				return obj[property];
			});
		};
		
		var lineChartData = {
			labels : myData.mapProperty(0),
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : myData.mapProperty(1)
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : myData.mapProperty(2)
				}
			]
		}
		var myLine = new Chart(document.getElementById("myChart").getContext("2d")).Line(lineChartData);
	</script>
	
</body>
</html>
