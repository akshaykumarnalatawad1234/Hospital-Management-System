<?php
include("connection.php") ;
session_start();
//echo $_SESSION['AdminID'];
if(isset($_POST['add']))
{
    $name=$_POST['PatientName'];
    $PatientId=(int)$_POST['PatientId'];
    $patientpass=$_POST['Patientpass'];
    $phoneno=(int)$_POST['PhoneNo'];
    $DateOfBirth=$_POST['DateOfBirth'];
    $BloodGroup=$_POST['BloodGroup'];
    $City=$_POST['City'];
    $State=$_POST['State'];
    $Country=$_POST['Country'];
    $doctor=(int)$_POST['doctor'];
    $pin=(int)$_POST['pin'];
   
    $fd=$_SESSION['FDID'];
    $sql = "SELECT * FROM `patient` WHERE patient_Id=$PatientId;";
    $result = mysqli_query($conn, $sql);
    $nrows=mysqli_num_rows($result);
    if($nrows!=0)
    {
        echo"<script type=\"text/javascript\">alert('This Patient Id already exists');</script>";
    }
    else{
        $sql2 = "INSERT INTO `patient`(`patient_Id`, `Patient_password`, `P_Name`, `Pin_code`, `city`, `state`, `country`, `DOB`, `bloodgroup`, `FD_FD_ID`,`phone_No`) VALUES ($PatientId,'$patientpass','$name',$pin,'$City','$State',' $Country','$DateOfBirth','$BloodGroup',$fd,$phoneno);";
        $result = mysqli_query($conn, $sql2);
        $sql3="INSERT INTO `doctor_has_patient`(`Doctor_Doctor_ID`, `patient_patient_Id`) VALUES ($doctor,$PatientId);";
        $result2 = mysqli_query($conn, $sql3);
        foreach($_POST['Allergies'] as $alergy)
        {
            $sql4="INSERT INTO `patient_allergy`(`allergy`, `patient_patient_Id`, `patient_FD_FD_ID`) VALUES ('$alergy',$PatientId,$fd);";
            $result3 = mysqli_query($conn, $sql4);
        }
        if($result&&$result2&&$result3)
        {
            echo"<script type=\"text/javascript\">alert('Record added successfully');</script>";
        }
        else{
            echo"<script type=\"text/javascript\">alert('Error please add again +$conn->error_log');</script>";
        }
    }
}
if(isset($_POST['save']))
{
    $name=$_POST['PatientName'];
    $PatientId=$_SESSION['patientid1'];
    $patientpass=$_POST['Patientpass'];
    $phoneno=(int)$_POST['PhoneNo'];
    $DateOfBirth=$_POST['DateOfBirth'];
    $BloodGroup=$_POST['BloodGroup'];
    $City=$_POST['City'];
    $State=$_POST['State'];
    $Country=$_POST['Country'];
    $doctor=(int)$_POST['doctor'];
    $pin=(int)$_POST['pin'];
   
    $fd=$_SESSION['FDID'];
    // $sql = "SELECT * FROM `patient` WHERE patient_Id=$PatientId;";
    // $result = mysqli_query($conn, $sql);
    // $nrows=mysqli_num_rows($result);
    // if($nrows!=0)
    // {
    //     echo"<script type=\"text/javascript\">alert('This Front Desk user Id already exists');</script>";
    // }
    // else{
        $sql2 = "UPDATE `patient` SET `Patient_password`=' $patientpass',`P_Name`='$name',`Pin_code`=$pin,`city`='$City',`state`='$State',`country`='$Country',`DOB`='$DateOfBirth',`bloodgroup`='$BloodGroup',`FD_FD_ID`= $fd,`phone_No`=$phoneno WHERE patient_Id=$PatientId";
        $result = mysqli_query($conn, $sql2);
        $sql3="UPDATE `doctor_has_patient` SET `Doctor_Doctor_ID`=$doctor WHERE patient_patient_Id=$PatientId";
        $result2 = mysqli_query($conn, $sql3);
        $result4=mysqli_query($conn,"DELETE FROM `patient_allergy` WHERE patient_patient_Id=$PatientId");
        foreach($_POST['Allergies'] as $alergy)
        {
            $sql4="INSERT INTO `patient_allergy`(`allergy`, `patient_patient_Id`, `patient_FD_FD_ID`) VALUES ('$alergy',$PatientId,$fd);";
            $result3 = mysqli_query($conn, $sql4);
        }
        if($result&&$result2&&$result3)
        {
            echo"<script type=\"text/javascript\">alert('Record added successfully');</script>";
        }
        else{
            echo"<script type=\"text/javascript\">alert('Error please add again +".mysqli_error($conn)."');</script>";
        }
   // }
}


