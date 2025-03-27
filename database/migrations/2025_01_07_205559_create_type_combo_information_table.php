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
        Schema::create('type_combo_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_information_id')->constrained('type_information')->onDelete('cascade')->onUpdate('cascade');
            $table->string('type');
            $table->string('code');
            $table->foreignId('detail_type_information_id')->constrained('detail_type_information')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_combo_information');
    }
};
