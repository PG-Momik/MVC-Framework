<?php

class m001_migrations
{

    /**
     * @return void
     */
    public function up(): void
    {
        $db    = \momik\simplemvc\core\Application::$app->database;
        $query = "CREATE TABLE migrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB";

        $db->pdo->exec($query);
    }

    /**
     * @return void
     */
    public function down(): void
    {
        $db    = \momik\simplemvc\core\Application::$app->database;
        $query = "DROP TABLE migrations";
        $db->pdo->exec($query);
    }

}