<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade');
            $table->foreignId('invite_token_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Menggunakan invite_token_id sebagai unique constraint
            // karena satu token hanya bisa dipakai sekali
            $table->unique('invite_token_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};