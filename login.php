<?php
include("connection.php") ;

//echo "entered php";
// $_POST["method"]="testpassword";
// $_POST["table"]="doctor";
// $_POST["username"]=2021001;
// $_POST["passwd"]="dr20211";
//echo "<script type='text/javascript'>console.log($_POST['method'])</script>";
echo $_POST["method"]();
$passed;

function testpassword()
{
  global $passed;
  global $conn;
  $table=$_POST["table"];
 
  $username=(int)$_POST["username"];
  $passwd=$_POST["passwd"];

  
  switch($table){
    case "doctor":
      $sql = "SELECT  `Doctor_password` FROM `doctor` WHERE Doctor_ID=$username;";
      $result = mysqli_query($conn, $sql);
      $nrows=mysqli_num_rows($result);
      if($nrows==0)
      {
        $passed=0;
      }
      else{
        $row = mysqli_fetch_assoc($result);

        if ($row["Doctor_password"]==$passwd)
        {$passed=1;
          session_start();
          $_SESSION['DoctorID']=$username;
        }
    
        else{
          $passed=0;
        }
      }

     
      break;
    case "admin":
      $sql = "SELECT `Password` FROM `admin` WHERE LoginId=$username;";
      $result = mysqli_query($conn, $sql);
      $nrows=mysqli_num_rows($result);
      if($nrows==0)
      {
        $passed=0;
      }
      else{
        $row = mysqli_fetch_assoc($result);

        if ($row["Password"]==$passwd)
        {$passed=1;
          session_start();
          $_SESSION['AdminID']=$username;

        }
    
        else{
          $passed=0;
        }
      }
      break;
      case "FD":
        $sql = "SELECT `FD_password` FROM `fd` WHERE FD_ID=$username;";
        $result = mysqli_query($conn, $sql);
        $nrows=mysqli_num_rows($result);
      if($nrows==0)
      {
        $passed=0;
      }
      else{
        $row = mysqli_fetch_assoc($result);

        if ($row["FD_password"]==$passwd)
        {$passed=1;
          session_start();
          $_SESSION['FDID']=$username;

        }
    
        else{
          $passed=0;
        }
      }
        break;
        case "patient":
          $sql = "SELECT`Patient_password`  FROM `patient` WHERE patient_Id=$username;";
          $result = mysqli_query($conn, $sql);
          $nrows=mysqli_num_rows($result);
          if($nrows==0)
          {
            $passed=0;
          }
          else{
            $row = mysqli_fetch_assoc($result);
    
            if ($row["Patient_password"]==$passwd)
            {$passed=1;
              session_start();
              $_SESSION['PatientID']=$username;
              
            }
        
            else{
              $passed=0;
            }
          }
          break;
                  
  }
 // return $passed;
}
//echo "<script type='text/javascript'>alert($passed)</script>";

header("Content-Type: application/json"); 
echo json_encode($passed);
  
  mysqli_close($conn);


?>