<?php
/**
 * Hair Aura - Database Connection Class
 * 
 * Singleton pattern for PDO database connections
 * Provides secure, prepared statement queries
 * 
 * @package HairAura\Core
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Core;

use PDO;
use PDOException;
use Exception;

class Database
{
    /** @var Database|null Singleton instance */
    private static ?self $instance = null;
    
    /** @var PDO PDO connection instance */
    private PDO $connection;
    
    /** @var array Database configuration */
    private array $config;
    
    /**
     * Private constructor - prevents direct instantiation
     */
    private function __construct()
    {
        $this->config = require __DIR__ . '/../../config/database.php';
        $this->connect();
    }
    
    /**
     * Prevent cloning
     */
    private function __clone() {}
    
    /**
     * Get singleton instance
     * 
     * @return Database
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Establish database connection
     * 
     * @throws Exception If connection fails
     */
    private function connect(): void
    {
        try {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $this->config['host'],
                $this->config['port'],
                $this->config['database'],
                $this->config['charset']
            );
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            // Some PHP builds do not expose MYSQL_ATTR_INIT_COMMAND as a constant.
            if (\defined('PDO::MYSQL_ATTR_INIT_COMMAND')) {
                $options[\constant('PDO::MYSQL_ATTR_INIT_COMMAND')] =
                    "SET NAMES {$this->config['charset']} COLLATE {$this->config['collation']}";
            }
            
            $this->connection = new PDO(
                $dsn,
                $this->config['username'],
                $this->config['password'],
                $options
            );
            
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new Exception("Database connection failed. Please try again later.");
        }
    }
    
    /**
     * Get PDO connection
     * 
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
    
    /**
     * Execute a prepared query
     * 
     * @param string $sql SQL query
     * @param array $params Parameters for prepared statement
     * @return \PDOStatement
     */
    public function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    /**
     * Fetch single row
     * 
     * @param string $sql SQL query
     * @param array $params Parameters
     * @return array|null
     */
    public function fetchOne(string $sql, array $params = []): ?array
    {
        $stmt = $this->query($sql, $params);
        $result = $stmt->fetch();
        return $result ?: null;
    }
    
    /**
     * Fetch all rows
     * 
     * @param string $sql SQL query
     * @param array $params Parameters
     * @return array
     */
    public function fetchAll(string $sql, array $params = []): array
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }
    
    /**
     * Fetch a single column value
     * 
     * @param string $sql SQL query
     * @param array $params Parameters
     * @return mixed
     */
    public function fetchColumn(string $sql, array $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchColumn();
    }
    
    /**
     * Insert record and return last insert ID
     * 
     * @param string $table Table name
     * @param array $data Data to insert
     * @return int Last insert ID
     */
    public function insert(string $table, array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->query($sql, $data);
        
        return (int) $this->connection->lastInsertId();
    }
    
    /**
     * Update records
     * 
     * @param string $table Table name
     * @param array $data Data to update
     * @param string $where Where clause
     * @param array $whereParams Where parameters
     * @return int Affected rows
     */
    public function update(string $table, array $data, string $where, array $whereParams = []): int
    {
        $setParts = [];
        foreach ($data as $key => $value) {
            $setParts[] = "{$key} = :{$key}";
        }
        $setClause = implode(', ', $setParts);
        
        $sql = "UPDATE {$table} SET {$setClause} WHERE {$where}";
        $stmt = $this->query($sql, array_merge($data, $whereParams));
        
        return $stmt->rowCount();
    }
    
    /**
     * Delete records
     * 
     * @param string $table Table name
     * @param string $where Where clause
     * @param array $params Parameters
     * @return int Affected rows
     */
    public function delete(string $table, string $where, array $params = []): int
    {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }
    
    /**
     * Begin transaction
     */
    public function beginTransaction(): void
    {
        $this->connection->beginTransaction();
    }
    
    /**
     * Commit transaction
     */
    public function commit(): void
    {
        $this->connection->commit();
    }
    
    /**
     * Rollback transaction
     */
    public function rollback(): void
    {
        $this->connection->rollBack();
    }
    
    /**
     * Check if in transaction
     * 
     * @return bool
     */
    public function inTransaction(): bool
    {
        return $this->connection->inTransaction();
    }
    
    /**
     * Escape identifier for safe use in SQL
     * 
     * @param string $identifier
     * @return string
     */
    public function quoteIdentifier(string $identifier): string
    {
        return '`' . str_replace('`', '``', $identifier) . '`';
    }
    /**
     * Check if a column exists in a table
     * 
     * @param string $table
     * @param string $column
     * @return bool
     */
    public function hasColumn(string $table, string $column): bool
    {
        try {
            $this->query("SELECT {$column} FROM {$table} WHERE 1=0");
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
