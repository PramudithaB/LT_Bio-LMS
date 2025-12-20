<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Only add columns if they don't already exist (safe to run on existing DB)
        if (! Schema::hasColumn('users', 'whatsapp_number')
            || ! Schema::hasColumn('users', 'id_number')
            || ! Schema::hasColumn('users', 'address')
            || ! Schema::hasColumn('users', 'exam_year')) {

            Schema::table('users', function (Blueprint $table) {
                if (! Schema::hasColumn('users', 'whatsapp_number')) {
                    $table->string('whatsapp_number')->nullable()->default(null)->after('usertype');
                }
                if (! Schema::hasColumn('users', 'id_number')) {
                    $table->string('id_number')->nullable()->default(null)->after('whatsapp_number');
                }
                if (! Schema::hasColumn('users', 'address')) {
                    $table->text('address')->nullable()->default(null)->after('id_number');
                }
                if (! Schema::hasColumn('users', 'exam_year')) {
                    $table->string('exam_year')->nullable()->default(null)->after('address');
                }
            });
        }
    }

    public function down(): void
    {
        // Drop columns if they exist
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'exam_year')) {
                $table->dropColumn('exam_year');
            }
            if (Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('users', 'id_number')) {
                $table->dropColumn('id_number');
            }
            if (Schema::hasColumn('users', 'whatsapp_number')) {
                $table->dropColumn('whatsapp_number');
            }
        });
    }
};
