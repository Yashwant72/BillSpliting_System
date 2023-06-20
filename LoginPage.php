<?php
session_start();
require 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="userLoginStyle.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div id="bg"></div>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" autocomplete="on">
        <div class="form-field">
            <input id = "details" type="text" placeholder="Username" name="name" required />
        </div>

        <div class="form-field">
            <input id = "details" type="password" placeholder="Password" name="password" required />
        </div>

        
        <div class="form-field">
        <a class = "anc" href="./application.php"><input class = "btn" type="submit" name="login" value="Login" id="lsubmit"></a>        
        </div>    

        <div class="form-field">
            <a class = "anc" href="New_Admin.html"><button class="btn">Back</button></a>
        </div>
    </form>
    <!-- partial -->

</body>

</html>

<?php
if (isset($_POST['login']) && $_POST['login'] == "Login") {
    $name = $_POST['name'];
    //$email=$_POST['email'];
    $password = $_POST['password'];

    $sql_check_member = "SELECT * FROM members WHERE name='$name' AND password='$password' ";
    $result = mysqli_query($con, $sql_check_member);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['isLoggedInMember'] = 1;
        $row = mysqli_fetch_assoc($result);
        $_SESSION['member_id'] = $row['member_id'];
        echo "<meta http-equiv='refresh' content='0;URL=application.php'>";
    } else {
        echo "<script>alert('Invalid User. Please enter valid credentials.')</script>";
    }
}
?>