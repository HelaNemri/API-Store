<?php

namespace Database;

use PDO;

class Database
{
    private $db;
    private $pdo;
    private $host;
    private $user;
    private $password;
    private $port;
    private $database;


    /**
     * A constructor method to initialize the database connection.
     */
    public function __construct()
    {
        // Initialize the database connection
        $this->db = $this->initializeDatabase();
        $this->connect();
    }

    /**
     * A function to initialize the database.
     *
     * @return PDO
     */
    private function initializeDatabase()
    {
        $config = $this->getDatabaseConfig();
        try {
            $db = new PDO(
                "mysql:host={$config['host']};dbname={$config['database']};port={$config['port']}",
                $config['user'],
                $config['password']
            );

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        } catch (\PDOException $e) {
            return ("Database connection error: " . $e->getMessage());
        }
    }

    /**
     * Get the database configuration from the specified file path
     *
     * @throws \Exception Database configuration file not found
     * @throws \Exception Missing Database Configuration Parameters
     */
    private function getDatabaseConfig()
    {
        // Path to the configuration file
        $configFilePath = __DIR__ . '/../config/db_Config.php';

        if (!file_exists($configFilePath)) {
            throw new \Exception('Database configuration file not found: ' . $configFilePath);
        }

        // Include the configuration file
        $config = require $configFilePath;

        // Validate the structure of the configuration file 
        if (
            !isset($config['database']['host']) ||
            !isset($config['database']['user']) ||
            !isset($config['database']['password']) ||
            !isset($config['database']['port']) ||
            !isset($config['database']['database'])
        ) {
            throw new \Exception('Missing Database Configuration Parameters');
        }

        $this->host = $config['database']['host'];
        $this->user = $config['database']['user'];
        $this->password = $config['database']['password'];
        $this->port = $config['database']['port'];
        $this->database = $config['database']['database'];
        return ["host" => $this->host, "user" => $this->user, "password" => $this->password,  "port" => $this->port,  "database" => $this->database];
    }

    /**
     * Connects to the database using the provided credentials.
     */
    private function connect()
    {
        try {
            $this->pdo = new \PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->database, $this->user, $this->password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Executes a SQL query with optional attributes.
     *
     * @param string $query The SQL query to be executed.
     * @param array $attributes An array of parameters to be bound to the query.
     * @return bool Returns true if the query was executed successfully, false otherwise.
     */
    public function query($query, $attributes = [])
    {
        try {
            $statement = $this->pdo->prepare($query);
            $result = $statement->execute($attributes);
            return $result;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function fetchAll($sql, $attributes = [])
    {
        try {
            // Prepare the SQL query
            $statement = $this->pdo->prepare($sql);
            // Bind attributes if provided
            foreach ($attributes as $key => $value) {
                $statement->bindValue($key + 1, $value);  // The +1 is to match the positional placeholders in SQL (1-indexed)
            }
            // Execute the query
            $statement->execute();

            // Fetch the results as an associative array
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\Exception $e) {
            // Handle any exceptions and return false
            return false;
        }
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $sql description
     * @throws \Exception description of exception
     * @return mixed
     */
    public function fetchOne($sql)
    {
        try {
            // Prepare the SQL query
            $statement = $this->pdo->prepare($sql);
            // Execute the query
            $statement->execute();

            // Fetch a single row as an associative array
            $result = $statement->fetch(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\Exception $e) {
            // Handle any exceptions and return false
            return false;
        }
    }
}
