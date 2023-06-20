<?php 
session_start();

require 'connection.php';
$group_name = $_SESSION['group_name'];
$balance = $_SESSION['balance'];
$total = $_POST['total'];
//$status = $_POST['btn'];
echo $total;
$query = "SELECT * FROM MEMBERS WHERE GROUP_NAME = '$group_name'";
$res = mysqli_query($con, $query);
$no = mysqli_num_rows($res);
echo $no;
$add_balance = (float)$total / $no;
echo $add_balance;
$update = "UPDATE members SET balance = $balance + $add_balance WHERE group_name = '$group_name'";
if (mysqli_query($con, $update)) {
    echo "<script>alert('Bill Splited Successfully')</script>";
    //echo "<meta http-equiv='refresh' content='0;URL=image.php'>";
} else {
    echo "<script>alert('Error !!!! Bill Splited Not Successfully')</script>";
    //echo "<meta http-equiv='refresh' content='0;URL=image.php'>";
}
?>
<!--<!DOCTYPE html>
<html>
    
    <body>
        <button><a href=""></a>Home</button>
        <button><a href=""></a>Logout</button>
    </body>
    
</html>-->

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="type1.css">
</head>

<body class="loginTypeBack">

    <h1>Select Your Preferable Choice</h1>
    
    <table align="center">
        <tr>
            <td>
                <button><a href="index.html">Logout</a></button>
            </td>
            
        </tr>
        <tr>
            <td>
                <button><a href="application.php">Application Page</a></button>
            </td>
            
        </tr>
    </table>
</body>

</html>

<style>
   .loginTypeBack{
    background-image: url('background.jpg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width: auto;
   }
</style>