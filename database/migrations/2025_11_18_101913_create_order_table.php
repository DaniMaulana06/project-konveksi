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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('product');
            $table->string('nama_customer');
            $table->string('no_telp');
            $table->string('asal_instansi');
            $table->integer('jumlah_order');
            $table->decimal('harga_total', 15, 2);
            $table->string('file_panduan');
            $table->foreignId('created_by')->constrained('users');
            $table->enum('status_order', ['pending', 'proses', 'selesai', 'dikirim'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
