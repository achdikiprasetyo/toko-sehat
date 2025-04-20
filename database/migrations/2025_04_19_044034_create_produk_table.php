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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->decimal('harga', 10, 2);  // Harga produk
            $table->integer('stock');  // Jumlah stok produk
            $table->text('deskripsi');  // Deskripsi produk
            $table->string('foto')->nullable(); // Kolom untuk menyimpan nama file foto
            $table->foreignId('kategori_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();  // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
