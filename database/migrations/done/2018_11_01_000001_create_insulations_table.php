<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsulationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'insulations';

    /**
     * Run the migrations.
     * @table insulations
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('ambient_temp')->nullable();
            $table->integer('max_temp')->nullable();
            $table->integer('min_temp')->nullable();
            $table->string('location', 191)->nullable();
            $table->string('type', 191)->nullable();
            $table->string('insulation_mat', 191)->nullable();
            $table->string('insulation_mat_spec', 191)->nullable();
            $table->string('finish_mat', 191)->nullable();
            $table->string('finish_mat_spec', 191)->nullable();
            $table->string('image', 191)->nullable();
            $table->string('chapter', 191)->nullable();
            $table->longText('description')->nullable();
            $table->longText('explanation')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
