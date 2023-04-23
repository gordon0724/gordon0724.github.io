<?php
require_once ("lunercalendar.php");
$Y = '';
$M = '';
$YN = '';
$MN = '';

//現在時間
$YN = date('Y'); 
$MN = date('n');

//下拉式的顯示
$arrMonth = array('1'=>'Jan', '2'=>'Feb', '3'=>'Mar', '4'=>'Apr', '5'=>'May', '6'=>'Jun',
	              '7'=>'Jul', '8'=>'Aug', '9'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');

$arrYear = array('2013'=>'2013', '2014'=>'2014', '2015'=>'2015', '2016'=>'2016', '2017'=>'2017', '2018'=>'2018', '2019'=>'2019', 
				 '2020'=>'2020', '2021'=>'2021', '2022'=>'2022', '2023'=>'2023', '2024'=>'2024', '2025'=>'2025', '2026'=>'2026', 
				 '2027'=>'2027', '2028'=>'2028', '2029'=>'2029', '2030'=>'2030', '2031'=>'2031', '2032'=>'2032', '2033'=>'2033');
				  
//現在時間
if (!isset($_POST['Y'])){
	$Y = date('Y');
	if (!isset($_POST['M'])){
		$M = date('n');	
	}else{
		$M = $_POST['M'];
	}
}else{
	$Y = $_POST['Y'];
	if (!isset($_POST['M'])){
		$M = date('n');	
	}else{
		$M = $_POST['M'];
	}
}

$FirstDate = 1;

//找最後一天
$LastDate = date('j', mktime(0,0,0,$M+1,0,$Y));
$ShowDate = array();

//初始化
for ($i=0; $i<6; $i++)
    for ($j=0; $j<7; $j++)
	$ShowDate[$i][$j] = '';

$r = 0;

//把日期塞進去
for ($d=1; $d<=$LastDate; $d++) {
    $w = date('w',mktime(0,1,0,$M,$d,$Y));
    $ShowDate[$r][$w] = $d;
    if ($w==6) $r++;
}
$Month = date('F',mktime(0,1,0,$M,1,$Y));

//看陣列大小
$LastRow = 5;
if (empty($ShowDate[$LastRow][0])) $LastRow = 4;
if (empty($ShowDate[$LastRow][0])) $LastRow = 3;
?>

<!DOCTYPE html>
<html>
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
</nav>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title>月曆</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			text-align: center;
		}

		h1, h2 {
			margin-top: 30px;
			margin-bottom: 10px;
			text-align: center;
		}
		form {
			margin-top: 20px;
			margin-bottom: 20px;
			text-align: center;
		}

		table {
			margin: 0 auto;
			border-collapse: collapse;
			width: 80%;
			max-width: 800px;
			text-align: center;
			border: none;
		}
		th {
			background-color: #FF8C69;
			color: white;
			border: none;
		}
		th, td {
		  text-align: center;
		  padding: 15px 8px;
		  font-size:15px;
		  border: none;
		}
		tr:nth-child(even){background-color: #e5e5e5}
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
		.select_style {
			background-color: #FF8C69; 
			border: none;
			color: black;
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
</head>
<body>
<div style="text-align:center;margin-top:20px;font-size:30px;font-weight:bold;">
	<h1>I3B14張少騏</h1>
	<h2>請選擇年份和月份</h2>
</div>
<div style="text-align:center;margin-top:20px;">
	<form method="POST" action="">
		年份：
		<select name="Y"  class="select_style">
		<?php
			for($i = 2013; $i <= 2033; $i++){
				if($Y == $i){
					echo '<option value="'.$i.'" selected>'.$arrYear[$i].'</option>';
				}else{
					echo '<option value="'.$i.'">'.$arrYear[$i].'</option>';
				}
			}
		?>
		</select>
		月份：
		<select name="M" class="select_style">
		<?php
			for($i = 1; $i <= 12; $i++){
				if($M == $i){
					echo '<option value="'.$i.'" selected>'.$i.'</option>';
				}else{
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			}
		?>
		</select>
		<input type="submit" value="顯示月曆" class="button_style" >
	</form> 
</div>

<div style="text-align:center;margin-top:20px;">
<table border="1" align="center">
<tr align="center">
<th width="100">Sun</th>
<th width="100">Mon</th>
<th width="100">Tue</th>
<th width="100">Wed</th>
<th width="100">Thu</th>
<th width="100">Fri</th>
<th width="100">Sat</th>
</tr>
<?php
for ($r=0; $r<=$LastRow; $r++) {
?>
<tr align="center">
<?php
    for($i=0; $i<7; $i++) {
	$Date = $ShowDate[$r][$i];
	$BgColor = '';
	
	//當天的日期
	if (!empty($Date)) {
		$LDay = '';
	    $DayOfMonth = date('Y-m-d', mktime(0,1,0,$M,$Date,$Y));
        $LDay = GetLDay($DayOfMonth);
	    $xDate = date('Ymd', mktime(0,1,0,$M,$Date,$Y));
	    if ($xDate==date('Ymd')) 
	        $BgColor = ' bgcolor="#AAAAEE"';
        $Date .= '<br>' . $LDay;
	}
    if ($i==0) 
	    $Date = '<span style="color:red">' . $Date . '</span>'; 
    if ($i==6) 
	    $Date = '<span style="color:orange">' . $Date . '</span>'; 
?>
  <td <?php echo $BgColor; ?>><?php echo $Date; ?></td>
<?php } ?>
</tr>
<?php } ?>
</table>
</div>

<div style="text-align:center;margin-top:50px;">
	<?php
		if(!empty($result)){
			echo $result.'<br>';
		}
	?>
</div>
	<form method="post" name="inputform" action="index.php">
			<input type="submit" name="refresh" value="返回首頁" class="button_style">
	</form>
</body>
</html>
