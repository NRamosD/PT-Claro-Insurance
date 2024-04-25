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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->time('start_time');
            $table->time('end_time');

            $table->foreignId('id_course')
                    ->constrained("courses")
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreignId('id_day')
                    ->nullable()
                    ->constrained("days")
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
