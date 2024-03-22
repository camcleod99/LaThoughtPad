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
        //Create three fields for the tags
        Schema::table('thoughts', function (Blueprint $table) {
          $table->string('tag_1')->nullable();
          $table->string('tag_2')->nullable();
          $table->string('tag_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      if (Schema::hasTable('thoughts')) {
        $columnsToDrop = ['tag_1', 'tag_2', 'tag_3'];
        Schema::table('thoughts', function (Blueprint $table) use ($columnsToDrop) {
          foreach ($columnsToDrop as $column) {
            if (Schema::hasColumn('thoughts', $column)) {
              $table->dropColumn($column);
            }
          }
        });
      }
    }
};
