<?php

class m003_products
{

    /**
     * @return void
     */
    public function up(): void
    {
        $db    = \momik\simplemvc\core\Application::$app->database;
        $query = "CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
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
        $query = "DROP TABLE products";
        $db->pdo->exec($query);
    }

}