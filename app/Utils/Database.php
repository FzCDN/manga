<?php

namespace App\Utils;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
        
class Database {
    private static $instance;
    private $connection;

    private function __construct() {

        $capsule = new Capsule();

        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => DB_HOST,
            'database' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        
        try {
            $capsule->setEventDispatcher(new Dispatcher(new Container));
            
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            
            $this->connection = $capsule->getConnection()->getPdo();
        
            $wizard = new Wizard($this->connection, DB_NAME); 
            $wizard->runWizard();
        } catch (\PDOException $e) {
            $errorMessage = "Error connecting to the database: " . $e->getMessage();
            $errorHTMLFile = __DIR__ . '/../Views/Error/database.php';
            
            if (file_exists($errorHTMLFile)) {
               include_once $errorHTMLFile;
               exit;
           } else {
               die($errorMessage);
           }
           
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
