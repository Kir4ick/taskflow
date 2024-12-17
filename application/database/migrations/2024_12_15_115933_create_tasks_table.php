<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->dateTime('end_date');
            $table->integer('type');
            $table->integer('priority');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->on('users')->references('id')->cascadeOnDelete();
        });

        Schema::create('users_worked', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');

            $table->dateTime('start_work_time');
            $table->dateTime('end_work_time');

            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('task_id')->on('tasks')->references('id')->cascadeOnDelete();
        });

        Schema::create('task_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');

            $table->string('path');
            $table->string('name');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('task_id')->on('tasks')->references('id')->cascadeOnDelete();
        });

        Schema::create('task_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('task_id');
            $table->timestamps();

            $table->text('comment');

            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('task_id')->on('tasks')->references('id')->cascadeOnDelete();
        });

        Schema::create('task_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('status_id')->on('dashboard_statuses')->references('id')->cascadeOnDelete();
            $table->foreign('task_id')->on('tasks')->references('id')->cascadeOnDelete();
        });

        Schema::create('task_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();
            $table->integer('hours');

            $table->foreign('user_id')->on('users')->references('id')->cascadeOnDelete();
            $table->foreign('task_id')->on('tasks')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_worked');
        Schema::dropIfExists('task_files');
        Schema::dropIfExists('task_comments');
        Schema::dropIfExists('task_history');
        Schema::dropIfExists('task_times');
        Schema::dropIfExists('tasks');
    }
};
