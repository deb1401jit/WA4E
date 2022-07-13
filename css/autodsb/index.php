<!DOCTYPE html>
<?php
require_once("../assn_util.php");
$json = loadPeer("peer.json");
?>
<html>
<head>
<title>Assignment: <?= $json->title ?></title>
<style>
li { padding: 5px; }
pre {padding-left: 2em;}
</style>
</head>
<body style="margin-left:5%; margin-bottom: 60px; margin-right: 5%; font-family: sans-serif;">
<h1>Assignment: <?= $json->title ?></h1>
<p>
<?= $json->description ?>
</p>
<a href="01-Autos.png" target="_blank">
<img style="margin-left: 10px; margin-bottom: 10px; float:right;" 
alt="Image of the auto management application"
width="300px" src="01-Autos.png" border="2"/>
</a>
<?php if ( isset($json->solution) ) { ?>
<h2>Sample solution</h2>
<p>
You can explore a sample solution for this problem at
<pre>
<a href="<?= $json->solution ?>" target="_blank"><?= $json->solution ?></a>
</pre>
<?php } ?>
<h1>Resources</h1>
<p>There are several resources you might find useful:
<ul>
<li>Recorded lectures, sample code and chapters from 
<a href="http://www.wa4e.com" target="_blank">www.wa4e.com</a>:
<ul>
<li class="toplevel">
Review the SQL language
</li>
<li class="toplevel">
Using PDO in PHP
</li>
</li>
</ul>
</li>
<li>Documentation on 
<a href="https://en.wikipedia.org/wiki/Code_injection#HTML_script_injection" target="_new">HTML Injection</a>
</li>
<li>Documentation from www.php.net on how to use 
<a href="http://php.net/manual/en/book.pdo.php"
target="_blank">PDO</a> to connect to a database.
</li>
<li>Documentation on 
<a href="https://en.wikipedia.org/wiki/SQL_injection" target="_new">SQL Injection</a>
</li>
<li>Documentation on 
<a href="http://php.net/manual/en/pdo.prepare.php" target="_new">PHP PDO Prepared Statements</a>
</li>
<li>
You can look through the sample code from the lecture. It has examples
of using PDO to communicate with a database:
<pre>
<a href="http://www.wa4e.com/code/pdo.zip" target="_blank">http://www.wa4e.com/code/pdo.zip</a>
</pre>
<p>
Note that this is not precisely sample code for <em>this</em> assignment.  You should
adapt your login code from the 
<a href="../rps">Rock Paper Scissors</a> assignment using elements from the sample code above.
</p>
</li>
</ul>
</p>
<h2 clear="all">General Specifications</h2>
<p>
Here are some general specifications for this assignment:
<ul>
<li>
You <b>must</b> use the PHP PDO database layer for this assignment.  If you use the 
"mysql_" library routines or "mysqli" routines to access the database, you will
<b>receive a zero on this assignment</b>.
<li>
Your name must be in the title tag of the HTML for all of the pages
for this assignment.
</li>
<li>
Your program must be resistant to HTML Injection attempts.
All data that comes from the users must be properly escaped
using the <b>htmlentities()</b> function in PHP.  You do not 
need to escape text that is generated by your program.
</li>
<li>
Your program must be resistant to SQL Injection attempts. 
This means that you should never concatenate user provided data 
with SQL to produce a query.  You should always use a PDO prepared statement.
<li>
Please do not use HTML5 in-browser data 
validation (i.e. type="number") for the fields 
in this assignment as we want to make sure you can properly do server 
side data validation.  And in general, even when you do client-side
data validation, you should still validate data on the server in case
the user is using a non-HTML5 browser.
</li>
</ul>
<h2 clear="all">Databases and Tables Required for the Assignment</h2>
<p>
You already should have a PHP hosting environment such as MAMP or XAMPP
installed or have some other access to a MySQL client to run commands.
</p>
<p>
You will need to create a database, a user to connect to the database 
and a password for that user using commands similar to the following:
<pre>
create database misc;

