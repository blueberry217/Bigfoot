<?php

// check session
session_start();

//check login
if (isset($_SESSION["logged"]) && $_SESSION["logged"] === true) {
    header("location: index.php");
exit();
}

// check file
require_once "php/connection.php";

// get login information
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] != '' && $_POST['password'] != '') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "select * from user where username ='" .$username ."' and password ='" .$password ."';";
        $result = $db->query($query);
        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["logged"] = true;
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                // give permission id
                $roles = "select * from permissions where userid ='" .$row["id"] . "';";
                $result2 = $db->query($roles);
                // check row
                if ($result2->num_rows == 1) {
                    // fetch row
                    while ($row2 = $result2->fetch_assoc()) {
                        //brand permissions
                        $_SESSION["brand_insert"] = $row2['brand_insert'];
                        $_SESSION["brand_update"] = $row2['brand_update'];
                        $_SESSION["brand_remove"] = $row2['brand_remove'];
                        $_SESSION["brand_view"] = $row2['brand_view'];
                        //model permissions
                        $_SESSION["models_insert"] = $row2['models_insert'];
                        $_SESSION["models_update"] = $row2['models_update'];
                        $_SESSION["models_remove"] = $row2['models_remove'];
                        $_SESSION["models_view"] = $row2['models_view'];
                        //sizes permissions
                        $_SESSION["sizes_insert"] = $row2['sizes_insert'];
                        $_SESSION["sizes_update"] = $row2['sizes_update'];
                        $_SESSION["sizes_remove"] = $row2['sizes_remove'];
                        $_SESSION["sizes_view"] = $row2['sizes_view'];
                    }
                }
                header("location: index.php");
            }
        }
    }
}

?>

<style>

* {
  	box-sizing: border-box;
  	font-family: -apple-system, BlinkMacSystemFont, "segoe ui", roboto, oxygen, ubuntu, cantarell, "fira sans", "droid sans", "helvetica neue", Arial, sans-serif;
  	font-size: 16px;
  	-webkit-font-smoothing: antialiased;
  	-moz-osx-font-smoothing: grayscale;
}
body {
  	background-color: #435165;
}
.login {
  	width: 400px;
  	background-color: #ffffff;
  	box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
  	margin: 100px auto;
}
.login h1 {
  	text-align: center;
  	color: #5b6574;
  	font-size: 24px;
  	padding: 20px 0 20px 0;
  	border-bottom: 1px solid #dee0e4;
}
.login form {
  	display: flex;
  	flex-wrap: wrap;
  	justify-content: center;
  	padding-top: 20px;
}
.login form label {
  	display: flex;
  	justify-content: center;
  	align-items: center;
  	width: 50px;
  	height: 50px;
  	background-color: #3274d6;
  	color: #ffffff;
}
.login form input[type="password"], .login form input[type="text"] {
  	width: 310px;
  	height: 50px;
  	border: 1px solid #dee0e4;
  	margin-bottom: 20px;
  	padding: 0 15px;
}
.login form input[type="submit"] {
  	width: 100%;
  	padding: 15px;
 	margin-top: 20px;
  	background-color: #3274d6;
  	border: 0;
  	cursor: pointer;
  	font-weight: bold;
  	color: #ffffff;
  	transition: background-color 0.2s;
}
.login form input[type="submit"]:hover {
	background-color: #2868c7;
  	transition: background-color 0.2s;
}

</style>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bigfoot</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Bigfoot</h1>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username..."  id="">
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password..." id="">
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>

</form>