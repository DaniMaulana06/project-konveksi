<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis'); // 'order', 'produksi', 'vendor', 'bahan'
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('icon')->default('fa-bell');
            $table->string('warna')->default('primary'); // primary, success, warning, danger, info
            $table->unsignedBigInteger('reference_id')->nullable(); // ID dari order/produksi/dll
            $table->string('reference_type')->nullable(); // Model class name
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};