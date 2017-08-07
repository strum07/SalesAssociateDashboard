<?php
/**********************************************
CSCI 467/567 Project
Use Case Implementation
Professor: Dr Raimund Ege
Teaching Assistant: Neha Sunil Manghnani
Group: Graduate 2 (G2)
Contributors:	Eric Davis, z136652
Saga Sudhakar, z1783546
David Williams, z086126
 ***********************************************/


include 'SalesAssociateStore.php';
include 'QuoteStore.php';
include 'LegacyDBInterface.php';

class RecordQuote{

    var $saStore;
    var $quoteStore;
    var $ldb;


    function __construct(){
        $this->saStore = new SalesAssociateStore ();
        $this->quoteStore = new QuoteStore ();
        $this->ldb = new LegacyDBInterface ();
    }

    function confirm_query($result_set) {
        if (!$result_set) {
            die("Database query failed.");
        }
    }

    public function getAssociate($associate_id){
        return $this->saStore->getAssociate($associate_id);
    }

    public function retrieveCustomers($name){
        return $this->ldb->retrieveCustomers($name);
    }

    public function getCustomerInfo($id){
        return $this->ldb->getCustomerInfo($id);
    }

    public function showPendingQuotes(){
        return $this->quoteStore->searchQuoteSTATUS('O');
    }

    public function confirmEmail($quote){
        return $this->quoteStore->updateEmail($quote);
    }

    public function confirmFinalize($quote){
        return $this->quoteStore->finalizeStatus($quote);
    }

    public function saveQuoteRecordNewQuote($quote){
        return $this->quoteStore->saveQuoteRecordNewQuote ($quote);
    }

    public function getQuote ($quote_id){
        return $this->quoteStore->getQuote ($quote_id);
    }

    public function lineitemsave($line){
        return $this->ldb->updateLineItem($line);
    }
}


?>
