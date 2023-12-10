<?php

require_once PROJECT_ROOT_PATH . "/model/Database.php";

class DatabaseOperation extends Database
{
    public function select($query = null, $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function insert($table, $data)
    {
        try {
            $existingRecord = $this->select("SELECT * FROM $table WHERE index_no = :index_no", ['index_no' => $data['index_no']]);

            if ($existingRecord) {
                echo("DUPLICATION: index_no {$data['index_no']} already exists.");
            }else {
                $columns = implode(", ", array_keys($data));
                $values = ":" . implode(", :", array_keys($data));
    
                $query = "INSERT INTO $table ($columns) VALUES ($values)";
                $this->executeStatement($query, $data);
    
                return true;

            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update($table, $data, $condition)
    {
        var_dump($table);
        var_dump($data);
        var_dump($condition);
        try {
            if (!isset($data['index_no'])) {
                throw new Exception("Missing 'id' field in data for update.");
            }

            $setClause = implode(", ", array_map(fn ($key) => "$key = :$key", array_keys($data)));

            $query = "UPDATE $table SET $setClause WHERE $condition";
            $this->executeStatement($query, $data);

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete($table, $condition, $params = [])
    {
        try {
            $query = "DELETE FROM $table WHERE $condition";
            $this->executeStatement($query, $params);

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
