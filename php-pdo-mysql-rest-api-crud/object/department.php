<?php

/**
 * Description of Department
 *
 * @author https://roytuts.com
 */
class Department {

    // database connection and table name
    private $conn;
    private $table_name = "department";
	
    // object properties
    public $id;
    public $name;

    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }
	
	// read departments
    function read() {
        // query to select all
        $query = "SELECT d.dept_id, d.dept_name
            FROM
                " . $this->table_name . " d
            ORDER BY
                d.dept_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
		
        // execute query
        $stmt->execute();
		
        return $stmt;
    }
	
	// create department
    function create() {
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                dept_name=:name";

        // prepare query
        $stmt = $this->conn->prepare($query);
		
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind values
        $stmt->bindParam(":name", $this->name);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
	
	// update the department
    function update() {
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                dept_name = :name
            WHERE
                dept_id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
	
	// delete the department
    function delete() {
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE dept_id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

