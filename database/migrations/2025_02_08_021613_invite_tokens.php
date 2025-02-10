<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('invite_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('used')->default(false);
            $table->timestamp('used_at')->nullable();  // Tambahan untuk tracking waktu penggunaan
            $table->timestamps();

            // Tambahkan foreign key untuk user_id
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invite_tokens');
    }
};