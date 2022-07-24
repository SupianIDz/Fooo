<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('join_closure_cables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cable_from_odc_line_id')->constrained()->cascadeOnDelete();
            $table->string('uuid');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('color');
            $table->float('weight')->default(20);
            $table->float('opacity')->default(0.7);
            $table->foreignId('port_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('join_closure_cables');
    }
};
