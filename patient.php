<!DOCTYPE html>
<html lang="en kn">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset = "UTF-8" />
        <link rel = "icon" href = "images/logo3.png" type = "Images/png">
        <title>HMS</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
    <body >
        <h1> WELCOME TO HOSPITAL MANAGEMENT SYSTEM</h1>
        <h2>Manage all data at one place</h2>
        <h2 style="font-style: italic;color: rgb(240, 149, 13);">Welcome user</h2>
        <h3 style="font-style: italic;color: rgb(240, 149, 13);">let's view and Download your data</h3>
        <div id="patient_option">
            <div class="patient_option">
             <button id="view_report">View report</button>
             <button id="download_report" onclick="tableToCSV()">Download Report</button>
            </div>
 
             <div id="show_data">
             <div id="basic">
                    <h3> Basic details</h3>
                    <table>
                            <?php

                                
                include "connection.php"; // Using database connection file here
                // echo"<script type=\"text/javascript\">
                // $(document).ready( function() {
                // var DrID = localStorage.getItem('doctorID');
                // $_POST('', {'doctorID':DrID});}

                // </script>";
                session_start();
                print_r($_SESSION) ;
                //echo $_SESSION['PatientID'];
                $PatientID=(int)$_SESSION['PatientID'];
                // $doctorID = "<script type=\"text/javascript\">document.write(localStorage.getItem('doctorID'))</script>";
                // // echo $doctorID;

                $sql = "SELECT `patient_Id`, `P_Name`, concat( city,',' ,state,',', country,',',Pin_code) AS Address , `DOB`, `bloodgroup`,`phone_No` FROM `patient` WHERE patient_Id=$PatientID;";

                $result = mysqli_query($conn, $sql);

                while($data = mysqli_fetch_array($result))
                {
                ?>
                <tr>
                    <td>Patient Id</td>
                    <td><?php echo $data['patient_Id']; ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo $data['P_Name']; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $data['Address']; ?></td>
                </tr>	
                <tr>
                    <td>Date of birth</td>
                    <td><?php echo $data['DOB']; ?></td>
                </tr>
                <tr>
                    <td>bloodgroup</td>
                    <td><?php echo $data['bloodgroup']; ?></td>
                </tr>
                <tr>
                    <td>phone_No</td>
                    <td><?php echo $data['phone_No']; ?></td>
                </tr>		
                <?php
                }
                ?>
                </table>
                </div>
                <br>
                <br>
                <div id="allergy">
                <h3> Allergies</h3>
                <table>
                <tr>
                    <th>Allergies</th>
                
                </tr>
                                
                <?php
                $sql = "SELECT `allergy` FROM `patient_allergy` WHERE patient_patient_Id=$PatientID;";
                $result = mysqli_query($conn, $sql);

                while($data = mysqli_fetch_array($result))
                {
                ?>
                <tr>
                    <td><?php echo $data['allergy']; ?></td>
                
                </tr>	
                <?php
                }
                ?>
                </table>

                </div>
                </div>
                    <?php
//including the database connection file
include_once("config.php");
$query = new MongoDB\Driver\Query(array('patientid' =>(string) $PatientID));

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
        <div>
            <br>
            <br>
        <table width='80%' border=0>

<tr bgcolor='#CCCCCC'>
    <td>ID</td>
    <td>Prescription</td>
    <td>Image path</td>
    <td>description</td>
    <!-- <td>action</td> -->
</tr>
<?php 	
    if($result['patientid']!=null){
    echo "<tr>";
    echo "<td>".$result['patientid']."</td>";
    echo "<td>".$result['prescription'][0]."</td>";
    echo "<td>".$result['scanimage'][0][0]."</td>";	
    echo "<td>".$result['scanimage'][0][1]."</td>";	}
    // foreach($result['_id'] as $res)
    // echo "<td><a href=\"edit.php?id=$res\">Edit</a> | <a href=\"delete.php?id=$res\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		

?>
</table>

        </div>


                <?php mysqli_close($conn); // Close connection ?>

             </div>
             <button id="patient_back">close</button>
           
         </div>

    </body>
    

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
                                   const patient_option=document.getElementById("show_data");
                           const closebtn=document.getElementById("patient_back");
                           const viewbtn=document.getElementById("view_report");
                        //    const patient_option=document.getElementById("patient_option");
                        viewbtn.addEventListener("click", (e) => {
                           patient_option.style.visibility="visible";})

                           closebtn.addEventListener("click", (e) => {
                               e.preventDefault();
                               patient_option.style.visibility="hidden";
                               patient_log.style.visibility="hidden";
                           })
                           function tableToCSV() {
                        
                        // Variable to store the final csv data
                        var csv_data = [];

                        // Get each row data
                        var rows = document.getElementsByTagName('tr');
                        for (var i = 0; i < rows.length; i++) {

                            // Get each column data
                            var cols = rows[i].querySelectorAll('td,th');

                            // Stores each csv row data
                            var csvrow = [];
                            for (var j = 0; j < cols.length; j++) {

                                // Get the text data of each cell of
                                // a row and push it to csvrow
                                csvrow.push(cols[j].innerHTML);
                            }

                            // Combine each column value with comma
                            csv_data.push(csvrow.join(","));
                        }
                        // combine each row data with new line character
                        csv_data = csv_data.join('\n');
                        downloadCSVFile(csv_data);

                        /* We will use this function later to download
                        the data in a csv file downloadCSVFile(csv_data);
                        */
                        }
    function downloadCSVFile(csv_data) {
 
                    // Create CSV file object and feed our
                    // csv_data into it
                    CSVFile = new Blob([csv_data], { type: "text/csv" });

                    // Create to temporary link to initiate
                    // download process
                    var temp_link = document.createElement('a');

                    // Download csv file
                    temp_link.download = "details.csv";
                    var url = window.URL.createObjectURL(CSVFile);
                    temp_link.href = url;

                    // This link should not be displayed
                    temp_link.style.display = "none";
                    document.body.appendChild(temp_link);

                    // Automatically click the link to trigger download
                    temp_link.click();
                    document.body.removeChild(temp_link);
                    }
    </script>
</body>
</html>