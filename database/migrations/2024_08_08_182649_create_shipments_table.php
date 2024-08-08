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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('shipper');
            $table->string('image');
            $table->float('weight');
            $table->text('description');
            $table->float('price')->default(0);
            $table->enum('status', ['Pending', 'Progress', 'Done']);
            $table->timestamps();
            $table->string('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
