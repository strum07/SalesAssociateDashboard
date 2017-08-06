<?php

/**********************************************
CSCI 467/567 Project
Use Case Implementation
Professor: Dr Raimund Ege
Teaching Assistant: Neha Sunil Manghnani
Group: Graduate 2 (G2)
Contributors:	Eric Davis, z136652
		Sagar Sudhakar, z1783546
		David Williams, z086126
***********************************************/


class SalesAssociateStore {

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

	public function getAssociates($associate_id){
		$conn = $this->connect();
		$sql = "SELECT * FROM associate WHERE associate_id = " . $associate_id . ";";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		return new SalesAssociate ($row);
	}

    public function getAssociate($associate_id){
        $conn = $this->connect();
        $safe_username = mysqli_real_escape_string($conn, $associate_id);

        $query  = "SELECT * ";
        $query .= "FROM SalesAssociate ";
        $query .= "WHERE associate_id = '{$safe_username}' ";
        $query .= "LIMIT 1";
        $admin_set = mysqli_query($conn, $query);
        confirm_query($admin_set);
        if($admin = mysqli_fetch_assoc($admin_set)) {
            return $admin;
        } else {
            return null;
        }
    }

	public function retrieveAssociates($name){
		$conn = $this->connect();
		$sql = "SELECT * FROM associate WHERE name LIKE '%" . $name . "%';";
		$result = $conn->query($sql);
		$saList = array ();

		if ($result->num_rows >0 ) {
			while ($row = $result->fetch_assoc() ) {
				$saList [$row ['associate_id']] = new SalesAssociate ( $row );}
		}
		return $saList;
	}

	public function Empsave($sa){
		$conn = $this->connect ();
		if ($sa->associate_id==-1){
			$sql="INSERT INTO associate (accumulated_commission, password, name, street, city, state) VALUES (";
			$sql .= "'" . $sa->accumulated_commission . "',";
			$sql .= "'" . $sa->password . "',";
			$sql .= "'" . $sa->name . "',";
			$sql .= "'" . $sa->street . "',";
			$sql .= "'" . $sa->city . "',";
			$sql .= "'" . $sa->state . "');";}
		else {
			$sql = "UPDATE associate SET accumulated_commission = '" . $sa->accumulated_commission . "',";
			$sql .= "password = '" . $sa->password . "',";
			$sql .= "name = '" . $sa->name . "',";
			$sql .= "street = '" . $sa->street . "',";
			$sql .= "city = '" . $sa->city . "',";
			$sql .= "state = '" . $sa->state . "' WHERE associate_id = " . $sa->associate_id . ";";}
		if($conn->query($sql)==true)
			return "Update complete";
		else
			return "error";
	}

	public function deleteAssociate ($associate_id){
		$conn = $this->connect();
		$sql = "DELETE FROM associate WHERE associate_id = " . $associate_id . ";";
		if($conn->query($sql)==TRUE)
			return "Update complete";
		else
			return "error";
	}

    public function getPassword($associate_id) {
        $conn = $this->connect ();
        // look up customer in "customer" table
        $sql = "SELECT password FROM associate WHERE id = ".$associate_id.";";
        trace ( $sql );
        $result = $conn->query ( $sql );
        return $row = $result->fetch_assoc ();
    }


}
class SalesAssociate {
	var $associate_id;
	var $accumulated_commission;
	var $password;
	var $name;
	var $street;
	var $city;
	var $state;

	function __construct($row) {
		$this->associate_id =$row['associate_id'];
		$this->accumulated_commission =$row['accumulated_commission'];
		$this->password =$row['password'];
		$this->name =$row['name'];
		$this->street =$row['street'];
		$this->city =$row['city'];
		$this->state =$row['state'];}
}

?>
