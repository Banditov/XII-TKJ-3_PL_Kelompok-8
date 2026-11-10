<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sim_records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nis')->unique();
            $table->boolean('has_sim')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sim_records');
    }
};
