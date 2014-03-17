<!DOCTYPE html>
<html class="no-js">
<head>
	<script type="text/javascript" src="http://ds.dibiakcom.net/jquery/jquery-latest.js"></script>
	<link type="text/css" rel="stylesheet" media="screen" href="http://ds.dibiakcom.net/reset.css" />
	<link type="text/css" rel="stylesheet" media="screen" href="http://ds.dibiakcom.net/font-awesome.css" />
	<link type="text/css" rel="stylesheet" media="screen" href="style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Attendance</title>
	<script type="text/javascript">
		function allowDrop(ev)
		{
		ev.preventDefault();
		}

		function drag(ev)
		{
		ev.dataTransfer.effectAllowed='move';
		ev.dataTransfer.setData("Text",ev.target.id);
		}

		function drop(ev)
		{
			ev.preventDefault();
			var id=ev.dataTransfer.getData("Text");
			ev.target.appendChild(document.getElementById(id));
			
			$url = "attendance/attendanceDelete.php";
			
			$.ajax({
				type: "POST",
				url: "attendanceDelete.php",
				data: {"id": id},
				dataType: "text",
				success:function(data) {
					if(data) {
						alert("Employee has been deleted");
					} else {
						alert("Delete fail, please try again");
					}}
			});	
			/*
			$.get('attendance/attendanceDelete.php?id='+data, function(data) {
				alert("Success: " + data);
			});
						
			$.post($url, { id: data }, function(data) {
				alert("Masuk");
				alert("Success: " + data);
			});
			*/
		}
	</script>
</head>
<body>

	<?php
		$timezone = date_default_timezone_set('Asia/Tokyo');
		
		require_once 'meekrodb.2.1.class.php';
		$results = DB::query("SELECT id, name, coname, firstday, holiday, lastholiday, fromlh, tolh FROM employees, companies WHERE employees.company = companies.cocode AND employees.company=%i", 8);
		echo "<ul id='fl_table'>";
		foreach ($results as $row){
		

			
			echo "<li class='drag' draggable='true' id=".$row['id']." ondragstart=drag(event)>".
			"<div class=hi>" . $row['coname'] . "</div>".
			"<div class=hi><a href=attendanceUpdate.php?id=".$row['id'].">" . $row['name'] . "</a></div>".
			"<div class=hi>" . $row['firstday']  . "</div>";				

			echo "</div></li>";
		} 
		echo "</ul>";
		
	?>
	<li id="bottom">
	<img src="pictures/cart.png" ondrop="drop(event)" ondragover="allowDrop(event)">
	<a href=attendanceCreate.php><img src="pictures/add_user.png"></a>
	</li>
	<!--div id="drop" ondrop="drop(event)" ondragover="allowDrop(event)"></div-->

</body>
</html>
