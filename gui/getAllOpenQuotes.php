
<div class="header"></div>
<html>
<strong><font size="12">Select an Open Quote to Proceed<br/></font></strong>
<br/><br/>

<?php
error_reporting(E_ALL & ~E_NOTICE);

    $quotelist = $_SESSION['quotecontroller']->showPendingQuotes();
    print "<strong><font size='12'>Open Quotes<br/></font></strong><br/><br/>";
    print "<style>table, th, td {border: 1px solid black; border-collapse: collapse;}</style>";

    print "<table style='width:100%'><tr><th>Select</th><th>CUST ID</th><th>CUST NAME</th><th>CUST CITY</th><th>CUST STREET</th><th>CUST EMAIL</th><th>STATUS</th><th>QUOTE DATE</th><th>SALESASSOC ID</th><th>SECRET NOTES</th><th>DISCOUNT</th><th>QUOTE ID</th><th>PROCESSING DATE</th><th>SALESASSOC COMMISSION</th><th>TOTAL PRICE</th></tr>";
    foreach ($quotelist as $quote){
        print "<tr><td><form method=POST action=index.php?page=retrieveOpenQuote>";
        print "<button name='quote_id' value='" . $quote->quote_id . "'>Select</button></form></td>";
        print "<td>&nbsp;" . $quote->cust_id . "</td>";
        print "<td>&nbsp;" . $quote->cust_name . "</td>";
        print "<td>&nbsp;" . $quote->cust_city . "</td>";
        print "<td>&nbsp;" . $quote->cust_street . "</td>";
        print "<td>&nbsp;" . $quote->cust_email . "</td>";
        print "<td>&nbsp;" . $quote->status . "</td>";
        print "<td>&nbsp;" . $quote->quote_date . "</td>";
        print "<td>&nbsp;" . $quote->sales_Associate_id . "</td>";
        print "<td>&nbsp;" . $quote->secret_notes . "</td>";
        print "<td>&nbsp;" . $quote->discount . "</td>";
        print "<td>&nbsp;" . $quote->quote_id . "</td>";
        print "<td>&nbsp;" . $quote->processingDate . "</td>";
        print "<td>&nbsp;" . $quote->associateCommission . "</td>";
        print "<td>&nbsp;" . $quote->total_price . "</td></tr>";
    }
    print "</table>";

error_reporting(E_ALL);

print "<br/><br/><a href='http://students.cs.niu.edu/~z136652/index.php'>Go to Home Page</a>";
?>
</html>
