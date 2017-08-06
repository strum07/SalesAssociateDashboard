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

class QuoteStore {

	function connect(){
		$servername = "us-cdbr-azure-central-a.cloudapp.net";
		$database = "quotedemo";
		$username = "b204da67c10953";
		$password = "b6bb60de";

		$conn = new mysqli($servername, $username, $password, $database);

		if($conn->connect_error)
			die ( "Connection failed: " . $conn->connect_error);

		$conn->set_charset ( "utf8");
		return $conn;
	}

	public function getQuote($quote_id){
        $conn = $this->connect();
        $sql = "SELECT * FROM quote WHERE quote_id = " . $quote_id . ";";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return new Quote ($row);
	}

	public function searchQuoteCUST($custname){
		$conn = $this->connect();
		$sql = "SELECT * FROM quote WHERE cust_name LIKE '%" . $custname . "%';";
		$result = $conn->query($sql);
		$quoteList = array ();

		if ($result->num_rows >0 ) {
			while ($row = $result->fetch_assoc() ) {
				$quoteList [$row ['quote_id']] = new Quote ( $row );}
		}
		return $quoteList;
	}

	public function searchQuoteSA($associateid){
		$conn = $this->connect();
		$sql = "SELECT * FROM quote WHERE sales_Associate_id LIKE '%" . $associateid . "%';";
		$result = $conn->query($sql);
		$quoteList = array ();

		if ($result->num_rows >0 ) {
			while ($row = $result->fetch_assoc() ) {
				$quoteList [$row ['quote_id']] = new Quote ( $row );}
		}
		return $quoteList;
	}

	public function searchQuoteDATE($begdate,$enddate){
		$conn = $this->connect();
		$sql = "SELECT * FROM quote WHERE quote_date BETWEEN '" . $begdate . "' AND '" .$enddate."';";
		$result = $conn->query($sql);
		$quoteList = array ();

		if ($result->num_rows >0 ) {
			while ($row = $result->fetch_assoc() ) {
				$quoteList [$row ['quote_id']] = new Quote ( $row );}
		}
		return $quoteList;
	}

    public function searchQuoteSTATUS($statusname){
        $conn = $this->connect();
        $sql = "SELECT * FROM quote WHERE status LIKE '%" . $statusname . "%';";
        $result = $conn->query($sql);
        $quoteList = array ();

        if ($result->num_rows >0 ) {
            while ($row = $result->fetch_assoc() ) {
                $quoteList [$row ['quote_id']] = new Quote ( $row );}
        }
        return $quoteList;
    }

	public function ClientByTotalInvoice(){
		$conn = $this->connect();
		$sql = "SELECT cust_name, SUM(total_price) AS TotalInvoice FROM quote GROUP BY cust_name ORDER BY TotalInvoice DESC;";
		$result = $conn->query($sql);
		return $result;				
	}

	public function AssociateYearlyPerformance(){
		$conn = $this->connect();
		$sql = "SELECT sales_Associate_id, SUM(total_price) AS TotalInvoice, COUNT(quote_id) AS TotalQuotes FROM quote GROUP BY sales_Associate_id ORDER BY TotalInvoice DESC, TotalQuotes DESC;";
		$result = $conn->query($sql);
		return $result;

				
	}

	public function AssociateByState(){
		$conn = $this->connect();
		$sql = "SELECT RIGHT(t.cust_city,2) AS State, t.sales_Associate_id, t.total_price FROM quotedemo.quote t LEFT JOIN quotedemo.quote q ON RIGHT(t.cust_city,2)=RIGHT(q.cust_city,2) and (t.total_price<q.total_price OR (t.total_price=q.total_price AND t.sales_Associate_id<q.sales_Associate_id)) WHERE q.total_price is NULL ORDER BY State DESC;";
		$result = $conn->query($sql);
		return $result;

				
	}

