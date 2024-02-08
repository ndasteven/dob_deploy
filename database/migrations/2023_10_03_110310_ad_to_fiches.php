<?php

use App\Models\dren;
use App\Models\ecole;
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
        Schema::table('fiches', function (Blueprint $table) {
            $table->foreignIdFor(ecole::class)->nullable()->constrained()->cascadeOnDelete() ;
            $table->foreignIdFor(dren::class)->nullable()->constrained()->cascadeOnDelete() ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fiches', function (Blueprint $table) {
            $table->dropForeignIdFor(ecole::class);
            $table->dropForeignIdFor(dren::class);
        });
    }
};
