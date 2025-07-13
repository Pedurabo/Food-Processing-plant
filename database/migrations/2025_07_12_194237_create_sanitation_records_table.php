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
        Schema::create('sanitation_records', function (Blueprint $table) {
            $table->id();
            $table->string('area');
            $table->date('sanitation_date');
            $table->unsignedBigInteger('performed_by');
            $table->text('notes');
            $table->string('status');
            $table->foreign('performed_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanitation_records');
    }
};
