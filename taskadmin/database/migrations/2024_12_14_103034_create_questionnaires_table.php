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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('email');
            $table->string('inn');
            $table->string('kpp');
            $table->string('ogrn');
            $table->string('phone');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('deleted_by');

            $table->index('title');
            $table->foreign('deleted_by')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