GRANT ALL ON misc.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON misc.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';
</pre>
You will need to make a connection to that database in a file 
like this if you are using MAMP (Macintosh):
<pre>
&lt;?php
$pdo = new PDO('mysql:host=localhost;port=8889;dbname=misc', 'fred', 'zap');
$pdo-&gt;setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
</pre>
If you are using XAMPP or Linux you should change the port to 3306:
<pre>
&lt;?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 'fred', 'zap');
$pdo-&gt;setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
</pre>
Usually this file is named <code>pdo.php</code> and is included in each of the files
that want to use the database.  You will need to change the user name and
password on both your GRANT statements and in the code that makes the 
PDO connection.
</p>
<p>
You will also need to create and configure a table in the 
new "misc" database using the following SQL commands:
<pre>
CREATE TABLE autos (
   auto_id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
   make VARCHAR(128),
   year INTEGER,
   mileage INTEGER
);
</pre>
</p>
<h1>Specifications</h1>
<a href="01-Autos.png" target="_blank">
<img style="margin-left: 10px; float:right;" 
alt="Image of the login screen"
width="300px" src="01-Autos.png" border="2"/>
</a>
<p>
The changes to <b>index.php</b> are new wording and pointing to 
<b>autos.php</b> to test for login bypass.
</p>
<br clear="all">
<h2>Specifications for the Login Screen</h2>
<a href="02-Login.png" target="_blank">
<img style="margin-left: 10px; float:right;" 
alt="Image of the login screen"
width="300px" src="02-Login.png" border="2"/>
</a>
<p>
Much of the <b>login.php</b> is reused and extended from the previous assignment.
The salt and hash computation and most of the error checking comes across unchanged.
The password continues to be 'php123'.
</p>
<p>
The login screen needs to have some error checking on its input
data.  If either the name or the password field is blank, you should 
display a message of the form:
<pre style="color:red">
Email and password are required
</pre>
Note that we are using "email" and not "user name" to log in in this assignment.
</p>
<p>
If the password is non-blank and incorrect, you should put up a message
of the form:
<pre style="color:red">
Incorrect password
</pre>
</p>
For this assignment, you must add one new validation to make sure that the login 
name contains an at-sign (@) and issue an error in that case:
<pre style="color:red">
Email must have an at-sign (@)
</pre>
</p>
<p>
If the incoming password, properly hashed matches the stored stored_hash
value, the user's browser is
<a href="http://en.wikipedia.org/wiki/URL_redirection#Using_server-side_scripting_for_redirection"
 target="_blank">redirected</a>
