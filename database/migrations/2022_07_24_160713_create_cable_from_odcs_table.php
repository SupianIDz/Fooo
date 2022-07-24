<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cable_from_odcs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cable_line_id')->constrained()->cascadeOnDelete();
            $table->string('uuid');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('color');
            $table->float('weight')->default(20);
            $table->float('opacity')->default(0.7);
            $table->foreignId('port_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cable_from_odcs');
    }
};
