<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('invite_tokens', function (Blueprint $table) {
            $table->string('email')->after('user_id'); // Menambahkan email setelah kolom user_id
        });
    }

    public function down()
    {
        Schema::table('invite_tokens', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
};