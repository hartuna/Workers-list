<?php
include_once './functions.php';
include_once './connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lista pracowników</title>
	<meta charset="utf-8" />
	<link href="style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<div class="container">
	<?php
	$connect = mysqli_connect($dbServer, $dbUser, $dbPassword, $dbName);
	$connect->query('set names "utf-8" collate "utf8_polish_ci"');
	$query = 'SELECT name, surname, agreement, experience, salaryBase, workTimePerDay FROM workers_WorkersList';
	$result = $connect->query($query);
	while($row = $result->fetch_assoc()){
		$worker = new Worker($row['name'], $row['surname'], $row['experience']);
		$agreement = new Agreement($row['agreement'], $row['salaryBase'], $row['workTimePerDay']);
		$bonus = $worker->experienceBonus();
		$salary = $agreement->salary();
		$contributions = $agreement->contributions();
	?>
	<div class="worker">
		<div class="left">
			<p>Imię: <?php echo $row['name']; ?></p>
			<p>Nazwisko: <?php echo $row['surname']; ?></p>
			<p>Rodzaj umowy: <?php echo $row['agreement']; ?></p>
			<p>Godzin dziennie: <?php echo $row['workTimePerDay']; ?></p>
		</div>
		<div class="right">
			<p>Premia za doświadczenie: <?php echo $bonus; ?></p>
			<p>Kwota bazowa: <?php echo $row['salaryBase']; ?></p>
			<p>Składki: <?php echo $salary * $contributions; ?></p>
			<p>Kwota wypłaty (podstawa, etat, premia, składki): <?php echo ($salary + ($salary * $bonus)) - ($salary * $contributions); ?></p>
		</div>
		<div class="clear"></div>
	</div>
	<?php
	}
	$connect->close();
	?>
	</div>
</body>
</html>