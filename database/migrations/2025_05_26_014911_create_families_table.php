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
        Schema::create('family', function (Blueprint $table) {
            $table->id();
            $table->string('Full_name');
            $table->string('Nick_name')->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->string('domisili')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('family')->onDelete('set null');
            $table->foreignId('spouse_id')->nullable()->constrained('family')->onDelete('set null');
            $table->string('generation_code')->nullable();
            $table->string('photo')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family');
    }
};
