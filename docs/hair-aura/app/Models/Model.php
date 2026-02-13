<?php
/**
 * Hair Aura - Base Model Class
 * 
 * Provides common ORM functionality for all models
 * 
 * @package HairAura\Models
 * @author Hair Aura Team
 * @version 1.0.0
 */

namespace App\Models;

use App\Core\Database;
use PDO;
use Exception;

abstract class Model
{
    /** @var string Database table name */
    protected static string $table;
    
    /** @var string Primary key column */
    protected static string $primaryKey = 'id';
    
    /** @var array Fillable attributes */
    protected static array $fillable = [];
    
    /** @var array Hidden attributes */
    protected static array $hidden = [];
    
    /** @var array Model attributes */
    protected array $attributes = [];
    
    /** @var bool Whether model exists in database */
    protected bool $exists = false;
    
    /**
     * Constructor
     * 
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }
    
    /**
     * Fill model attributes
     * 
     * @param array $attributes
     * @return self
     */
    public function fill(array $attributes): self
    {
        foreach ($attributes as $key => $value) {
            $canSetPrimaryKey = $key === static::$primaryKey &&
                (!$this->exists || !array_key_exists($key, $this->attributes));

            if (
                $canSetPrimaryKey ||
                empty(static::$fillable) ||
                in_array($key, static::$fillable, true)
            ) {
                $this->attributes[$key] = $value;
            }
        }
        return $this;
    }
    
    /**
     * Get attribute
     * 
     * @param string $key
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->attributes[$key] ?? null;
    }
    
    /**
     * Set attribute
     * 
     * @param string $key
     * @param mixed $value
     */
    public function __set(string $key, $value): void
    {
        $canSetPrimaryKey = $key === static::$primaryKey &&
            (!$this->exists || !array_key_exists($key, $this->attributes));

        if (
            $canSetPrimaryKey ||
            empty(static::$fillable) ||
            in_array($key, static::$fillable, true)
        ) {
            $this->attributes[$key] = $value;
        }
    }
    
    /**
     * Check if attribute exists
     * 
     * @param string $key
     * @return bool
     */
    public function __isset(string $key): bool
    {
        return isset($this->attributes[$key]);
    }
    
    /**
     * Convert to array
     * 
     * @return array
     */
    public function toArray(): array
    {
        $attributes = $this->attributes;
        
        foreach (static::$hidden as $key) {
            unset($attributes[$key]);
        }
        
        return $attributes;
    }
    
    /**
     * Convert to JSON
     * 
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
    
    /**
     * Check if model exists
     * 
     * @return bool
     */
    public function exists(): bool
    {
        return $this->exists;
    }
    
    /**
     * Find by primary key
     * 
     * @param int $id
     * @return static|null
     */
    public static function find(int $id): ?static
    {
        $db = Database::getInstance();
        $table = static::$table;
        $key = static::$primaryKey;
        
        $result = $db->fetchOne(
            "SELECT * FROM {$table} WHERE {$key} = :id LIMIT 1",
            ['id' => $id]
        );
        
        if (!$result) {
            return null;
        }
        
        $instance = new static($result);
        $instance->exists = true;
        return $instance;
    }
    
    /**
     * Find by attribute
     * 
     * @param string $column
     * @param mixed $value
     * @return static|null
     */
    public static function findBy(string $column, $value): ?static
    {
        $db = Database::getInstance();
        $table = static::$table;
        
        $result = $db->fetchOne(
            "SELECT * FROM {$table} WHERE {$column} = :value LIMIT 1",
            ['value' => $value]
        );
        
        if (!$result) {
            return null;
        }
        
        $instance = new static($result);
        $instance->exists = true;
        return $instance;
    }
    
    /**
     * Get all records
     * 
     * @param string $orderBy
     * @param string $direction
     * @return array
     */
    public static function all(string $orderBy = 'id', string $direction = 'ASC'): array
    {
        $db = Database::getInstance();
        $table = static::$table;
        
        return $db->fetchAll(
            "SELECT * FROM {$table} ORDER BY {$orderBy} {$direction}"
        );
    }
    
    /**
     * Get records with where clause
     * 
     * @param array $conditions
     * @param string $orderBy
     * @param string $direction
     * @param int|null $limit
     * @return array
     */
    public static function where(array $conditions, string $orderBy = 'id', string $direction = 'ASC', ?int $limit = null): array
    {
        $db = Database::getInstance();
        $table = static::$table;
        
        $whereParts = [];
        $params = [];
        
        foreach ($conditions as $key => $value) {
            $whereParts[] = "{$key} = :{$key}";
            $params[$key] = $value;
        }
        
        $whereClause = implode(' AND ', $whereParts);
        $sql = "SELECT * FROM {$table} WHERE {$whereClause} ORDER BY {$orderBy} {$direction}";
        
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        
        return $db->fetchAll($sql, $params);
    }
    
