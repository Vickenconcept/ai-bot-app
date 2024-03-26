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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->constrained('users');
            $table->string('slug')->unique();
            $table->foreignId('bot_id')->nullable()->constrained('bots');
            $table->text('title');
            $table->text('type');
            $table->json('avatar')->nullable();
            $table->text('lang')->nullable();
            $table->json('image_link')->nullable();
            $table->json('temp_three')->nullable();
            $table->json('temp_four')->nullable();
            $table->json('temp_five')->nullable();
            $table->json('temp_six')->nullable();
            $table->json('users_contact_info')->nullable();
            $table->enum('template', ['temp1', 'temp2', 'temp3', 'temp4', 'temp5', 'temp6'])->default('temp1');
            $table->text('layout')->nullable();
            $table->text('nav_bg_color')->nullable();
            $table->text('nav_col')->nullable();
            $table->text('head_title')->nullable();
            $table->text('head_subtitle')->nullable();
            $table->text('position')->nullable();
            $table->text('launcher_size')->nullable();
            $table->text('launcher_color')->nullable();
            $table->text('launcher_icon')->nullable();
            $table->text('logo')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            // $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
