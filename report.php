<!DOCTYPE html>
<html lang="en kn">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "icon" href = "images/logo3.png" type = "Images/png">
        <title>HMS/doctor.html</title>
        <link rel="stylesheet" type="text/css" href="drstyle.css">
        

    </head>
    <body >
        <section >
            <div class="body_part">
                <h2 class="central-head text-center fs-1">WELCOME TO THE WORLD OF HEALING</h2>
                <p class="tagline">Empowering People to Improve Their Lives.</p>
                <h3>Welcome Doctor</h3>
                <div id="view_pat">
                <a href="http://127.0.0.1:5000/" target="_blank" id="ML">Use ML models</a>
                </div>

            </div>
            <div id="patient_table">
                <!-- <table>
                    <tr>
                      <th>Patient Id</th>
                      <th>Full Name</th>
                      <th>Report</th>
                    </tr> -->
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
 
                  
                  <?php mysqli_close($conn); // Close connection ?>
                  <div style="position:relative;width:50%">
            
            <br/><br/>
        
            <form action="report.php" method="post" name="form1">
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

                  

            </div>
            
        
           
        </section>

        
        
        

    </body>
</html>