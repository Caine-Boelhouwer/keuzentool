<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'users';

    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('roles_id');
            $table->tinyInteger('status')->nullable()->default('1');
            $table->string('avatar', 191)->nullable()->default('no_avatar.jpg');
            $table->string('email', 191)->nullable();
            $table->string('password', 191)->nullable();
            $table->string('remember_token', 191)->nullable();

            $table->index(["roles_id"], 'fk_users_roles_idx');
            $table->nullableTimestamps();


            $table->foreign('roles_id', 'fk_users_roles_idx')
                ->references('id')->on('roles')
                ->onDelete('no action')
                ->onUpdate('no action');
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