    public function getAllFinalizedQuotes(){
        $statusname = 'F';
        $conn = $this->connect();
        $sql = "SELECT * FROM quote WHERE status LIKE '%" . $statusname . "%';";
        $result = $conn->query($sql);
        $quoteList = array ();

        if ($result->num_rows >0 ) {
            while ($row = $result->fetch_assoc() ) {
                $quoteList [$row ['quote_id']] = new Quote ( $row );}
        }
        return $quoteList;
    }

    public function getAllSanctionedQuotes(){
        $statusname = 'S';
        $conn = $this->connect();
        $sql = "SELECT * FROM quote WHERE status LIKE '%" . $statusname . "%';";
        $result = $conn->query($sql);
        $quoteList = array ();

        if ($result->num_rows >0 ) {
            while ($row = $result->fetch_assoc() ) {
                $quoteList [$row ['quote_id']] = new Quote ( $row );}
        }
        return $quoteList;
    }

    public function getAllOpenQuotes(){
        $statusname = 'O';
        $conn = $this->connect();
        $sql = "SELECT * FROM quote WHERE status LIKE '%" . $statusname . "%';";
        $result = $conn->query($sql);
        $quoteList = array ();

        if ($result->num_rows >0 ) {
            while ($row = $result->fetch_assoc() ) {
                $quoteList [$row ['quote_id']] = new Quote ( $row );}
        }
        return $quoteList;
    }

    public function getAllPurchaseOrderQuotes(){
        $statusname = 'P';
        $conn = $this->connect();
        $sql = "SELECT * FROM quote WHERE status LIKE '%" . $statusname . "%';";
        $result = $conn->query($sql);
        $quoteList = array ();

        if ($result->num_rows >0 ) {
            while ($row = $result->fetch_assoc() ) {
                $quoteList [$row ['quote_id']] = new Quote ( $row );}
        }
        return $quoteList;
    }

    public function getLineItem($quote_id) {
        $conn = $this->connect ();
        // look up Line items in "LineItems" table
        $sql = "SELECT * FROM LineItem WHERE quote_id = " . $quote_id . ";";
        trace ( $sql );
        $result = $conn->query ( $sql );
        $row = $result->fetch_assoc ();
        return new LineItem ( $row );
    }

    public function deleteLineItem($quote_id) {
        $conn = $this->connect ();
        // delete LineItem
        $sql = "DELETE FROM LineItem WHERE quote_id = " . $quote_id . ";";
        trace ( $sql );
        if ($conn->query ( $sql ) === TRUE) {
            return "Employee record deleted successfully";
        } else {
            trace ( "Error updating record: " . $conn->error );
        }
    }


    public function saveQuoteRecordNewQuote($quote){
        $conn = $this->connect ();
        if ($quote->quote_id===NULL){
            $sql="INSERT INTO quote (cust_id, cust_name, cust_city, cust_street, sales_Associate_id, secret_notes, status, quote_date) VALUES (";
            $sql .= "'" . $quote->cust_id . "',";
            $sql .= "'" . $quote->cust_name . "',";
            $sql .= "'" . $quote->cust_city . "',";
            $sql .= "'" . $quote->cust_street . "',";
            $sql .= "'" . $quote->sales_Associate_id . "',";
            $sql .= "'" . $quote->secret_notes . "',";
            $sql .= "'" . $quote->status . "',";
            $sql .= "'" . $quote->quote_date . "');";
            printf ("New Record has id %d.\n", $conn->insert_id);}
        else {
            $sql = "UPDATE quote SET cust_id = '" . $quote->cust_id . "',";
            $sql .= "cust_name = '" . $quote->cust_name . "',";
            $sql .= "cust_city = '" . $quote->cust_city . "',";
            $sql .= "cust_street = '" . $quote->cust_street . "',";
            $sql .= "sales_Associate_id = '" . $quote->sales_Associate_id . "',";
            $sql .= "secret_notes = '" . $quote->secret_notes . "',";
            $sql .= "status = '" . $quote->status . "',";
            $sql .= "quote_date = '" . $quote->quote_date . "' WHERE quote_id = " . $quote->quote_id . ";";
            printf ("New Record has id %d.\n", $conn->insert_id);}
        if($conn->query($sql)==true)
            return "Update complete";
        else
            return "Error in Updating";
    }

