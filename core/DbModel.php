<?php

namespace momik\simplemvc\core;

abstract class DbModel extends Model
{
    /**
     * @return string
     */
    abstract public function tableName(): string;

    /**
     * @return string
     */
    abstract public function primaryKey(): string;

    /**
     * @return array
     */
    abstract public function fields(): array;

    /**
     * @return bool
     */
    public function save(): bool
    {
        $tableName = $this->tableName();
        $fields = $this->fields();
        $db = Application::$app->database;

        $queryPart1 = "INSERT INTO $tableName ";
        $queryPart2 = implode(', ', $fields);
        $queryPart2 = "(" . $queryPart2 . ")";

        $values = array();
        foreach ($fields as $field) {
            $values[] = "'" . $this->$field . "'";
        }

        $queryPart3 = implode(', ', $values);
        $queryPart3 = "(" . $queryPart3 . ")";

        $query = $queryPart1 . $queryPart2 . " VALUES " . $queryPart3;

        return $db->pdo->exec($query);
    }

    /**
     * @param $id
     * @return object|false
     */
    public function fetch($id): object|false
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();
        $db = Application::$app->database;

        $query = "SELECT * FROM $tableName WHERE $primaryKey = $id";
        $stmt = $db->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * @return bool|array
     */
    public function show(): bool|array
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();
        $db = Application::$app->database;

        $query = "SELECT * FROM $tableName";
        $stmt = $db->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @return bool
     */
    public function update($id): bool
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();
        $fields = $this->fields();

        $db = Application::$app->database;
        $queryPart1 = "UPDATE $tableName SET  ";
        $updateText = array();
        foreach ($fields as $field) {
            $updateText[] = "$field = $this->$field";
        }
        $queryPart2 = implode(', ', $updateText);
        $queryPart3 = "WHERE $primaryKey = $id";
        $query = $queryPart1 . $queryPart2 . $queryPart3;

        return $db->pdo->exec($query);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $tableName = $this->tableName();
        $primaryKey = $this->primaryKey();
        $db = Application::$app->database;
        $query = "DELETE FROM $tableName WHERE $primaryKey = $id";

        return $db->pdo->exec($query);
    }

    /**
     * @param array $where
     * @return mixed
     */
    public function findOne(array $where): mixed
    {
        $whereStmt = $this->getWhere($where);
        $table = $this->tableName();
        $query = "SELECT * from $table WHERE $whereStmt";
        $db = Application::$app->database;
        $stmt = $db->pdo->prepare($query);
        $stmt->execute($where);

        return $stmt->fetch(\PDO::FETCH_ASSOC) ?? false;
    }

    /**
     * @param array $where
     * @return string
     */
    private function getWhere(array $where): string
    {
        $stmtArr = array();
        foreach ($where as $key => $value) {
            $stmtArr[] = "$key = :$key";
        }

        return implode('AND, ', $stmtArr);
    }

}