
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
                    <button id="view_patient" >View Your Patients</button>
                </div>

            </div>
            <div id="patient_table" style="display:none">
                <table>
                    <tr>
                      <th>Patient Id</th>
                      <th>Full Name</th>
                      <th>Report</th>
                    </tr>
                  
                  <?php
                  
                  include "connection.php"; // Using database connection file here
                  // echo"<script type=\"text/javascript\">
                  // $(document).ready( function() {
                  // var DrID = localStorage.getItem('doctorID');
                  // $_POST('', {'doctorID':DrID});}

                  // </script>";
                    session_start();
                   $doctorID=$_SESSION['DoctorID'];
                  // $doctorID = "<script type=\"text/javascript\">document.write(localStorage.getItem('doctorID'))</script>";
                  // // echo $doctorID;
                  
                  $sql = "SELECT `patient_Id`, `P_Name` FROM `patient` WHERE patient_Id in(SELECT  `patient_patient_Id` FROM `doctor_has_patient` WHERE Doctor_Doctor_ID=$doctorID);";
                  $result = mysqli_query($conn, $sql);
                  
                  while($data = mysqli_fetch_array($result))
                  {
                  ?>
                    <tr>
                      <td><?php echo $data['patient_Id']; ?></td>
                      <td><?php echo $data['P_Name']; ?></td>
                      <td><form action="doctor.php" method="post"><input type="submit" name="button" class="view_rep" value= <?php echo $data['patient_Id'] ?> >view report</form></td>
                      <!-- <button class="view_rep" value= <?php echo $data['patient_Id'] ?>>View Report</button> -->
                    </tr>	
                  <?php
                  }
                  ?>
                  </table>
                  <?php
      
        if(isset($_POST['button'])) {
          session_start();
          $_SESSION['PatientID']=$_POST['button'];
            echo "<script type=\"text/javascript\">location.href=\"report.php\";</script>";
        }
        
    ?>
                  
                  <?php mysqli_close($conn); // Close connection ?>
                  

            </div>

        </section>
        <script src="drscript.js"> </script>

    </body>
</html>