<?php
/**
 * Created by PhpStorm.
 * User: Sagar Sudhakar
 * Date: 8/3/2017
 * Time: 12:35 AM
 */

/**
 * Boundary class to Legacy Customer Database
 *
 */
class LegacyDBInterface {

    // create database connection
    function connect() {
        $servername = "blitz.cs.niu.edu";
        $username = "student";
        $password = "student";
        $dbname = "csci467";

        // Create persistent connection connection
        $conn = new mysqli ( 'p:' . $servername, $username, $password, $dbname );

        // Check connection
        if ($conn->connect_error) {
            die ( "Connection failed: " . $conn->connect_error );
        }
        trace ( "Legacy Customer Database: connected successfully to: " . $conn->host_info );

        /* change character set to utf8 */
        $conn->set_charset ( "utf8" );
        return $conn;
    }

    public function retrieveCustomers($name){
        $conn = $this->connect();
        $sql = "SELECT * FROM customers WHERE name LIKE '%" . $name . "%';";
        $result = $conn->query($sql);
        $custList = array ();

        if ($result->num_rows >0 ) {
            while ($row = $result->fetch_assoc() ) {
                $custList [$row ['id']] = new Customer( $row );}
        }
        return $custList;
    }

    public function getAllCustomers() {
        $conn = $this->connect ();
        // Collects data from "projects" table
        $sql = "SELECT * FROM customers;";
        trace ( $sql );
        $result = $conn->query ( $sql );

        $custList = array ();

        if ($result->num_rows > 0) {
            while ( $row = $result->fetch_assoc () ) {
                $custList [$row ['id']] = new Customer ( $row );
            }
        } else {
            trace ( "No records found" );
        }
        return $custList;
    }

    public function getCustomerInfo($id) {
        $conn = $this->connect();
        $sql = "SELECT * FROM customers WHERE id = " . $id . ";";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return new Customer($row);
    }
}
class Customer {
    var $id;
    var $name;
    var $city;
    var $street;
    var $contact;

    // create project instance from array
    function __construct($row) {
        $this->id = $row ['id'];
        $this->name = $row ['name'];
        $this->city = $row ['city'];
        $this->street = $row ['street'];
        $this->contact = $row ['contact'];

    }
}
