<?
// include Conversation class file
require_once('classes/address_data_store.php');

$ads = new AddressDataStore('address_book.csv');



$heading = ['name', 'address', 'city', 'state', 'zip']; 

$address_book = [];


//$ads->filename = ; 
//$address_book = read_csv($filename);
$address_book = $ads->read_address_book();



$new_address = [];
if (!empty($_POST['Add_Name']) && !empty($_POST['Add_Address']) && !empty($_POST['Add_City']) && !empty($_POST['Add_State']) && !empty($_POST['Add_Zip'])) {

  	$new_address['Add_Name'] = $_POST['Add_Name'];
    $new_address['Add_Address'] = $_POST['Add_Address'];
    $new_address['Add_City'] = $_POST['Add_City'];
    $new_address['Add_State'] = $_POST['Add_State'];
    $new_address['Add_Zip'] = $_POST['Add_Zip'];

    array_push($address_book, $new_address);
    $ads->write_address_book($address_book);
	//write_csv($address_book, $filename); 
} else {
	foreach ($_POST as $key => $value) {
        if (empty($value)) {
            echo "<h1>" . ucfirst($key) .  " is empty.</h1>";
    	}
    }
}





if (isset($_GET['removeIndex'])) {
	$removeIndex = $_GET['removeIndex'];
	unset($address_book[$removeIndex]);
	$ads->write_address_book($address_book); 
}

// Verify there were uploaded files and no errors
if (count($_FILES) > 0 && $_FILES['file1']['error'] == 0) {
	if($_FILES['file1']['type'] == 'text/csv') {
    // Set the destination directory for uploads
    $upload_dir = '/vagrant/sites/codeup.dev/public/uploads/';
    // Grab the filename from the uploaded file by using basename
    $uploaded_filename = basename($_FILES['file1']['name']);
    // Create the saved filename using the file's original name and our upload directory
    $saved_filename = $upload_dir . $uploaded_filename;
    // Move the file from the temp location to our uploads directory
    move_uploaded_file($_FILES['file1']['tmp_name'], $saved_filename);
	//Open/Upload a new file
	$upf = new AddressDataStore($saved_filename);
	$addresses_uploaded = $upf->read_address_book(); 
	//Merge original array with new uploaded files
	$address_book = array_merge($address_book, $addresses_uploaded);
	$ads->write_address_book($address_book); 

	//Error echoed if file type is not "text/plain"
	}else {
		$error_message = "ERROR: File Type Must be text/csv." .PHP_EOL;
	}
	
}


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Address Book</title>
	</head>
	<body>
		<h1>Address Book</h1>
			<table border='1'>
     		<tr>
       			<td>Name</td>
       			<td>Address</td>
       			<td>City</td>
       			<td>State</td>
       			<td>Zip</td>

     		</tr>
       <? foreach ($address_book as $key => $fields) : ?>
                <tr>
                    <? foreach ($fields as $value): ?>
                        <td><?= htmlspecialchars(strip_tags($value));?></td>
                    <? endforeach; ?>
                    	<td><?="<a href=\"address_book.php?removeIndex={$key}\"> Delete Contact</a>";?></td>
                </tr>
       <? endforeach; ?>
     
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
		<h2>Upload File</h2>

			<form method="POST" enctype="multipart/form-data" action="/address_book.php">
    			<p>
        			<label for="file1">File to upload: </label>
        			<input type="file" id="file1" name="file1">
    			</p>
   				<p>
        			<input type="submit" value="Upload">
        		</p>
			</form>
	</body>
</html>