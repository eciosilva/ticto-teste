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
        Schema::create('users_time_sheet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->date('work_date')->index();
            $table->time('start_time');
            $table->time('end_time')->nullable();
            // $table->time('break_start')->nullable();
            // $table->time('break_end')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'work_date']); // Composite unique index
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_time_sheet');
    }
};
