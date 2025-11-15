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
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->boolean('is_spam')->default(false)->after('status');
            $table->decimal('spam_score', 3, 2)->default(0.00)->after('is_spam');
            $table->string('ip_address')->nullable()->after('spam_score');
            $table->text('user_agent')->nullable()->after('ip_address');
            $table->json('spam_reasons')->nullable()->after('user_agent');
            $table->timestamp('spam_checked_at')->nullable()->after('spam_reasons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn([
                'is_spam',
                'spam_score',
                'ip_address',
                'user_agent',
                'spam_reasons',
                'spam_checked_at'
            ]);
        });
    }
};
