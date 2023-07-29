<?php

namespace App\Utils;

use PDO;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Wizard {
    private $dbName;
    private $db;

    public function __construct($db, $dbname)  {
        $this->db = $db;
        $this->dbName = $dbname;
    }

    public function runWizard(){
        if (!$this->tablesExist()) {
            $this->createTables();
        }
    }

    private function tablesExist()
    {
        $stmt = $this->db->query("SHOW TABLES FROM $this->dbName");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $expectedTables = [
            'series',
            'series_meta',
            'chapter',
            'chapter_data',
            'series_genre',
            'genres',
            'options',
            'series_popular',
            'series_recommendations',
            'data_web',
            'user_online',
        ];

        foreach ($expectedTables as $table) {
            if (!in_array($table, $tables)) {
                return false;
            }
        }

        return true;
    }

    private function createTables() {
        $tables = [
            'series' => function (Blueprint $table) {
                 $table->id();
                 $table->string('postname')->nullable();
                 $table->string('image')->nullable();
                 $table->string('title')->nullable();
                 $table->integer('views_today')->default(0);
                 $table->integer('views_weeks')->default(0);
                 $table->integer('views_month')->default(0);
                 $table->integer('views_all')->default(0);
                 $table->enum('status', ['publish', 'draft'])->default('publish');
                 $table->timestamps();
                 //$table->primary('id');
            },
            'series_meta' => function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('series_id')->nullable();
                 $table->text('alternatif')->nullable();
                 $table->string('released')->nullable();
                 $table->string('author')->nullable();
                 $table->string('artist')->nullable();
                 $table->string('type')->nullable();
                 $table->float('rating')->nullable();
                 $table->string('status')->nullable();
                 $table->text('deskripsi')->nullable();
                 $table->timestamps();
                 $table->foreign('series_id')->references('id')->on('series');
                 //$table->primary('id');
            },  
            'chapter' => function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('series_id')->nullable();
                 $table->string('postname')->nullable();
                 $table->string('title')->nullable();
                 $table->datetime('created_at')->nullable()->default(null); 
                 $table->foreign('series_id')->references('id')->on('series');
                 //$table->primary('id');
            },
            'chapter_data' => function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('chapter_id')->nullable();
                 $table->text('content')->nullable();
                 $table->datetime('created_at')->nullable()->default(null); 
                 $table->foreign('chapter_id')->references('id')->on('chapter');
                 //$table->primary('id');
            },
            'series_genre' => function (Blueprint $table) {
                 $table->id();
                 $table->string('title')->nullable();
                 $table->string('postname')->nullable();
                 //$table->primary('id');
            },
            'genres' => function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('series_id')->nullable();
                 $table->unsignedBigInteger('genre_id')->nullable();
                 $table->foreign('series_id')->references('id')->on('series');
                 $table->foreign('genre_id')->references('id')->on('series_genre');
                 //$table->primary('id');
            },
            'options' => function (Blueprint $table) {
                 $table->string('option_name');
                 $table->text('option_value')->nullable();
                 $table->primary('option_name');
            },
            'series_popular' => function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('series_id')->nullable();
                 $table->integer('order_by')->nullable();
                 $table->timestamps();
                 $table->foreign('series_id')->references('id')->on('series');
                 //$table->primary('id');
            },
            'series_recommendations' => function (Blueprint $table) {
                 $table->id();
                 $table->unsignedBigInteger('series_id')->nullable();
                 $table->integer('order_by')->nullable();
                 $table->timestamps();
                 $table->foreign('series_id')->references('id')->on('series');
                 //$table->primary('id');
            },
            'data_web' => function (Blueprint $table) {
                 $table->id();
                 $table->string('data_name')->nullable();
                 $table->string('data_key')->nullable();
                 $table->datetime('updated_at')->nullable()->default(null); // Define 'created_at' column
                 $table->unique('data_name');
                 //$table->primary('id');
            },
            'user_online' => function (Blueprint $table) {
                 $table->id();
                 $table->string('ip_address');
                 $table->integer('access_count')->default(1);
                 $table->timestamp('last_access')->default(Capsule::raw('CURRENT_TIMESTAMP'));
                 //$table->primary('id');
            }
        ];


        foreach ($tables as $tableName => $tableDefinition) {
           Capsule::schema()->create($tableName, $tableDefinition);
        }

        return true; // Tables created successfully
    }

}
