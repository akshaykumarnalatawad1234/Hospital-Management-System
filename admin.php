<?php
include("connection.php") ;
 //echo $_SESSION['AdminID'];
if(isset($_POST['FD']))
{
    $name=$_POST['FDName'];
    $ID=(int)$_POST['FDId'];
    $pass=$_POST['FDpass'];
    $phone=$_POST['FDphone'];
    session_start();
    $admin=$_SESSION['AdminID'];
    $sql = "SELECT `FD_ID`FROM `fd` WHERE FD_ID=$ID;";
    $result = mysqli_query($conn, $sql);
    $nrows=mysqli_num_rows($result);
    if($nrows!=0)
    {
        echo"<script type=\"text/javascript\">alert('This Front Desk user Id already exists');</script>";
    }
    else{
        $sql2 = "INSERT INTO `fd`(`FD_ID`, `FD_NAME`, `Admin_LoginId`, `FD_password`) VALUES ($ID,'$name',$admin,'$pass');";
        $result = mysqli_query($conn, $sql2);
        if($result)
        {
            echo"<script type=\"text/javascript\">alert('Record added successfully');location.href = \"admin.html\";</script>";
        }
        else{
            echo"<script type=\"text/javascript\">alert('Error please add again +$conn->error_log');</script>";
        }
    }
    

}
if(isset($_POST['doctor']))
{
    $name=$_POST['DocName'];
    $ID=(int)$_POST['DocId'];
    $pass=$_POST['Docpass'];
    $phone=$_POST['Docph'];
    $spec=$_POST['Docspec'];
    session_start();
    $admin=$_SESSION['AdminID'];
    echo $_SESSION['AdminID'];
    $sql = "SELECT `specislization` FROM `doctor` WHERE Doctor_ID=$ID;";
    $result = mysqli_query($conn, $sql);
    $nrows=mysqli_num_rows($result);
    if($nrows!=0)
    {
        echo"<script type=\"text/javascript\">alert('This Doctor Id already exists');</script>";
    }
    else{
        $sql2 = "INSERT INTO `doctor`(`specislization`, `Doctor_ID`, `DR_Name`, `Admin_LoginId`, `Doctor_password`, `Doctor_phone`) VALUES ('$spec',$ID,'$name',$admin,'$pass','$phone');";
        $result = mysqli_query($conn, $sql2);
        if($result)
        {
            echo"<script type=\"text/javascript\">alert('Record added successfully');location.href = \"admin.html\";</script>";
        }
        else{
            echo"<script type=\"text/javascript\">alert('Error please add again +$conn->error_log');</script>";
        }
    }

   

}
mysqli_close($conn);
?>