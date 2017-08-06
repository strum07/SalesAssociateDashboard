<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sample PHP implementation of Manage Employee Data use case.">
    <title>Use Case &ndash; Manage Employee Data &ndash; Pure</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="css/layouts/side-menu-old-ie.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="css/layouts/side-menu.css">
    <!--<![endif]-->
</head>

<?php
ini_set('display_errors', 'On');

$logText = "";
$debug = true;

function trace($text) {
    global $logText;
    $logText .= $text . '<br>';
}

trace("PHP version: " . phpversion());



if(!isset($_SESSION['quotecontroller'])) {
    $_SESSION['quotecontroller'] = new RecordQuote;}

?>