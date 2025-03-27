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
        Schema::create('detail_type_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_information_id')->constrained('type_information')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('detail');
            $table->foreignId('field_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('comesCombo')->default(false);
            $table->integer('order');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_type_information');
    }
};
