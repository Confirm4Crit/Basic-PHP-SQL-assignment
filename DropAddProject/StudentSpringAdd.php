<?php
$ADD=$_GET['add'];
$STUDENT = $_GET['student_id'];

$query="INSERT INTO TRANSCRIPT (SCHEDULE_ID,STUDENT_ID) VALUES ('$ADD','$STUDENT')";
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
	echo "<p><h1>Update for STUDENT SPRING SCHEDULE  NOT SUCCESSFUL</h1></p>";
}
else
{
	echo "<p><h1>Update for STUDENT SPRING SCHEDULE SUCCESSFUL</h1></p>";
}
?>

<P>
  <A href="http://lamp.cse.fau.edu/~mrobson3/StudentSpringForm.html"> Press Here to Start Another Update 
  </A>
  </p>
  </BODY>
  </HTML>
  