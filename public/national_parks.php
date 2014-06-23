<?php
// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'mallory', 'malmal');

//Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function getParks($dbc) {
    // Bring the $dbc variable into scope somehow

    return $dbc->query('SELECT * FROM national_parks')->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>National Parks</title>
	</head>
		<body>
			<table>
				<table border='1'>
     		<tr>
       			<td>ID</td>
       			<td>Name</td>
       			<td>Location</td>
       			<td>Date Established</td>
       			<td>Area in Acres</td>

     		</tr>
			 		
       <? foreach (getParks($dbc) as $row) : ?>
                <tr>
                    <? foreach($row as $park): ?>
                        <td><?= htmlspecialchars(strip_tags($park));?></td>
                    <? endforeach; ?>
                </tr>
      		 <? endforeach; ?>
			</table>
		</body>
</html> 