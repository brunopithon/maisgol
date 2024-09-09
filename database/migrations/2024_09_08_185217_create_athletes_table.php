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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('responsible_name');
            $table->string('responsible_CPF');
            $table->string('responsible_email');
            $table->string('responsible_phone');
            $table->string('cpf')->unique();
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female', 'others']);
            $table->string('cep', 9);
            $table->string('street', 255);
            $table->string('number', 255)->nullable();
            $table->string('complement', 255)->nullable();
            $table->string('neighborhood', 255);
            $table->string('city', 255);
            $table->string('state', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
