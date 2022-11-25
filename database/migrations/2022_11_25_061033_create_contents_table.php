<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('slug');
            $table->enum('access_type', ['private', 'public'])->default('public');
            $table->morphs('contentable');
            $table->string('url')->nullable();
            $table->enum('type', ['file', 'folder', 'url']);
            $table->unsignedBigInteger('basefolder_id');
            $table->foreign('basefolder_id')->references('id')->on('base_folders')->onDelete('cascade');
            // $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
};
