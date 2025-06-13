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
        Schema::create('filiale', function (Blueprint $table) {
            $table->id();
            $table->integer('secteur_id');
            $table->string('denomination')->nullable();
            $table->string('affiliation')->nullable();
            $table->string('sigle_commercial')->nullable();
            $table->date('date_creation')->nullable();
            $table->decimal('capital_social', 15, 2);
            $table->string('nom_dg')->nullable();
            $table->string('photo_dg')->nullable();
            $table->string('site_web')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('email')->nullable();
            $table->string('fix')->nullable();
            $table->string('telephone')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiale');
    }
};
