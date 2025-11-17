<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('visions', function (Blueprint $table): void {
            $table->string('icon_path')->nullable()->after('image_path');
        });

        Schema::table('services', function (Blueprint $table): void {
            $table->string('icon_path')->nullable()->after('main_image');
        });
    }

    public function down(): void
    {
        Schema::table('visions', function (Blueprint $table): void {
            $table->dropColumn('icon_path');
        });

        Schema::table('services', function (Blueprint $table): void {
            $table->dropColumn('icon_path');
        });
    }
};
