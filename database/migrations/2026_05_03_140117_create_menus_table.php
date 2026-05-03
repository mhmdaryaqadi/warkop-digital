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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Nama menu: Kopi Hitam, Es Teh, dll
            $table->text('description');      // Penjelasan singkat menu
            $table->integer('price');         // Harga (pake integer aja biar gampang)
            $table->string('category');       // Kategori: Makanan, Minuman, atau Snack
            $table->string('image')->nullable(); // Link foto menu (boleh kosong dulu)
            $table->boolean('is_available')->default(true); // Stok ready atau nggak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
