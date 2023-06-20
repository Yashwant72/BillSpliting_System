<?php
require 'connection.php';
session_start();
//echo var_dump($_FILES);
$image = $_FILES['image'] ?? null;
$text = '';
$total = 0;
if (isset($_FILES['image'])) {

    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($file_tmp, "images/" . $file_name);

    echo "<h3>Image Upload Successful</h3>";
    //echo '<img src = images/'.$file_name.'><br>';
    shell_exec('"C:\\Users\\Yashwant Chavan\\AppData\\Local\\Tesseract-OCR\\tesseract" "C:\\xampp\\htdocs\\Bill_Spliting\\images\\' . $file_name . '" out');



    $my_file = fopen("out.txt", "r") or die("FOF");
    //$text = '';
    $line = '';

    while (!feof($my_file)) {

        $text .= fgets($my_file) . "<br>";
    }
    //echo $text;

    preg_match_all("/[=%][ ](\d+(?:\.\d{0, 2})?)/", $text, $array);
    //var_dump($array);
    $cost = $array[1];
    //var_dump($cost);
    if (count($cost) == 0) {
        $total = 0;
    }
    else {
        $total = max($cost);
    }
    //echo $total;
    fclose($my_file);
}
//echo var_dump($image);

/*if (!is_dir('images')) {
    mkdir('images');
}

if ($image) {
    $imagepath = 'C:\\xampp\\htdocs\\Bill_Spliting\\images' . randomString(7) . $image['name'];
    $link = $image['name'];
    //echo $imagepath;
    move_uploaded_file($image['tmp_name'], $imagepath);
}

$command = escapeshellcmd("python 1_1.py $imagepath");
$output = shell_exec($command);*/
//echo $output;

/*function randomString($n)
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $temp =  rand(0, strlen($chars));
        $str .= $chars[$temp];
    }
    return $str;
}*/

$group_name = $_SESSION['group_name'];
$query = "SELECT * FROM MEMBERS WHERE GROUP_NAME = '$group_name'";
$res = mysqli_query($con, $query);
$no = mysqli_num_rows($res);
//echo $no;
$add_balance = (float)$total / $no;
//echo $add_balance;
$balance = $_SESSION['balance'];
$_SESSION['add_balance'] = $add_balance;
?>


<!--<html>

<head>

</head>

<body>
    <div>
        <a style=" color:blue;font-size:20px;padding-left:500px;" href="logout.php">LOGOUT</a>
    </div>
    <table>

        <tr>
            <td>
                <h2> Total Bill Amount : <?php //echo $total; ?></h2>
            </td>
        </tr>
        <tr>
            <td>
                <h2>Bill Split Amount : <?php //echo $add_balance; ?></h2>
            </td>
        </tr>
        <tr>
            <td>
                <h2> Uploaded Image : </h2>
                <div><?php /*echo '<img src = images/' . $file_name . '><br>';*/ ?></div>
            </td>

        </tr>
        <tr>
            <td>
                
                <form action="final.php" method="POST">
                <label for="total">Check The Total Amount : </p>
                <input type = "text" id = "total" name = "total" value="<?php //echo $total; ?>"/>
                <button type = "submit">Add Bill Amount</button>
                </form>
            </td>
        </tr>
    </table>
</body>

</html>-->


<html>

<head>
    <title>Image Reader</title>
    <link rel="stylesheet" href="formStyle.css">
</head>

<body>
    <div>
    <a style=" color:beige;font-size:20px;padding-left:500px;" href="logout.php"><button id = "formButton">LOGOUT</button></a>
    </div>
    <table cellspacing="10px" align="center" class="form">

        <tr>
            <td><label for="billAmount" class="formLabel">Total Bill Amount :</label></td>
            <td><input type="text" name="amt" id="amtInput" value="<?php echo $total; ?>"
                        class="inputTextClass" /></td>
        </tr>
        <tr>
            <td><label for="splitBillAmount" class="formLabel">Bill Split Amount :</label></td>
            <td><input type="text" name="splitAmt" id="splitAmtInput" value="<?php echo $add_balance; ?>"
                        class="inputTextClass" /></td>
        </tr>
        <tr>
        <td>
            <h2> Uploaded Image : </h2>
        </td>    
        <td>
                <div style="border : 2px solid black, width : 50px, height : 50px"><?php echo '<img src = images/' . $file_name . '><br>'; ?></div>
            </td>
        </tr>
        <form action="final.php" method="POST">
        <tr>
            <td><label for="total" class="formLabel">Check The Total Amount : </label></td>
            <td><input type = "text" class="inputTextClass" id = "total" name = "total" value="<?php echo $total; ?>"/>&nbsp;
            <input type="submit" name="subBill" value="Add Bill Amount" id="formButton" class="box" />
            </td>
        </tr>
    </form>
    </table>
</body>

</html>