to the <b>autos.php</b> page with the user's name as a GET parameter using:
<pre>
header("Location: autos.php?name=".urlencode($_POST['who']));
</pre>
</p>
<p>
You must also use the <b>error_log()</b> function to issue the following message
when the user fails login due to a bad password showing the computed hash of the password
plus the salt:
<pre>
error_log("Login fail ".$_POST['who']." $check");
</pre>
When the login succeeds (i.e. the hash matches) issue the following log message:
<pre>
error_log("Login success ".$_POST['who']);
</pre>
Make sure to find your error log and find those error messages as they come out:
<pre>
[11-Feb-2016 15:52:03 Europe/Berlin] Login success csev@autos.com
[11-Feb-2016 15:52:13 Europe/Berlin] Login fail csev@autos.com 047398bd0e0171f4954760f5f542121a
</pre>
<h2>Specifications for the Auto Database Screen</h2>
<p>
In order to protect the database from being modified without the user properly
logging in, the <b>autos.php</b> must first check the $_GET variable to see
if the user's name is set and if the user's name is not present,
the autos.php must stop immediately using the PHP die() function:
<pre>
die("Name parameter missing");
</pre>
To test, navigate to <b>autos.php</b> manually without logging in - it 
should fail with "Name parameter missing".
</p>
<a href="03-Autos-Empty.png" target="_blank">
<img style="margin-left: 10px; margin-bottom: 10px; float:right;" 
alt="Image of the auto management application"
width="300px" src="03-Autos-Empty.png" border="2"/>
</a>
<p>
If the user is logged in, they should be presented with a screen that allows
them to append a new make, mileage and year for an automobile.  The list 
of all automobiles entered will be shown below the form.  If there are no 
automobiles in the database, none need be shown.
</p>
<p>
If the <b>Logout</b> button is pressed the user should be redirected back to the 
<b>index.php</b> page using:
<pre>
header('Location: index.php');
</pre>
<p>
When the "Add" button is pressed, you  need to do some 
input validation. 
</p>
<p>
The mileage and year need to be integers.
If is suggested that you use the PHP function <b>is_numeric()</b>
to determine if the $_POST data is numeric.  If either field
is not nummeric, you must put up the following message:
<pre style="color:red">
Mileage and year must be numeric
</pre>
Also if the make is empty (i.e. it has less than 1 character in the 
string) you need to put out a message as follows:
<pre style="color:red">
Make is required
</pre>
</p>
<p>
Note that only one of the error messages need to come out regardless of 
how many errors the user makes in their input data.  Once you detect one
error in the input data, you can stop checking for further errors.
</p>
<p>
If the user has pressed the "Add" button and the data passes validation,
you can add the automobile to the database using an <b>INSERT</b> statement.
<pre>
...
    $stmt = $pdo-&gt;prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
    $stmt-&gt;execute(array(
        ':mk' =&gt; $_POST['make'],
        ':yr' =&gt; $_POST['year'],
        ':mi' =&gt; $_POST['mileage'])
    );
...
</pre>
When you successfully add data to your database, you need to put out
a green "success message:
<pre style="color:green">
Record inserted
</pre>
</p>
<p>
Once there are records in the database they should be shown below the 
form to add a new entry.
<center>
<a href="04-Add-Success.png" target="_blank">
<img 
alt="Image of the auto management application"
width="300px" src="04-Add-Success.png" border="2"/>
</a>
</center>
</p>
<h1>What To Hand In</h1>
<p>
For this assignment you will hand in:
<ol>
<?php
foreach($json->parts as $part ) {
    echo("<li>$part->title</li>\n");
}
?>
</ol>
</p>
<h2>Grading</h2>
<p>
<?= $json->grading ?>
</p>
<p>
<?= pointsDetail($json) ?>
</p>
<h1><em>Optional</em> Challenges</h1>
<p>
<b>This section is entirely <em>optional</em> and is here in case you want to 
explore a bit more deeply and test your code skillz.</b></p>
<p>
Here are some possible improvements:
<ul>
<li>
Always show the automobiles sorted by make regardless of the order
they were entered into the application.  Hint: use "ORDER BY".
</li>
<li>
Add an optional URL field to your tables and user interface.  
Validate the URL to make sure it starts with 
"http://" or "https://".  If the user enters
a URL, in the list of autos, have the make be a clickable
anchor tag that opens the image in a new window:
<pre>
&lt;a href="http://....jpg" target="_blank"&gt;Ford&lt;/a&gt;
</pre>
</li>
<li>
Medium Difficulty: Use the PHP cURL library to do a GET to the 
image URL from within PHP and if the URL does not exist, 
issue an error message to the user and do not add the
automobile.
</li>
</ul>
</p>
<h2>Sample Database Screen Shots</h2>
<p>
The data in your screen shot(s) should not be the same as 
these examples.
<p>
<center>
<img alt="Image of the autos table" style="width: 95%"
src="05-Auto-Table.png" border="2"/>
</center>
</p>
<p>
Provided by: <a href="http://www.wa4e.com/" target="_blank">
www.wa4e.com</a> <br/>
</p>
<center>
Copyright Creative Commons Attribution 3.0 - Charles R. Severance
</center>
</body>
</html>