<div class="header"></div>

<br/><br/>


<?php

        $custList = $_SESSION['quotecontroller']->getCustomerInfo($_POST['id']);
        $quote = new Quote($_POST);
        $lineitem = new LineItem($_POST);
        $quote->cust_name = $custList->name;
        $quote->cust_id = $custList->id;
        $quote->cust_city = $custList->city;
        $quote->cust_street = $custList->street;








        print "<form method=POST action=index.php?page=saveNewQuote>";

        print "<table>";

        print "<tr><td>Customer ID </td><td><input type=number name=cust_id value='" . $quote->cust_id . "'></td></tr>";
        print "<tr><td>Customer Name </td><td><input type=text name=cust_name value='" . $quote->cust_name . "'></td></tr>";
        print "<tr><td>Street </td><td><input type=text name=cust_street value='" . $quote->cust_street . "'></td></tr>";
        print "<tr><td>City </td><td><input type=text name=cust_city value='" . $quote->cust_city . "'></td></tr>";
        print "<tr><td>Sales Associate ID: </td><td><input type=number name=sales_Associate_id value='" . $quote->sales_Associate_id . "'></td></tr>";
        print "<tr><td>Discount: </td><td><input type=number name=discount value='" . $quote->discount . "'></td></tr>";
        print "<tr><td>Email: </td><td><input type=email name=email value='" . $quote->cust_email . "'></td></tr>";
        print "<tr><td>Secret Notes: </td><td><textarea name=secret_notes cols=\"40\" rows=\"5\" value='" . $quote->secret_notes . "'></textarea></td></tr>";



        //LineItems



        print "</table><p>";
        print "<button>Save Quote as OPEN</button>";
        print"</p></form>";

?>