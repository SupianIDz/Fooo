<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up() : void
    {
        Schema::create('cables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tube_id')->constrained();
            $table->string('uuid');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('color');
            $table->float('weight')->default(20);
            $table->float('opacity')->default(0.7);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cables');
    }
};
