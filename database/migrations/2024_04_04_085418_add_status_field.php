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
      Schema::table('thoughts', function (Blueprint $table) {
        // adds a text coloum that can only have the values of "Posted","Draft", or "Deleted"
        $table->enum('status', ['Posted', 'Draft', 'Deleted'])->default('Draft');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('thoughts', function (Blueprint $table) {
        if (Schema::hasTable('thoughts') && Schema::hasColumn('thoughts', 'status')) {
            $table->dropColumn('status');
        }
      });
    }

};
