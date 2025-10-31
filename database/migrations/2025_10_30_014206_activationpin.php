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
Schema::create('activation_pins', function (Blueprint $table) {
    $table->id();
    $table->string('pin')->unique();
    $table->unsignedBigInteger('assigned_to'); // Member who can use this PIN
    $table->unsignedBigInteger('used_by')->nullable();
    $table->enum('status', ['unused', 'used'])->default('unused');
    $table->timestamp('used_at')->nullable();
    $table->unsignedBigInteger('generated_by'); // Admin ID who generated this PIN
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
