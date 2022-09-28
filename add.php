<html>
<head>
    <title>Add Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br/><br/>

    <form action="add.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Patient Id</td>
                <td><input type="text" name="ID"></td>
            </tr>
            <tr> 
                <td>Prescription</td>
                <td><input type="text" name="Prescription"></td>
            </tr>
            <tr> 
                <td>Image</td>
                <td><input type="text" name="image"></td>
            </tr>
            <tr> 
                <td>description</td>
                <td><input type="text" name="desc"></td>
            </tr>
            <tr> 
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
    <?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {	
    $user=new MongoDB\Driver\BulkWrite;
	$user->insert(array (
				'patientid' => $_POST['ID'],
				'prescription' =>array($_POST['Prescription']) ,
				'scanimage' => array(array($_POST['image'],$_POST['desc']))
    ));
		
	// checking empty fields
	$errorMessage = '';
	foreach ($user as $key => $value) {
		if (empty($value)) {
			$errorMessage .= $key . ' field is empty<br />';
		}
	}
	
	if ($errorMessage) {
		// print error message & link to the previous page
		echo '<span style="color:red">'.$errorMessage.'</span>';
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";	
	} else {
		//insert data to database table/collection named 'users'
		//$db->Report->insert($user);
        $client->executeBulkWrite('HMS.Report', $user);
        
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		// echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>