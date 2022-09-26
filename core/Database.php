<?php

namespace momik\simplemvc\core;

class Database
{

    public \PDO $pdo;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $dsn       = $config['dsn'] ?? '';
        $user      = $config['user'] ?? '';
        $password  = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return void
     */
    public function applyMigration(): void
    {
        $this->createMigrationsTable();
        $appliedMigrations   = $this->getAppliedMigrations();
        $newMigrations       = array();
        $files               = scandir(Application::$ROOT_DIR . '/migrations');
        $unappliedMigrations = array_diff($files, $appliedMigrations);
        foreach ( $unappliedMigrations as $unappliedMigration ) {
            if ( $unappliedMigration == "." or $unappliedMigration == '..' ) {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $unappliedMigration;

            $className = pathinfo($unappliedMigration, PATHINFO_FILENAME);
            $instance  = new $className();
            $instance->up();

            $newMigrations[] = $unappliedMigration;

            echo "Applied migration $unappliedMigration" . PHP_EOL;
        }

        if ( !empty($newMigrations) ) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied.");
        }
    }

    /**
     * @return void
     */
    public function createMigrationsTable(): void
    {
        $query = "CREATE TABLE IF NOT EXISTS migrations ( id INT AUTO_INCREMENT PRIMARY KEY, migration VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ENGINE=INNODB";
        $this->pdo->exec($query);
    }

    /**
     * @return array|false
     */
    public function getAppliedMigrations(): bool | array
    {
        $query = "SELECT migration FROM migrations";
        $stmt  = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * @param array $newMigrations
     * @return void
     */
    private function saveMigrations(array $newMigrations): void
    {
        $queryPart1    = "INSERT INTO migrations (migration) VALUES ";
        $newMigrations = array_map(fn($m) => "('$m')", $newMigrations);
        $queryPart2    = implode(', ', $newMigrations);
        $query         = $queryPart1 . $queryPart2;
        $stmt          = $this->pdo->prepare($query);
        $stmt->execute();
    }

    /**
     * @param $message
     * @return void
     */
    protected function log($message): void
    {
        echo '[' . date('Y-m-d H:i:s') . ']' . $message . PHP_EOL;
    }

}