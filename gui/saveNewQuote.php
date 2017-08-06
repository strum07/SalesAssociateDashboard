
<div class="header"></div>

<br/><br/>

<?php
$quote = new Quote($_POST);
$quote->quote_date = date("Y-m-d");
$quote->status = 'O';

echo "Printing out Quote Details:";
echo "<br>";
echo $quote->cust_id;
echo "<br>";
echo $quote->cust_name;
echo "<br>";
echo $quote->cust_city;
echo "<br>";
echo $quote->cust_street;
echo "<br>";
echo $quote->sales_Associate_id;
echo "<br>";
echo $quote->discount;
echo "<br>";
echo $quote->secret_notes;
echo "<br>";
echo $quote->cust_id;
echo "<br>";
echo $quote->quote_date;
echo "<br>";
echo $quote->status;
echo "<br>";

/*if($quote->quote_id===NULL){
  echo "Its NULL";
}
else
{
    echo $quote->quote_id;
}*/



    print $_SESSION['quotecontroller']->saveQuoteRecordNewQuote($quote);
    echo "<br>";
    echo $quote->quote_id;
    echo "<br>";
    printf ("New Record has id %d.\n", $mysqli->insert_id);



print "<form method=POST action=index.php?page=addLineItems>";
print "<button name='quote_id' value='" . $quote->quote_id . "'>Save and Continue to Add Line Items</button>";
print"</p></form>";


?>

