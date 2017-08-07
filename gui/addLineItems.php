<div class="header"></div>
<strong><font size="12">Add Line Items<br/></font></strong>
<br/><br/>

print "<form method=POST action=index.php?page=saveLineItems>";
    print "<input type=hidden name=quote_id value='".$_POST['quote_id']."'>";
    print "<table>";
        print "<tr><td>Quote ID: '".$_POST['quote_id']."'</td></tr>";
        print "<tr><td>Item Description: </td><td><input type=text name=item_description></td></tr>";
        print "<tr><td>Item Price: </td><td><input type=text name=item_price></td></tr>";
        print "</table><p>";
        print "<button>Add</button>";
        print "</p></form>";

<?php

?>