    /**
     * Get first record matching conditions
     * 
     * @param array $conditions
     * @return static|null
     */
    public static function firstWhere(array $conditions): ?static
    {
        $results = static::where($conditions, 'id', 'ASC', 1);
        
        if (empty($results)) {
            return null;
        }
        
        $instance = new static($results[0]);
        $instance->exists = true;
        return $instance;
    }
    
    /**
     * Create new record
     * 
     * @param array $attributes
     * @return static
     */
    public static function create(array $attributes): static
    {
        $instance = new static($attributes);
        $instance->save();
        return $instance;
    }
    
    /**
     * Save model to database
     * 
     * @return bool
     */
    public function save(): bool
    {
        $db = Database::getInstance();
        
        if ($this->exists) {
            return $this->updateRecord($db);
        } else {
            return $this->insertRecord($db);
        }
    }
    
    /**
     * Insert new record
     * 
     * @param Database $db
     * @return bool
     */
    protected function insertRecord(Database $db): bool
    {
        $data = [];
        foreach (static::$fillable as $key) {
            if (isset($this->attributes[$key])) {
                $data[$key] = $this->attributes[$key];
            }
        }
        
        // Add timestamps
        if (in_array('created_at', static::$fillable)) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }
        if (in_array('updated_at', static::$fillable)) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        
        $id = $db->insert(static::$table, $data);
        $this->attributes[static::$primaryKey] = $id;
        $this->exists = true;
        
        return true;
    }
    
    /**
     * Update existing record
     * 
     * @param Database $db
     * @return bool
     */
    protected function updateRecord(Database $db): bool
    {
        $data = [];
        foreach (static::$fillable as $key) {
            if (isset($this->attributes[$key]) && $key !== static::$primaryKey) {
                $data[$key] = $this->attributes[$key];
            }
        }
        
        // Update timestamp
        if (in_array('updated_at', static::$fillable)) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        
        $key = static::$primaryKey;
        $recordId = $this->attributes[$key] ?? null;
        if ($recordId === null) {
            return false;
        }

        $db->update(
            static::$table,
            $data,
            "{$key} = :id",
            ['id' => $recordId]
        );
        
        return true;
    }
    
    /**
     * Update attributes
     * 
     * @param array $attributes
     * @return bool
     */
    public function update(array $attributes): bool
    {
        $this->fill($attributes);
        return $this->save();
    }
    
    /**
     * Delete record
     * 
     * @return bool
     */
    public function delete(): bool
    {
        if (!$this->exists) {
            return false;
        }
        
        $db = Database::getInstance();
        $key = static::$primaryKey;
        $recordId = $this->attributes[$key] ?? null;
        if ($recordId === null) {
            return false;
        }
        
        $db->delete(
            static::$table,
            "{$key} = :id",
            ['id' => $recordId]
        );
        
        $this->exists = false;
        return true;
    }
    
    /**
     * Count records
     * 
     * @param array $conditions
     * @return int
     */
    public static function count(array $conditions = []): int
    {
        $db = Database::getInstance();
        $table = static::$table;
        
        $sql = "SELECT COUNT(*) FROM {$table}";
        $params = [];
        
        if (!empty($conditions)) {
            $whereParts = [];
            foreach ($conditions as $key => $value) {
                $whereParts[] = "{$key} = :{$key}";
                $params[$key] = $value;
            }
            $sql .= " WHERE " . implode(' AND ', $whereParts);
        }
        
        return (int) $db->fetchColumn($sql, $params);
    }
    
    /**
     * Paginate results
     * 
     * @param int $page
     * @param int $perPage
     * @param array $conditions
     * @param string $orderBy
     * @param string $direction
     * @return array
     */
    public static function paginate(int $page = 1, int $perPage = 15, array $conditions = [], string $orderBy = 'id', string $direction = 'DESC'): array
    {
        $db = Database::getInstance();
        $table = static::$table;
        
        $offset = ($page - 1) * $perPage;
        
        $whereClause = '';
        $params = [];
        
        if (!empty($conditions)) {
            $whereParts = [];
            foreach ($conditions as $key => $value) {
                $whereParts[] = "{$key} = :{$key}";
                $params[$key] = $value;
            }
            $whereClause = "WHERE " . implode(' AND ', $whereParts);
        }
        
        $sql = "SELECT * FROM {$table} {$whereClause} ORDER BY {$orderBy} {$direction} LIMIT {$perPage} OFFSET {$offset}";
        $items = $db->fetchAll($sql, $params);
        
        $total = static::count($conditions);
        $lastPage = (int) ceil($total / $perPage);
        
        return [
            'data' => $items,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => $lastPage,
            'has_more' => $page < $lastPage
        ];
    }
    
    /**
     * Execute raw query
     * 
     * @param string $sql
     * @param array $params
     * @return array
     */
    public static function query(string $sql, array $params = []): array
    {
        $db = Database::getInstance();
        return $db->fetchAll($sql, $params);
    }
}
