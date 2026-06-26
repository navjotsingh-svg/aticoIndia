<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('product_queries') && ! Schema::hasColumn('product_queries', 'file_name')) {
            Schema::table('product_queries', function (Blueprint $table) {
                $table->string('file_name', 1000)->nullable()->after('message');
            });
        }

        if (Schema::hasTable('request_quotes') && ! Schema::hasColumn('request_quotes', 'file_name')) {
            Schema::table('request_quotes', function (Blueprint $table) {
                $table->string('file_name', 1000)->nullable()->after('query');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('product_queries', 'file_name')) {
            Schema::table('product_queries', function (Blueprint $table) {
                $table->dropColumn('file_name');
            });
        }

        if (Schema::hasColumn('request_quotes', 'file_name')) {
            Schema::table('request_quotes', function (Blueprint $table) {
                $table->dropColumn('file_name');
            });
        }
    }
};
