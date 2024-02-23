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
        Schema::create('adsenses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('banner_width', 5)->nullable();
            $table->string('banner_height', 5)->nullable();
            $table->string('banner_image', 191);
            $table->text('url');
            // $table->enum('position', [
            //     'page_top', 'page_bottom', 'page_left_side', 'page_right_side', 'before_content', 'after_content',
            // ]);
            $table->boolean('status')->default(false)->comment('0 - deactivate, 1 - activate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adsenses');
    }
};
