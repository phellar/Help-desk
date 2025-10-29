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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('subject');
            $table->string('description');
            $table->string('priority')->enum('Low', 'Medium', 'High');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('file')->nullabe();
            $table->string('status')->enum('Open', 'In-progress', 'Closed');
            $table->string('department')->enum('Billing', 'Technical', 'Account');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
