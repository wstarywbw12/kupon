<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // 4 digit tapi sediakan lebih aman
            $table->string('barcode_path')->nullable(); // storage path
            $table->boolean('used')->default(false);
            $table->timestamp('scanned_at')->nullable();
            $table->string('scanned_by')->nullable(); // optional: siapa yg scan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
