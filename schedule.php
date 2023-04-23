<php>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>網頁程式設計與安全實務</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"><span class="glyphicon glyphicon-education"></span> <font face="微軟正黑體">網頁程式設計與安全實務</font></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php"><font face="微軟正黑體">首頁 </font><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
      <li><a href="calendar.php"><font face="微軟正黑體">月曆 </font></a></li>
	  <li><a href="schedule.php"><font face="微軟正黑體">功課表呈現 </font></a></li>
    </ul>
  </div>
  <style>
	body {
		font-family: Arial, sans-serif;
		text-align: center;
	}
	table {
	  margin-left:auto; 
	  margin-right:auto;
	  width: 80%;
	  max-width: 800px;
	  text-align: center;
	  border: none;
	}
	th {
	  border-style:solid;
	  background-color: #FF8C69;
	  text-align: center;
	  font-size:20px;
	  width: 50px;
	  height: 40px;
	}
	td {
	  border-style:solid;
	  border-color: #000000;
	  background-color: #F3F3F3;
	  text-align: center;
	  font-size:16px;
	  width: 50px;
	  height: 70px;
	}
	.button_style {
			background-color: #DC143C; 
			border: none;
			color: white;
			padding: 10px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 12px;
		}
</style>
</nav>
	<?php
	$SchdData=file_get_contents("http://i4010.isrcttu.net:9997/schd_json.php");
	$Restored_Schd = json_decode($SchdData, true);
	
	$schedule = array();
	foreach ($Restored_Schd as $item) {
		$session = $item['Session'];
		$day = $item['Day'];
		$subject = $item['Subject'];
		$room = $item['Room'];
		if (!isset($schedule[$session])) {
			$schedule[$session] = array();
		}
		$schedule[$session][$day] = array('Subject' => $subject, 'Room' => $room);
	}

	echo '<h2 style="text-align:center;">I3B14 功課表</h2>';
	echo '<table style="margin:auto; width:60%; border-collapse:collapse; text-align:center;">';
	echo '<tr>';
	for ($i = 6; $i >= 1; $i--) {
		echo '<th>星期' . $i . '</th>';
	}
	echo '<th></th>';
	echo '</tr>';
	for ($i = 1; $i <= 8; $i++) {
		echo '<tr>';

		for ($j = 6; $j >= 1; $j--) {
			echo '<td>';
			if (isset($schedule[$i][$j])) {
				echo $schedule[$i][$j]['Subject'] . '<br>' . $schedule[$i][$j]['Room'];
			}
			echo '</td>';
		}
		echo '<td>' . $i . '</td>';
		echo '</tr>';
	}
	echo '</table>';
	echo '<h2></h2>';
	?>
	<form method="post" name="inputform" action="index.php">
			<input type="submit" name="refresh" value="返回首頁" class="button_style">
	</form>
  </body>
</html>
