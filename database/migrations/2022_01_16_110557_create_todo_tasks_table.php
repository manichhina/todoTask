<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->integer('assignee')->unsigned()->nullable();
            $table->foreign('assignee')->references('id')->on('users')->onDelete('cascade');
            $table->integer('assign_to')->unsigned()->nullable();
            $table->string('start_end_date')->nullable();
            $table->integer('status')->default('0')->comment('0: New, 1: In-Progress, 2: N/A, 3: Completed, 4: Reopen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_tasks');
    }
}
