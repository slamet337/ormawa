<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('moduls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('Gizi & Nutrisi');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_url')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('badge')->nullable();
            $table->integer('downloads_count')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('moduls');
    }
};
