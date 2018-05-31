<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'test') or die(mysqli_error());
if(isset($_POST["submit"])){
 $sql = "SELECT * FROM userpass WHERE user = '".$_POST["name"]. "' AND pass = '" .$_POST["pass"]."'";
 $query = mysqli_query($conn, $sql);
 $res = mysqli_fetch_assoc($query);
 if($res)
 {
 if(!empty($_POST["remember"]))
 {
 setcookie ("user", $_POST["name"], time() + (10 * 365 * 24 * 60 * 60));
 setcookie ("pass", $_POST["pass"], time() + (10 * 365 * 24 * 60 * 60));
 }
 else
 {
 if(isset($_COOKIE["user"]))
 {
 setcookie ("user", "");
 }
 if(isset($_COOKIE["pass"]))
 {
 setcookie ("pass", "");
 }
 }
 header("Location:welcome.php");
 }
 else
 {
 $msg = "Invalid Username or Password";
 }
}
?>
<!doctype html>
<html>
<head>
<title>SoftAOX | Login</title>
</head>
<body>
<form action="" method="post">
<label>Username</label>
<input type="text" name="name" value="<?php if(isset($_COOKIE["user"])) {echo $_COOKIE["user"];} ?>"/><br/><br/>
<label>Password</label>
<input type="password" name="pass" value="<?php if(isset($_COOKIE["pass"])) {echo $_COOKIE["pass"];}?>"/><br/><br/>
<input type="checkbox" name="remember" <?php if(isset($_COOKIE["user"])) { ?> checked <?php }?>/>
<label>Remember me</label><br/><br/>
<input type="submit" name="submit" value="Login">
<p><?php if(isset($msg)) {echo $msg;} ?></p>
</form>
</body>
</html>