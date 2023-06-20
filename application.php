<?php


require 'connection.php';
session_start();
$id = $_SESSION['member_id'];
//echo $id;
$query = "SELECT * FROM MEMBERS WHERE member_id  = '$id'";
$result = $con->query($query);
if (mysqli_num_rows($result) == 0) {
    echo "No Value";
} else {
    $row = $result->fetch_assoc();
}

$name = $row['name'];
$balance = $row['balance'];
$group = $row['group_name'];

$_SESSION['balance'] = $balance;
$_SESSION['group_name'] = $group;
?>
<!--<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./backend.css">
    </link>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>
    <div>
        <h1 id="begin" align="center"><?php //echo "Welcome " . $name; ?></h1>
    </div>
    
    <div>
    <a style=" color:blue;font-size:20px;padding-left:500px;" href="logout.php">LOGOUT</a>
    </div>
    
    <div>
        <label for="Balance"> Balance: </label>
        <div class="out"><?php //echo $balance; ?></div>
    </div>
    <br>
    <div>
        <form action="image.php" method = "POST" enctype="multipart/form-data">
            <label for="Add Amount"> Add Amount: </label>
            <input type="file" name="image"></input>
            <button type="submit">Submit</button>
        </form>
    </div>
    <br>
    <div>
        <label for="Groups"> Groups: </label>
        <div class="out"><?//php echo $group; ?></div>
    </div>
</body>

</html>-->

<html>

<head>
    <title>Application Page</title>
    <link rel="stylesheet" href="formStyle.css">
</head>

<body class="bodyForm">
    <center>
        <h1 class="heading">
        <h1 id="begin"><?php echo "Welcome " . $name; ?></h1>
        </h1>
        <a style=" color:beige;font-size:20px;padding-left:500px;" href="logout.php"><button id = "formButton">LOGOUT</button></a>
    </center>
    <br>
    <form action="image.php" method = "POST" enctype="multipart/form-data" class="form">
        <table cellspacing="22px" align="center">
            <tr>
                <td><label for="addAmount" class="formLabel">Add Amount :</label></td>
                <td><input type="file" placeholder="Uploat bill image..." name="image" id="billInput"
                        class="inputTextClass" /></td>
            </tr>
        </table>
        <br>
        <center><input type="submit" name="Submit" value="SUBMIT" id="formButton" class="box" /></center>
    </form>
    <br><br><br>
    
    <table cellspacing="22px" align="center" class="form">
        <tr>
            <td><label for="balance" class="formLabel">Balance :</label></td>
            <td><input type="text" name="balance" value="<?php echo $balance; ?>" id="balanceInput"
                        class="inputTextClass" /></td>
        </tr>
        <tr>
            <td><label for="group" class="formLabel">Group Name :</label></td>
            <td><input type="text" name="grp" value="<?php echo $group; ?>" id="groupInput"
                        class="inputTextClass" /></td>
        </tr>

    </table>
    

</body>

</html>