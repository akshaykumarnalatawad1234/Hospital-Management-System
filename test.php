<table>
                    <tr>
                      <td>Patient Id</td>
                      <td>Full Name</td>
                      <td>Report</td>
                    </tr>
                  
                  <?php
                  
                  include "connection.php"; // Using database connection file here
                  echo"<script type=\"text/javascript\">
                  var DrID = localStorage.getItem('doctorID');
                  $.POST('doctor.php', {'doctorID':DrID});

                  </script>";
                  $doctorID;
                  
                  $sql = $sql = "SELECT `patient_Id`, `P_Name` FROM `patient` WHERE patient_Id IN(SELECT  `patient_patient_Id` FROM `doctor_has_patient` WHERE Doctor_Doctor_ID='2021002');";
                  $result = mysqli_query($conn, $sql);
                  
                  while($data = mysqli_fetch_array($result))
                  {
                  ?>
                    <tr>
                      <td><?php echo $data['patient_Id']; ?></td>
                      <td><?php echo $data['P_Name']; ?></td>
                      <td><button class="view_rep" value="$data['patient_Id']" >View Report</button></td>
                    </tr>	
                  <?php
                  }
                  ?>
                  </table>
                  
                  <?php mysqli_close($conn); // Close connection ?>