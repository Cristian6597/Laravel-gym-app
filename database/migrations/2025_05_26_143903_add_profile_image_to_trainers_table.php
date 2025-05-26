<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->string('profile_image')->nullable();
            // oppure usa 'photo' come nome del campo se preferisci
        });
    }

    public function down()
    {
        Schema::table('trainers', function (Blueprint $table) {
            $table->dropColumn('profile_image');
        });
    }
};