    /**
     * @param $lineitem
     * @return string
     */
    public function updateLineItem($lineitem) {
        $conn = $this->connect ();
        // id -1 indicates to create new employee in DB
        if ($lineitem->quote_id == - 1) {
            // insert new lineitem
            $sql = "INSERT INTO LineItem (quote_id, item_description, item_price) VALUES (";
            $sql .= "'" . $lineitem->quote_id . "', ";
            $sql .= "'" . $lineitem->item_description . "', ";
            $sql .= "'" . $lineitem->item_price . "');";
        } else {
            // update employee in "employees" table
            $sql = "UPDATE LineItem SET item_description = '" . $lineitem->item_description . "', ";
            $sql .= "item_price = '" . $lineitem->item_price . "', ";
            $sql .= "' WHERE quote_id = " . $lineitem->quote_id . ";";
        }
        trace ( $sql );
        if ($conn->query ( $sql ) === TRUE) {
            return "Line Items updated successfully";
        } else {
            trace ( "Error updating record: " . $conn->error );
        }
    }


    public function updateEmail($quote) {
        $conn = $this->connect ();
        // id -1 indicates to create new employee in DB
        if ($quote->cust_email == - 1) {
            // insert new email
            $sql = "INSERT INTO Quote (cust_email) VALUES (";
            $sql .= "'" . $quote->cust_email . "');";
        } else {
            // update email in "Customer" table
            $sql = "UPDATE Quote SET cust_email = '" . $quote->cust_email . "', ";
            $sql .= "' WHERE quote_id = " . $quote->quote_id . ";";
        }
        trace ( $sql );
        if ($conn->query ( $sql ) === TRUE) {
            return "Email updated successfully";
        } else {
            trace ( "Error updating record: " . $conn->error );
        }
    }


    public function finalizeStatus($quote) {
        $conn = $this->connect ();
        define("STATUSF", "F");
        // id -1 indicates to create new employee in DB
        if ($quote->status == - 1) {
            // insert new email
            $sql = "INSERT INTO Quote (status) VALUES (";
            $sql .= "'" . $quote->status . "');";
        } else {
            // update email in "Customer" table
            $sql = "UPDATE Quote SET status = '" . STATUSF . "', ";
            $sql .= "' WHERE quote_id = " . $quote->quote_id . ";";
        }
        trace ( $sql );
        if ($conn->query ( $sql ) === TRUE) {
            return "Email updated successfully";
        } else {
            trace ( "Error updating record: " . $conn->error );
        }
    }





}
class Quote {
	var $cust_id;
	var $cust_name;
	var $cust_city;
	var $cust_street;
	var $cust_email;
	var $status;
	var $quote_date;
	var $sales_Associate_id;
	var $secret_notes;
	var $discount;
	var $quote_id;
	var $processingDate;
	var $associateCommission;
	var $total_price;

	function __construct($row) {
		$this->cust_id =$row['cust_id'];
		$this->cust_name =$row['cust_name'];
		$this->cust_city =$row['cust_city'];
		$this->cust_street =$row['cust_street'];
		$this->cust_email =$row['cust_email'];
		$this->status =$row['status'];
		$this->quote_date =$row['quote_date'];
		$this->sales_Associate_id =$row['sales_Associate_id'];
		$this->secret_notes =$row['secret_notes'];
		$this->discount =$row['discount'];
		$this->quote_id =$row['quote_id'];
		$this->processingDate =$row['processingDate'];
		$this->associateCommission =$row['associateCommission'];
		$this->total_price =$row['total_price'];}
}

class LineItem{

    var $quote_id;
    var $item_description;
    var $item_price;

    function __construct($row){
        $this->quote_id =$row['quote_id'];
        $this->item_description=$row['item_description'];
        $this->item_price=$row['item_price'];
	}
}

?>
