<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Verifica se a coluna já existe antes de tentar adicionar
            if (!Schema::hasColumn('users', 'tipo')) {
                $table->enum('tipo', ['admin', 'cliente'])
                    ->default('cliente')
                    ->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'tipo')) {
                $table->dropColumn('tipo');
            }
        });
    }
};