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
        Schema::create('price_lists', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("parent_id")->nullable();

            $table->string('title');
            $table->string('slug')->unique();
            $table->string("short")->nullable();
            $table->string("accent")->nullable();
            $table->text("description")->nullable();
            $table->text("info")->nullable();

            $table->unsignedBigInteger("priority")->default(0);
            $table->dateTime("published_at")->nullable();

            $table->dateTime("show_nested")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_lists');
    }
};
