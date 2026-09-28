<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('trade');
            $table->string('crew_size');
            $table->string('phone');
            $table->string('email');
            $table->text('headache');
            $table->string('preferred_contact_method');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
