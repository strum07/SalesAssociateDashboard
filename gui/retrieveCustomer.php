
<div class="header"></div>
<html>
<strong><font size="12">Select a Customer<br/></font></strong>
<br/><br/>

<?php
print "<style>table, th, td {border: 1px solid black; border-collapse: collapse;}</style>";
$custlist = $_SESSION['quotecontroller']->retrieveCustomers($_POST['search']);
print "<table style='width:100%'><tr><th>select</th><th>ID</th><th>Name</th><th>City</th><th>Street</th><th>Contact</th></tr>";
foreach ($custlist as $cust){
    print "<tr><td><form method=POST action=index.php?page=recordNewQuote>";
    print "<button name='id' value='" . $cust->id . "'>Select</button></form></td>";
    print "<td>&nbsp;" . $cust->id . "</td>";
    print "<td>&nbsp;" . $cust->name . "</td>";
    print "<td>&nbsp;" . $cust->city . "</td>";
    print "<td>&nbsp;" . $cust->street . "</td>";
    print "<td>&nbsp;" . $cust->contact . "</td></tr>";}
print "</table>";

?>
</html>
