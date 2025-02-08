<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('recitations', function (Blueprint $table) {
            $table->date('date')->after('user_id'); // Store daily recitation data
        });
    }

    public function down(): void
    {
        Schema::table('recitations', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
};
