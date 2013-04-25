<?php // signup.php 
include_once 'header.php';

echo <<<_END
<script>
function checkUser(user) 
{    
    if (user.value.length < 5)
    {
        O('info').innerHTML = "&nbsp&#x2718 Usernames must be at least 5 characters"
        return
    }
    else if (/[^a-zA-Z0-9_-]/.test(user.value))
    {
         O('info').innerHTML = "&nbsp&#x2718 Only a-z, A-Z, 0-9, - and _ allowed in Usernames."
        return
    }

    params = "user=" + user.value
    request = new ajaxRequest()
    request.open("POST", "checkuser.php", true) 
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded") 
    request.setRequestHeader("Content-length", params.length) 
    request.setRequestHeader("Connection", "close")

    request.onreadystatechange = function() 
    {
        if (this.readyState == 4) 
            if (this.status == 200)
                if (this.responseText != null) 
                    O('info').innerHTML = this.responseText
    }
    request.send(params) 
}

function checkPass(pass)
{
    if (pass.value.length < 6)
        O('passinfo').innerHTML = "&nbsp&#x2718 Passwords must be at least 6 characters."
    else if (!/[a-z]/.test(pass.value) || !/[A-Z]/.test(pass.value) || !/[0-9]/.test(pass.value))
        O('passinfo').innerHTML = "&nbsp&#x2718 Passwords require one of each of a-z, A-Z, and 0-9."
    else
        O('passinfo').innerHTML = "&nbsp&#x2714 Password is valid."
}

function comparePass(pass)
{
    var pass1 = document.getElementsByName('pass')
    if (pass.value != pass1[0].value)
        O('passinfo').innerHTML = "&nbsp&#x2718 Passwords do not match."
}

function ajaxRequest() 
{
    try { var request = new XMLHttpRequest() } 
    catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") } 
        catch(e2) {
            try { request = new ActiveXObject("Microsoft.XMLHTTP") } 
            catch(e3) {
                request = false
    }  }  }
    return request 
}
</script>
<div class='main'><h3>Please enter your details to sign up</h3> 
_END;

$error = $user = $pass = $pass2 = $email = $firstname = $lastname = $phonenumber = 
    $address1 = $address2 = $city = $state = $zip = "";
if (isset($_SESSION['user'])) destroySession();

if (isset($_POST['user'])) 
{
    $user = sanitizeString($_POST['user']); 
    $pass = sanitizeString($_POST['pass']);
    $pass2 = sanitizeString($_POST['pass2']);
    $email = sanitizeString($_POST['email']);
    $firstname = sanitizeString($_POST['firstname']);
    $lastname = sanitizeString($_POST['lastname']);
    $phonenumber = sanitizeString($_POST['phonenumber']);
    $address1 = sanitizeString($_POST['address1']);
    $address2 = sanitizeString($_POST['address2']);
    $city = sanitizeString($_POST['city']);
    $state = sanitizeString($_POST['state']);
    $zip = sanitizeString($_POST['zip']);
    
    if ($user == "" || $pass == "" || $email == "" || $firstname == "" || $lastname == "" || 
        $phonenumber == "" || $address1 == "" || $city == "" || $state == "" || $zip == "")
        $error = $error . "Not all fields were entered<br />";
    if (strlen($user) < 5)
        $error = $error . "Usernames must be at least 5 characters<br />"; 
    elseif (preg_match("/[^a-zA-Z0-9_-]/", $user))
        $error = $error . "Only letters, numbers, - and _ in usernames<br />"; 
    if (strlen($pass) < 6)
        $error = $error . "Passwords must be at least 6 characters<br />";
    elseif ( !preg_match("/[a-z]/", $pass) || !preg_match("/[A-Z]/", $pass) || 
        !preg_match("/[0-9]/", $pass))
        $error = $error . "Passwords require 1 each of a-z, A-Z and 0-9<br />";
    if (!((strpos($email, ".") > 0) && (strpos($email, "@") > 0)) ||
        preg_match("/[^a-zA-Z0-9.@_-]/", $email)) 
        $error = $error . "The Email address is invalid<br />";
    if (($pass != $pass2) && !(strlen($pass) < 6) && !(!preg_match("/[a-z]/", $pass) || !preg_match("/[A-Z]/", $pass) || 
        !preg_match("/[0-9]/", $pass)))
        $error = $error . "Passwords do not match.<br />";
    if ($error == "") 
    {
        $salt1 = 'fy%^$';
        $salt2 = ')(#@fs&';
        $pass = sha1("$salt1$pass$salt2");
        if (mysql_num_rows(queryMysql("SELECT * FROM user WHERE username='$user'")))
            $error = "That username already exists<br /><br />"; 
        else
        {
            queryMysql("INSERT INTO user(username, password, email, firstname, lastname, phonenumber) 
                VALUES('$user', '$pass', '$email', '$firstname', '$lastname', '$phonenumber')"); 
            queryMysql("INSERT INTO address(username, addressa, addressb, city, state, zip) 
                VALUES('$user', '$address1', '$address2', '$city', '$state', '$zip')");
            die("<h4>Account created</h4>Please Log in.<br /><br />");
        } 
    }
}
echo <<<_END
<form method='post' action='signup.php'>$error
<span class='fieldname'>First Name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<input type='text' name='firstname' value='$firstname' />
<span class='fieldname'>Last Name&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<input type='text' name='lastname' value='$lastname' /><br />
<span class='fieldname'>Address Line 1</span>
<input type='text' name='address1' value='$address1' />
<span class='fieldname'>Address Line 2</span>
<input type='text' name='address2' value='$address2' />(Optional)<br />
<span class='fieldname'>City&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<input type='text' name='city' value='$city' />
<span class='fieldname'>State&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<input type='text' name='state' value='$state' /><br />
<span class='fieldname'>Zip&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<input type='text' name='zip' value='$zip' /><br />
<span class='fieldname'>Username&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<input type='text' name='user' value='$user'
    onBlur='checkUser(this)'/><span id='info'></span><br />
<span class='fieldname'>Password&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<input type='password' name='pass' onBlur='checkPass(this)'/>
<span class='fieldname'>Confirm Password</span>
<input type='password' name='pass2' onBlur='comparePass(this)'/><span id='passinfo'></span><br /> 
<span class='fieldname'>E-mail Address</span>
<input type='text' name='email' value='$email'/>
<span class='fieldname'>Phone Number&nbsp&nbsp&nbsp&nbsp&nbsp</span>
<input type='text' name='phonenumber' value='$phonenumber' /><br />
_END;
?>

<span class='fieldname'>&nbsp;</span> 
<input type='submit' value='Sign up' /> 
</form></div><br /></body></html>