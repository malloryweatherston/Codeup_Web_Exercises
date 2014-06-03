<?
$heading = ['name', 'address', 'city', 'state', 'zip']; 

$address_book = [
    ['The White House', '1600 Pennsylvania Avenue NW', 'Washington', 'DC', '20500'],
    ['Marvel Comics', 'P.O. Box 1527', 'Long Island City', 'NY', '11101'],
    ['LucasArts', 'P.O. Box 29901', 'San Francisco', 'CA', '94129-0901'],
    ['Mallory Weatherston', '245 E. Nottingham', 'San Antonio', 'TX', '78209'],
    ['David and Norma Laurie', 'Box 229', 'Booker', 'TX', '79005'], 
];

$filename = 'address_book.csv'; 



function write_csv($big_array, $filename) {
		$handle = fopen($filename, 'w');
		foreach($big_array as $fields) {
		fputcsv($handle, $fields); 
		}
		fclose($handle);
}

if(!empty($_POST)) {
	$new_address = [];
	foreach($_POST as $key => $value) {
		$new_address[] = $value; 
	}
}

function storeEntry($entry) {
	var_dump($entry);
	return false; 
}

$is_valid = true; 
if (!empty($_POST)) {
	$is_valid = storeEntry($_POST);
	if($is_valid) {
		$_POST = array();
	}
}


array_push($address_book, $new_address);

write_csv($address_book, $filename); 





?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Address Book</title>
	</head>
	<body>
		<h1>Address Book</h1>
			<table>
     		<tr>
       			<td>Name</td>
       			<td>Address</td>
       			<td>City</td>
       			<td>State</td>
       			<td>Zip</td>

     		</tr>
     <? foreach($address_book as $row) : ?>
     <tr>
       <td><? echo $row[0]; ?></td>
       <td><? echo $row[1]; ?></td>
       <td><? echo $row[2]; ?></td>
       <td><? echo $row[3]; ?></td>
       <td><? echo $row[4]; ?></td>
       <td><?= !empty($row[5]) ? $row[5] : "";?></td> 
     </tr>
     <? endforeach;?>
     
     <? if (!$is_valid): ?>
     	<p>All form inputs are required.</p>
 	<? endif?>
   </table>
		<h2>Add an Entry to the Address Book</h2>

			<form method="POST" action="/address_book.php">
				<p>
					<label for="Add_Name">Name:</label>
					<input id="Add_Name" name="Add_Name" type="text" placeholder="Enter Name Here"> 
				</p>
				<p>
					<label for="Add_Address">Address:</label>
					<input id="Add_Address" name="Add_Address" type="text" placeholder="Enter Address Here"> 
				</p>
				<p>
					<label for="Add_City">City:</label>
					<input id="Add_City" name="Add_City" type="text" placeholder="Enter City Here"> 
				</p>
				<p>
					<label for="Add_State">State:</label>
					<input id="Add_State" name="Add_State" type="text" placeholder="Enter State Here"> 
				</p>
				<p>
					<label for="Add_Zip">Zip:</label>
					<input id="Add_Zip" name="Add_Zip" type="text" placeholder="Enter Zip Here"> 
				</p>
				<p>
					<button type="Submit">Add</button>
				</p>
			</form>
	</body>
</html>