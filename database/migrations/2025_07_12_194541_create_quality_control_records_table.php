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
        Schema::create('quality_control_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('batch_id');
            $table->date('inspection_date');
            $table->unsignedBigInteger('inspector_id');
            $table->string('result');
            $table->text('notes');
            $table->foreign('batch_id')->references('id')->on('production_batches');
            $table->foreign('inspector_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_control_records');
    }
};
