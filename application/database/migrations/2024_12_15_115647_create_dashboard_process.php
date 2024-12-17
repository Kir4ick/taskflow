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
        Schema::create('dashboard_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_end_process')->default(false);
            $table->unsignedBigInteger('dashboard_id');
            $table->unsignedBigInteger('work_role_id');

            $table->timestamps();

            $table->foreign('dashboard_id')
                ->references('id')
                ->on('dashboards')
                ->onDelete('cascade');

            $table->foreign('work_role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->unique(['is_end_process', 'dashboard_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_statuses');
    }
};
