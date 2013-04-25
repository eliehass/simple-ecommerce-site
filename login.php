<?php
include_once 'header.php';
echo "<div class='main'><h3>Please enter your details to log in</h3>";
$error = $user = $pass = "";

if (isset($_POST['user']))
//if (isset($_SESSION['user'])) destroySession();
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    
    if ($user == "" || $pass == "")
    {
        $error = "Not all fields were entered<br />";
    }
    else
    {
        $salt1 = 'fy%^$';
        $salt2 = ')(#@fs&';
        $pass = sha1("$salt1$pass$salt2");
        $query = "SELECT username, password FROM user WHERE username='$user' AND password='$pass'";
        
        if (mysql_num_rows(queryMysql($query)) == 0)
        {
            $error = "<span class='error'>Username/Password invalid</span><br /><br />";
        }
        else
        {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            die("You are now logged in. Please <a href='index.php'>" .
                "click here</a> to continue.<br /><br />");
        }
    }
}

echo <<<_END
<form method='post' action='login.php'>$error
<span class='fieldname'>Username</span><input type='text'
    maxlength='16' name='user' value='$user' /><br />
<span class='fieldname'>Password</span><input type='password'
    maxlength='16' name='pass' />
_END;
?>

<br />
<span class='fieldname'>&nbsp;</span> 
<input type='submit' value='Login' /> 
</form><br /></div></body></html>