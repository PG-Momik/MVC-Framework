<?php

class m0002_something
{
    /**
     * @return void
     */
    public function up(): void
    {
        $db = \app\core\Application::$app->database;
        $query = "ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL ";
        $db->pdo->exec($query);
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $db = \app\core\Application::$app->database;
        $query = "ALTER TABLE users DROP COLUMN password ";
        $db->pdo->exec($query);
    }
}