<?php

ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

if(isset($_POST['submit']))
{
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    if(isset($user, $pass)) {
        session_start();
        {
            $db = new Zebra_Database();
            $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
            $count = $db->select('id', 'users', 'username = ? AND password = ?', array($user, $pass));

            if($count->num_rows == 1)
            {
                while ($row = $db->fetch_assoc()) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['user'] = $user;
                    
                    header("Location:account/admin.php");
                    exit();
                }
            }
            else
            {
               header("Location:login.php?msg=Wrong Username or Password");
            }
        }
    }
    else {
        header("Location:login.php?msg=Please enter a username and password");
    }
}

ob_end_flush();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
    Admin Login
</title>
<meta charset="utf-8"></meta>
<meta http-equiv="X-UA-Compatible" content="IE=edge"></meta>
<meta name="viewport" content="width=device-width"></meta>
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/css/login.css" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="/assets/js/jquery.validate.js" type="text/javascript"></script>
<script src="/assets/js/jquery.watermark.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {

            $("#password").watermark("Password");

            $("#form1").validate({
                errorElement: "div",
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: "Please enter your username"
                    },
                    password: {
                        required: "Please enter your password"
                    }
                }
            });
        });
</script>

<div id="wrapper">
    <div id="wrappertop"></div>

    <div id="wrappermiddle">
            <form id="form1" name="login" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
            <h2>Login to dashboard</h2>

            <div id="username_input">

                <div id="username_inputleft"></div>

                <div id="username_inputmiddle">
                    <input id="tbUsername" name="username" placeholder="Username" class="blockClass" />
                    <img id="url_user" src="/assets/images/mailicon.png" alt="" />
                </div>

                <div id="username_inputright"></div>

            </div>
            <div class="errorSpacer"></div>
            <div id="password_input">

                <div id="password_inputleft"></div>

                <div id="password_inputmiddle">
                    <input id="tbPassword" name="password" placeholder="Password" class="blockClass" type="password" />
                    <img id="url_password" src="/assets/images/passicon.png" alt="" />
                </div>

                <div id="password_inputright"></div>

            </div>
            <div class="errorSpacer"></div>
            <div id="submit">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg :hover" width="200">
            </div>
            </form>
    </div>
    <div id="wrapperbottom"></div>
</div>
</body>
</html>

