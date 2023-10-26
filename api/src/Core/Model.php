<?php

namespace App\Core;

use Exception;
use PDO;

class Model
{
    protected PDO $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @throws Exception
     */
    protected function insert($tableName, $data): bool
    {
        try {
            $keys = array_keys($data);
            $values = implode(", ", $keys);
            $valuesWithColon = implode(", :", $keys);

            $stmt = $this->db->prepare("INSERT INTO " . $tableName . " (" . $values . ") VALUES (:" . $valuesWithColon . ")");

            return $stmt->execute($data);

        } catch (Exception $exception) {
            throw new Exception("Unable to insert");
        }
    }

    protected function selectAll($tableName)
    {
        $stmt = $this->db->prepare("SELECT * FROM " . $tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function fetchAll($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetchAll();
    }

    protected function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    protected function selectOne($tableName, $where)
    {
        $sql = "SELECT * FROM " . $tableName . " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i === 0) {
                $sql = $sql . $key . " = :" . $key;
            } else {
                $sql = $sql . " AND " . $key . " = :" . $key;
            }
            $i++;
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
        return $stmt->fetch();
    }

    protected function fetch($sql, $params = [])
    {
        $stmt = $this->query($sql, $params);
        return $stmt->fetch();
    }

    protected function update($tableName, $data): bool
    {
        $sql = "UPDATE " . $tableName . " SET ";
        $i = 0;
        foreach ($data as $key => $value) {
            if ($i === 0) {
                $sql = $sql . $key . " = :" . $key;
            } else {
                $sql = $sql . ", " . $key . " = :" . $key;
            }
            $i++;
        }
        $sql = $sql . " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    protected function delete($tableName, $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM " . $tableName . " WHERE id = :id");
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }

}
