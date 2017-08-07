
<div class="header"></div>
<html>
<strong><font size="12">Validate Credentials<br/></font></strong>
<br/><br/>

<?php
$sa = $_SESSION['quotecontroller']->getAssociate($_POST['associate_id']);
if ($sa->password == $_POST['password'] )
		{header("http://students.cs.niu.edu/~z1783546/SalesAssociateDashboard/"); exit;}
	else {
    header("http://students.cs.niu.edu/~z1783546/SalesAssociateDashboard/gui/confirmEmail.php"); exit;}

?>
</html>