?>
                    <?php mysqli_close($conn); 
                    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fd_style.css">
    <link rel="text/javascript" href="script1.js">
    <link rel = "icon" href = "images/logo3.png" type = "Images/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hospital Management System</title>
</head>

<body>
    <header>
        <nav>
            <div class="nav navbar">

                <ul class="list-group">
                    <li class="list-group-items">
                        <button name="dashboard" id="dashboard">Dashboard</button>
                        <div id="dash_opt">
                            <button id="add_patient">Add patient</button>
                            <button id="edit_pat">Edit patient</button>

                        </div>
                    </li>

                    <li class="list-group-items"><button href="Support.html">Support</button></li>
                </ul>

                <h1 class="main-header me-5 align-items-center">Core Clinic</h1>

            </div>
        </nav>
    </header>
    <section>
        <div class="body_part">
            <h2 class="central-head text-center fs-1">WELCOME TO THE WORLD OF HEALING</h2>
            <p class="tagline">Empowering People to Improve Their Lives.</p>
        </div>
        <div class="add-patient-div" id="patient_details">
            <form action="fd1.php" method="post">
                <label for="name">Name:&emsp;&emsp;&emsp;</label>
                <input type="text" name="PatientName" id="name" placeholder="Enter Patient Name" required pattern="[a-zA-Z\s_]+">
                <br>
                <label for="patientid">Patient Id:  &emsp;&nbsp; </label>
                <input type="text" name="PatientId" id="patientid" placeholder="Enter Patient Id" required pattern="[0-9]{4,}">
                <br>
                <label for="patientpass">Patient Password:&nbsp; </label>
                <input type="password" name="Patientpass" id="patientpass" placeholder="Enter Patient password" required>
                <br>
                <label for="phoneno">Phone No:&emsp;&nbsp;</label>
                <input type="tel" name="PhoneNo" id="phoneno" placeholder="Enter Patient Mobile No." required pattern="\+?[0-9]{10,12}">
                <br>
                <label for="dob">Date of Birth:</label>
                <input type="date" name="DateOfBirth" id="dob" required>
                <br>
                <label for="bloodgroup">Blood Group:</label>
                <input type="text" name="BloodGroup" id="bloodgroup" placeholder="Enter Patient Blood Group" required pattern="[a-zA-Z]{1,2}[+-](ve)?">
                <br>
                <div class="allergyfield">
                    <div id="add1">
                <label for="allergy">Allergies:&emsp;&emsp;</label>
                <input type="text" name="Allergies[]" id="allergy" placeholder="Enter Patient Allergies" multiple required>
                
                <br></div>
                
                </div>
                <button id="add"  class="btn btn-primary submit">ADD  </button>&emsp;<button id="remove"  class="btn btn-primary submit">REMOVE</button><br>
                <label for="city">City:&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" name="City" id="city" placeholder="Enter the City" required pattern="[a-zA-z_ ]+">
                <br>
                <label for="state">State:&emsp;&emsp;&emsp;&nbsp;&nbsp;</label>
                <input type="text" name="State" id="state" placeholder="Enter the State" required pattern="[a-zA-z_ ]+">
                <br>
                <label for="country">Country:&emsp;&emsp;&nbsp;</label>
                <input type="text" name="Country" id="country" placeholder="Enter the Country" required pattern="[a-zA-z_ ]+">
                <br>
                <label for="pin">Pin code:&emsp;&emsp;&nbsp;</label>
                <input type="text" name="pin" id="pin" placeholder="6 digit pincode"  required pattern="[0-9]{6,6}" >
                <br>
                <label for="doctor">Doctor assigned:&emsp;&emsp;&emsp;&nbsp;&nbsp;</label>
                <select name="doctor" id="doctor" required>
                <option disabled selected>-- Select doctor --</option>
                    <?php
                         include "connection.php";  
                            $records = mysqli_query($conn,  "SELECT `specislization`, `Doctor_ID`, `DR_Name` FROM `doctor` WHERE 1;");  
                            $str='--';
                            while($data = mysqli_fetch_array($records))
                            {
                             echo "<option value='". $data['Doctor_ID']." '>" .$data['DR_Name'] . $str.$data['specislization']."</option>";  
                            }	
                    ?> 
                 
                    <?php mysqli_close($conn); 
                    ?>
                </select>
                <br>
                <input type="submit" value="Register" name="add" class="bg-success btn btn-primary submit">
            </form>
        </div>
        <div class="edit-patient-div" id="edit_patient_div">
            <form action="fd1.php" method="post" id="edit_form">
                <label for="patientid1">Patient Id:  &emsp;&nbsp; </label>
                <input type="text" name="PatientId" id="patientid1" placeholder="Enter Patient Id"  pattern="[0-9]{4,}">
                <br>
                <input type="submit" value="search" name="search" class="btn btn-primary submit" id="search_btn">
                <br>
             </form>
             <form action="fd1.php" method="post" id="edit_form1">
                <?php
                    include "connection.php";
                    //session_start();
                    
                    if(isset($_POST['search'])){
                        
                        $pid=(int)$_POST['PatientId'];
                        $_SESSION['patientid1']=(int)$_POST['PatientId'];
                        $_POST['search']=null;
                        echo "<script type=\"text/javascript\">document.getElementById('edit_patient_div').style.visibility = 'visible';</script>";
                        $records = mysqli_query($conn,  "SELECT `Patient_password`, `P_Name`, `Pin_code`, `city`, `state`, `country`, `DOB`, `bloodgroup`, `FD_FD_ID`,`phone_No`  FROM `patient` WHERE patient_Id=$pid;"); 
                        $data1=mysqli_fetch_array($records);
                        
                        $records1 = mysqli_query($conn,  "SELECT concat(`specislization`,'-', `DR_Name`) AS dinfo , `Doctor_ID` FROM `doctor` WHERE Doctor_ID IN (SELECT `Doctor_Doctor_ID` FROM `doctor_has_patient` WHERE patient_patient_Id=$pid);"); 
                        $data2=mysqli_fetch_array($records1);
                        if($data1==null)
                       { echo"<script type=\"text/javascript\">alert('Record not exists');</script>";
                    }
                        $records2 = mysqli_query($conn,  "SELECT `allergy` FROM `patient_allergy` WHERE patient_patient_Id=$pid;"); 
                        $records3 = mysqli_query($conn,  "SELECT concat(`specislization`,'-', `DR_Name`) AS dinfo , `Doctor_ID` FROM `doctor` WHERE 1;");
                        echo "
                        <label for=\"name\">Name:&emsp;&emsp;&emsp;</label>
                        <input type=\"text\" name=\"PatientName\" id=\"name1\" value=\"".$data1['P_Name'] ."\"required pattern=\"[a-zA-Z\s_]+\">
                        <br>
                        <label for=\"patientpass\">Patient Password:&nbsp; </label>
                        <input type=\"password\" name=\"Patientpass\" id=\"patientpass1\" value=\"".$data1['Patient_password']."\" required>
                        <br>
                        <label for=\"phoneno\">Phone No:&emsp;&nbsp;</label>
                        <input type=\"tel\" name=\"PhoneNo\" id=\"phoneno1\" value=\"".$data1['phone_No'] ."\" required pattern=\"\\+?[0-9]{10,12}\">
                        <br>
                        <label for=\"dob\">Date of Birth:</label>
                        <input type=\"date\" name=\"DateOfBirth\" id=\"dob1\" value=\"".date('Y-m-d',strtotime($data1['DOB'] ))."\"required>
                        <br>
                        <label for=\"bloodgroup\">Blood Group:</label>
                        <input type=\"text\" name=\"BloodGroup\" id=\"bloodgroup1\" value=\"".$data1['bloodgroup']."\"required  pattern=\"[a-zA-Z]{1,2}[+-](ve)?\">
                        <br>
                        <div class=\"allergyfield1\">
                        
                        ";
                        $x=1;
                        while($data = mysqli_fetch_array($records2))
                        {
                         echo "  <div id=\"addz1".$x."\">
                         <label for=\"allergy\">Allergies:&emsp;&emsp;</label>
                         <input type=\"text\" name=\"Allergies[]\"  value=\"".$data['allergy']."\" multiple required>
                         
                         <br></div>";  
                        }
                        echo"</div>
                        <button id=\"addb1\" class=\"btn btn-primary submit\">ADD  </button>&emsp;<button id=\"removez1\" class=\"btn btn-primary submit\">REMOVE</button><br>
                        <label for=\"city\">City:&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type=\"text\" name=\"City\" id=\"city1\" value=\"".$data1['city']."\"required  pattern=\"[a-zA-z_ ]+\">
                        <br>
                        <label for=\"state\">State:&emsp;&emsp;&emsp;&nbsp;&nbsp;</label>
                        <input type=\"text\" name=\"State\" id=\"state1\" value=\"".$data1['state']."\" required  pattern=\"[a-zA-z_ ]+\">
                        <br>
                        <label for=\"country\">Country:&emsp;&emsp;&nbsp;</label>
                        <input type=\"text\" name=\"Country\" id=\"country1\" value=\"".$data1['country']."\" required pattern=\"[a-zA-z_ ]+\">
                        <br>
                        <label for=\"pin\">Pin code:&emsp;&emsp;&nbsp;</label>
                        <input type=\"text\" name=\"pin\" id=\"pin1\" value=\"".$data1['Pin_code']."\" pattern=\"[0-9]{6}\" required >
                        <br>
                        <label for=\"doctor\">Doctor assigned:&emsp;&emsp;&emsp;&nbsp;&nbsp;</label>
                        <select name=\"doctor\" id=\"doctor1\" required>
                       // <option disabled selected>-- Select doctor --</option>
                        <option value='". $data2['Doctor_ID']." 'selected>" .$data2['dinfo']."</option>
                        ";	
                        while($data = mysqli_fetch_array($records3))
                        {
                            if( $data2['Doctor_ID']!=$data['Doctor_ID'])
                         echo "<option value='". $data['Doctor_ID']." '>" .$data['dinfo']."</option>";  
                        }
                        echo "
                        </select>
                        <br>
                        <input type=\"submit\" value=\"save\" name=\"save\" class=\"bg-success btn btn-primary submit\">
                        ";
                       
                    }
                     

                ?>
                                    <?php mysqli_close($conn); 
                    ?>


                <!-- <div id="search_result">
                    <label for="name1">Name:&emsp;&emsp;&emsp;</label>
                    <input type="text" name="PatientName" id="name1" placeholder="Enter Patient Name" required>
                    <br>
                    <label for="phoneno1">Phone No:&emsp;&nbsp;</label>
                    <input type="tel" name="PhoneNo" id="phoneno1" placeholder="Enter Patient Mobile No." required>
                    <br>
                    <label for="dob1">Date of Birth:</label>
                    <input type="date" name="DateOfBirth" id="dob1" required>
                    <br>
                    <label for="bloodgroup1">Blood Group:</label>
                    <input type="text" name="Blood Group" id="bloodgroup1" placeholder="Enter Patient Blood Group">
                    <br>
                    <label for="allergy1">Allergies:&emsp;&emsp;</label>
                    <input type="text" name="Allergies[]" id="allergy1" placeholder="Enter Patient Allergies" multiple required>
                    <br>
                    <label for="city1">City:&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="text" name="City" id="city1" placeholder="Enter the City">
                    <br>
                    <label for="state1">State:&emsp;&emsp;&emsp;&nbsp;&nbsp;</label>
                    <input type="text" name="State" id="state1" placeholder="Enter the State">
                    <br>
                    <label for="country1">Country:&emsp;&emsp;&nbsp;</label>
                    <input type="text" name="Country" id="country1" placeholder="Enter the Country">
                    <br>
                    <input type="submit" value="Save" name="edit" class="bg-success p-2 rounded-1 border-0 text-light" id="edit_submit">
                </div> -->

            </form>
                    
                    <button id="formclose" class="btn btn-primary submit border-2 margin-4">close</button>
        </div>
    </section>
    <footer>

    </footer>
    <script type="text/javascript" src="script1.js"></script>


</body>

</html>
