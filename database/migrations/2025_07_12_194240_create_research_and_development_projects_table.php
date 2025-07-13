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
        Schema::create('research_and_development_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('lead_researcher_id');
            $table->text('description');
            $table->string('status');
            $table->foreign('lead_researcher_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_and_development_projects');
    }
};
