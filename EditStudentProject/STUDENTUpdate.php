<?php
$STUDENT=$_GET['STUDENT_id'];
$last = $_GET['last'];
$first = $_GET['first'];
$gender = $_GET['gender'];
$birth_date = $_GET['birthDate'];
$city = $_GET['city'];
$query="UPDATE STUDENT SET LAST_NAME='$last', FIRST_NAME='$first', GENDER='$gender', BIRTH_DATE='$birth_date',CITY = '$city' WHERE STUDENT_ID='$STUDENT'";
// Create connection to Oracle
print $query;
$conn = oci_connect("mrobson3", "fau5096", "dboracle.eng.fau.edu/r11g");
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
$stid = oci_parse($conn, $query);
$count = oci_execute($stid);
?>
<HTML>
<BODY>
<?
if ($count==0)
{
	echo "<p><h1>Update for STUDENT NOT SUCCESSFUL</h1></p>";
}
else
{
	echo "<p><h1>Update for STUDENT SUCCESSFUL</h1></p>";
}
?>

<P>
  <A href="http://lamp.cse.fau.edu/~mrobson3/UpdateForm.html"> Press Here to Start Another Update 
  </A>
  </p>
  </BODY>
  </HTML>
  