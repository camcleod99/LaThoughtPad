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
            $table->integer('previous_thought')->nullable();
            $table->integer('next_thought')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thoughts', function (Blueprint $table) {
            $table->dropColumn('previous_thought');
            $table->dropColumn('next_thought');
            //
        });
    }
};
