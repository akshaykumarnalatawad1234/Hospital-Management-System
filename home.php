<?php
//including the database connection file
include_once("config.php");
$query = new MongoDB\Driver\Query(array('patientid' => '20214'));

// Output of the executeQuery will be object of MongoDB\Driver\Cursor class
$cursor = $client->executeQuery('HMS.Report', $query);
$result = json_decode(json_encode($cursor->toArray(),true));
$result=json_decode(json_encode($result[0]),true);
// Convert cursor to Array and print result
//$result=$cursor->toArray();
//$result=$result[0];
//print_r($result);

// select data in descending order from table/collection "users"
//$result = $db->users->find()->sort(array('_id' => -1));
?>

<html>
<head>	
	<title>Homepage</title>
</head>

<body>
<a href="add.php">Add New Data</a><br/><br/>

	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Name</td>
		<td>Prescription</td>
		<td>Image path</td>
		<td>description</td>
        <td>action</td>
	</tr>
	<?php 	
	
		echo "<tr>";
		echo "<td>".$result['patientid']."</td>";
		echo "<td>".$result['prescription'][0]."</td>";
		echo "<td>".$result['scanimage'][0][0]."</td>";	
        echo "<td>".$result['scanimage'][0][1]."</td>";	
        foreach($result['_id'] as $res)
		echo "<td><a href=\"edit.php?id=$res\">Edit</a> | <a href=\"delete.php?id=$res\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	
	?>
	</table>
</body>
</html>