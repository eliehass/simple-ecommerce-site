<?php
session_start();
echo <<<_END
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head><script src='OSC.js'></script>
_END;
include 'functions.php';

$userstr = ' (Guest)';

if (isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
    $userloggedin = TRUE;
    $userstr = " ($user)";
}
else $userloggedin = FALSE;
if (isset($_SESSION['provider']))
{
    $user = $_SESSION['provider'];
    $providerloggedin = TRUE;
    $providerstr = " ($user)";
}
else $providerloggedin = FALSE;
if ($userloggedin)
{
    echo "<title>$appname$userstr</title><link rel='stylesheet' type='text/css' href='style/master.css' />" .
        "</head><body><div id='wrapper'>" .
        "<div id='header'><h1>$appname$userstr</h1>" . 
        "<form id='search' action='search.php' method='POST'>
            Search Services
            <input id='searchTerm' name='searchTerm' size='28'>
            <select name='categories'>
                <option value='beauty'>beauty</option>
                <option value='creative'>creative</option>
                <option value='computer'>computer</option>
                <option value='cycle'>cycle</option>
                <option value='event'>event</option>
                <option value='financial'>financial</option>
                <option value='legal'>legal</option>
                <option value='lessons'>lessons</option>
                <option value='marine'>marine</option>
                <option value='pet'>pet</option>
                <option value='automotive'>automotive</option>
                <option value='farm+garden'>farm+garden</option>
                <option value='household'>household</option>
                <option value='laber/move'>labor/move</option>
                <option value='skill'd trade'>skill'd trade</option>
                <option value='real estate'>real estate</option>
                <option value='sm biz ads'>sm biz ads</option>
                <option value='therapeutic'>therapeutic</option>
                <option value='travel/vac'>travel/vac</option>
                <option value='qrite/ed/tr8'>write/ed/tr8</option>
            </select>
            <input id='Search!' type='submit' value='Search!'>
            </form>";

    echo "<ul id='nav'>" .
        "<li><a href='logout.php'>Log out</a></li></ul><br />" .
        "</div>";
}
elseif ($providerloggedin)
{
    echo "<title>$appname$userstr</title><link rel='stylesheet' type='text/css' href='style/master.css' />" .
        "</head><body><div id='wrapper'>" .
        "<div id='header'><h1>$appname$userstr</h1>" . 
        "<form id='search' action='search.php' method='POST'>
            Search Services
            <input id='searchTerm' name='searchTerm' size='28'>
            <select name='categories'>
                <option value='beauty'>beauty</option>
                <option value='creative'>creative</option>
                <option value='computer'>computer</option>
                <option value='cycle'>cycle</option>
                <option value='event'>event</option>
                <option value='financial'>financial</option>
                <option value='legal'>legal</option>
                <option value='lessons'>lessons</option>
                <option value='marine'>marine</option>
                <option value='pet'>pet</option>
                <option value='automotive'>automotive</option>
                <option value='farm+garden'>farm+garden</option>
                <option value='household'>household</option>
                <option value='laber/move'>labor/move</option>
                <option value='skill'd trade'>skill'd trade</option>
                <option value='real estate'>real estate</option>
                <option value='sm biz ads'>sm biz ads</option>
                <option value='therapeutic'>therapeutic</option>
                <option value='travel/vac'>travel/vac</option>
                <option value='qrite/ed/tr8'>write/ed/tr8</option>
            </select>
            <input id='Search!' type='submit' value='Search!'>
            </form>";

    echo "<ul id='nav'>" .
        "<li><a href='postservice.php'>Post a service</a></li>" .
        "<li><a href='logout.php'>Log out</a></li></ul><br />" .
        "</div>";
}
else
{
    echo "<title>$appname$userstr</title><link rel='stylesheet' type='text/css' href='style/master.css' />" .
        "</head><body><div id='wrapper'>" .
        "<div id='header'><h1>$appname$userstr</h1>" . 
        "<form id='search' action='search.php' method='POST'>
            Search Services
            <input id='searchTerm' name='searchTerm' size='28'>
            <select name='categories'>
                <option value='beauty'>beauty</option>
                <option value='creative'>creative</option>
                <option value='computer'>computer</option>
                <option value='cycle'>cycle</option>
                <option value='event'>event</option>
                <option value='financial'>financial</option>
                <option value='legal'>legal</option>
                <option value='lessons'>lessons</option>
                <option value='marine'>marine</option>
                <option value='pet'>pet</option>
                <option value='automotive'>automotive</option>
                <option value='farm+garden'>farm+garden</option>
                <option value='household'>household</option>
                <option value='laber/move'>labor/move</option>
                <option value='skill'd trade'>skill'd trade</option>
                <option value='real estate'>real estate</option>
                <option value='sm biz ads'>sm biz ads</option>
                <option value='therapeutic'>therapeutic</option>
                <option value='travel/vac'>travel/vac</option>
                <option value='qrite/ed/tr8'>write/ed/tr8</option>
            </select>
            <input id='Search!' type='submit' value='Search!'>
            </form>" ;

    echo "<ul id='nav'>" .
        "<li><a href='signup.php'>Create account</a></li>" .
        "<li><a href='providersignup.php'>Create provider account</a></li>" .
        "<li><a href='login.php'>User Log in</a></li>" .
        "<li><a href='providerlogin.php'>Provider Log in</a></li></ul><br />";
}
