<?php
//phpinfo();

//echo extension_loaded("mongodb") ? "loaded\n" : "not loaded\n";
$client = new  MongoDB\Driver\Manager( 'mongodb+srv://adarshrh:adarshrh@adarsh.jj0qy.mongodb.net/HMS?retryWrites=true&w=majority');
//echo $client;
//$db = $client.Report;
// $query = new MongoDB\Driver\Query(array('patientid' => '20214'));

// // Output of the executeQuery will be object of MongoDB\Driver\Cursor class
// $cursor = $client->executeQuery('HMS.Report', $query);

// // Convert cursor to Array and print result
// print_r($cursor->toArray());

?>