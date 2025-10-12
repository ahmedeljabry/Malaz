<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('visions', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('head_title_en')->nullable();
            $table->string('head_title_ar')->nullable();
            $table->longText('body_en')->nullable();
            $table->longText('body_ar')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visions');
    }
};

