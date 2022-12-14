<?php

class m002_users
{

    /**
     * @return void
     */
    public function up(): void
    {
        $db    = \momik\simplemvc\core\Application::$app->database;
        $query = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL ,
    status TINYINT NOT NULL ,
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
        $query = "DROP TABLE users";
        $db->pdo->exec($query);
    }

}