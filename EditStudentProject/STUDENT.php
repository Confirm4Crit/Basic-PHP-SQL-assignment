<?php
$STUDENT=$_GET['STUDENT_id'];
$query="SELECT LAST_NAME, FIRST_NAME, GENDER,BIRTH_DATE, CITY FROM STUDENT WHERE STUDENT_ID =  '$STUDENT'";
// Create connection to Oracle
$conn = oci_connect("mrobson3", "fau5096", "dboracle.eng.fau.edu/r11g");
$stid = oci_parse($conn, $query);
oci_execute($stid);
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}

?>
<HTML>
<BODY>
<P><H1>UPDATE STUDENT INFORMATION FOR STUDENT ID: <? echo $STUDENT ?> </H1></P>
<FORM ACTION = "http://lamp.cse.fau.edu/~mrobson3/STUDENTUpdate.php" method="get">

<? $rs = oci_fetch_array($stid, OCI_ASSOC); 
if (!$rs) 
{echo "<P><H1>STUDENT " . $STUDENT . " Not Found</H1></P>";
 echo '<P><A href="http://lamp.cse.fau.edu/~mrobson3/UpdateForm.html"> Press Here to Start Another Update </A></p>';
 exit;
}
?>

	<p>
		Last Name: <input type="text" name="last" size="30" value="<? echo $rs["LAST_NAME"];?>" />
	</p>
		<p>
		First Name: <input type="text" name="first" size="30" value="<? echo $rs["FIRST_NAME"];?>" />
	</p>
	<p>
		Gender: <input type="text" name="gender" size="20" value="<? echo $rs["GENDER"];?>" />
	</p>
	<p>
		BirthDate: <input type="text" name="birthDate" size="20" value="<? echo $rs["BIRTH_DATE"];?>" />
	</p>
	<p>
		City: <input type="text" name="city" size="20" value="<? echo $rs["CITY"];?>" />
	</p>
	
	<p>
		<input type="hidden" name="STUDENT_id" size="10" value="<? echo $STUDENT;?>" />
	</p>

	
	<p>
		<input type="submit" value="Push To Update" />
	</p>
 

<P>
  <A href="http://lamp.cse.fau.edu/~mrobson3/UpdateForm.html"> Press Here to Start Another Update 
  </A>
  </p>
  </FORM>
</BODY>
</HTML>
<?oci_close($conn);?>