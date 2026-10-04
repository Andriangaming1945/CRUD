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
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 128);
            $table->string('email', 128);
            $table->text('password');
            $table->uuid('account_type_id');
            $table->string('status', 128);
            $table->string('identification_number', 128);
            $table->enum('identification_type', ['NIM', 'NIP']);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('account_type_id')
                ->references('id')
                ->on('account_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};