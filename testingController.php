<?php
include('controller.php');
$items=$_POST['itemCount'];
$monthNow=date("m");
$dayNow=date("d");
$yearNow=date("Y");
$dateNow="$yearNow-$monthNow-$dayNow";
$ctrl=new QuoteController();
$date=getDate();
$email=$_POST['email'];
$sa_id=$_POST['sa_id'];
$notes=$_POST['notes'];
$cx_name=$_POST['name'];
$c_idList=$ctrl->selectCustomer($cx_name);
$c_id = $c_idList[0]['id'];
$quote_id=$ctrl->createQuote($dateNow,$sa_id, $c_id, $notes, $email);
$total=0;
for($i=1;$i<=$items;$i++){
    $desc="itemDesc"."$i";
    $prc="itemPrice"."$i";
    $itemDesc=$_POST[$desc];
    $itemPrice=$_POST[$prc];
    $total+=$itemPrice;
    $ctrl->addLineItems($quote_id, $itemDesc, $itemPrice);
}
$ctrl->updateTotal($quote_id, $total);
echo'<h3>Quote '.$quote_id.'  is Created</h3>';
echo'<h3><a href="createQuote.php?san=$name&id=$sa_id"">Click here to create a Quote</a></h3>';
?>