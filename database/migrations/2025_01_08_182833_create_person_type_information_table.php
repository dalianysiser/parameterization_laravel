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
        Schema::create('person_type_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_information_id')->constrained('type_information')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('detail_type_information_id')->constrained('detail_type_information')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('consecutive');
            $table->string('field_1')->nullable();
            $table->date('field_2')->nullable();
            $table->integer('field_3')->nullable();
            $table->decimal('field_4')->nullable();
            $table->boolean('field_5')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_type_information');
    }
};
