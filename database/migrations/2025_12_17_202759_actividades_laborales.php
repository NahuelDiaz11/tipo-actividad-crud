<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actividades_laborales', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion')->unique();
            $table->integer('orden_adicional')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_upd')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actividades_laborales');
    }
};
