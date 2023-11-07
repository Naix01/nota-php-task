<?php

/**
 * The TableCreator class creates and manages a database table named 'Test'.
 * It allows for the creation of the table with specific fields, filling it with random data,
 * and selecting data based on the 'result' column criteria.
 *
 * This class does not allow inheritance from its descendants.
 */
final class TableCreator
{
    private $pdo;

    /**
     * TableCreator constructor.
     *
     * Initializes the database connection, creates the 'Test' table, and fills it with random data.
     */
    public function __construct()
    {
        // Initialize the database connection
        $this->pdo = new PDO('mysql:host=localhost;dbname=your_database', 'your_username', 'your_password');

        // Execute the 'create' method
        $this->create();

        // Execute the 'fill' method
        $this->fill();
    }

    /**
     * Create the 'Test' table with specific fields.
     *
     * @access private
     */
    private function create()
    {
        $sql = "CREATE TABLE IF NOT EXISTS Test (
            id INT AUTO_INCREMENT PRIMARY KEY,
            script_name VARCHAR(25),
            start_time DATETIME,
            end_time DATETIME,
            result ENUM('normal', 'illegal', 'failed', 'success')
        )";
        $this->pdo->exec($sql);
    }

    /**
     * Fill the 'Test' table with random data.
     *
    
