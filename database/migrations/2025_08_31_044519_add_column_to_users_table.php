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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cpf', 11)->after('email')->unique();
            $table->string('position')->after('cpf');
            $table->date('birth_date')->after('position');
            $table->string('cep', 8)->after('birth_date');
            $table->string('address')->after('cep');

            $table->foreignId('manager_id')
                ->nullable()
                ->after('address')
                ->comment('Referencia o usuário que é o gerente')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cpf');
            $table->dropColumn('position');
            $table->dropColumn('birth_date');
            $table->dropColumn('cep');
            $table->dropColumn('address');

            $table->dropForeign(['manager_id']);
            $table->dropColumn('manager_id');
        });
    }
};
