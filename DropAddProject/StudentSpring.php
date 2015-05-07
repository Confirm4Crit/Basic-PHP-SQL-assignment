<?php
$STUDENT=$_GET['STUDENT_id'];
$query="select DISTINCT s.SCHEDULE_ID, c.COURSE_ID,s.SECTION,c.COURSE_NAME,i.LAST_NAME,i.FIRST_NAME, s.ROOM 
from course c,instructor i, schedule s, student st, transcript t
where c.COURSE_ID = s.COURSE_ID
and s.SCHEDULE_ID = t.SCHEDULE_ID
and st.STUDENT_ID = t.STUDENT_ID
and s.INSTRUCTOR_ID = i.INSTRUCTOR_ID
and s.SEMESTER = 'SPRING2015'
and st.STUDENT_ID = '$STUDENT'";

$query2 ="SELECT  DISTINCT s.SCHEDULE_ID, c.COURSE_ID,s.SECTION,c.COURSE_NAME,i.LAST_NAME,i.FIRST_NAME, s.ROOM
from course c,instructor i, schedule s, student st, transcript t
where c.COURSE_ID = s.COURSE_ID
and s.INSTRUCTOR_ID = i.INSTRUCTOR_ID
and s.SEMESTER = 'SPRING2015'
MINUS
SELECT  s.SCHEDULE_ID, c.COURSE_ID,s.SECTION,c.COURSE_NAME,i.LAST_NAME,i.FIRST_NAME, s.ROOM
from course c,instructor i, schedule s, student st, transcript t
where c.COURSE_ID = s.COURSE_ID
and s.SCHEDULE_ID = t.SCHEDULE_ID
and st.STUDENT_ID = t.STUDENT_ID
and s.INSTRUCTOR_ID = i.INSTRUCTOR_ID
and s.SEMESTER = 'SPRING2015'
and st.STUDENT_ID = '$STUDENT'";
// Create connection to Oracle
$conn = oci_connect("mrobson3", "fau5096", "dboracle.eng.fau.edu/r11g");
$stid = oci_parse($conn, $query);
$stid2 = oci_parse($conn, $query2);
oci_execute($stid);
oci_execute($stid2);

if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}

?>


<HTML>
<BODY>
<P><H1>SPRING 2015 OUTLOOK FOR <? echo $STUDENT ?>  </H1></P>

<H2>Classes currently enrolled: </H2>
<TABLE border="1">
  <TR>
    <TD>COURSE_ID</TD><TD>SECTION</TD><TD>COURSE_NAME</TD><TD>LAST_NAME</TD><TD>FIRST_NAME</TD><TD>ROOM</TD>
  </TR>
  <?while ($rs = oci_fetch_array($stid, OCI_ASSOC))
{?>
<TR>
  
  <TD><? echo $rs["COURSE_ID"] ?></TD>
  <TD><? echo $rs["SECTION"] ?></TD>
  <TD><? echo $rs["COURSE_NAME"] ?></TD>
  <TD><? echo $rs["LAST_NAME"] ?></TD>
 <TD><? echo $rs["FIRST_NAME"] ?></TD>
 <TD><? echo $rs["ROOM"] ?></TD>
<TD> <FORM ACTION="http://lamp.cse.fau.edu/~mrobson3/StudentSpringRemove.php" method="get">
 <input type="hidden" name ="remove" value=<? echo $rs["SCHEDULE_ID"]?>>
		<input type="hidden" name="student_id" value=<? echo $STUDENT ?> />
		<input type="submit"  value="Remove">
 </FORM></TD>
 
<? } ?>
</TABLE>
<H2>Classes currently available: </H2>
<TABLE border="1">
  <TR>
    <TD>COURSE_ID</TD><TD>SECTION</TD><TD>COURSE_NAME</TD><TD>LAST_NAME</TD><TD>FIRST_NAME</TD><TD>ROOM</TD>
  </TR>
  <?while ($rs = oci_fetch_array($stid2, OCI_ASSOC))
{?>
<TR>
	
  <TD><? echo $rs["COURSE_ID"] ?></TD>
  <TD><? echo $rs["SECTION"] ?></TD>
  <TD><? echo $rs["COURSE_NAME"] ?></TD>
  <TD><? echo $rs["LAST_NAME"] ?></TD>
 <TD><? echo $rs["FIRST_NAME"] ?></TD>
 <TD><? echo $rs["ROOM"] ?></TD>
<TD> <FORM ACTION="http://lamp.cse.fau.edu/~mrobson3/StudentSpringAdd.php" method="get">
 <input type="hidden" name ="add" value=<? echo $rs["SCHEDULE_ID"]?>>
		<input type="hidden" name="student_id" value=<? echo $STUDENT ?> />
		<input type="submit"  value="Add">
 </FORM></TD>
 
<? } ?>
</TABLE>


<P>
  <A href="http://lamp.cse.fau.edu/~mrobson3/StudentSpringForm.html"> Press Here For Another Roster 
  </A>
  </p>
</BODY>
</HTML>
