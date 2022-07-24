<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cable_lines', function (Blueprint $table) {
            $table->id();

            $table->string('uuid');
            $table->foreignId('cable_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->foreignId('attached_on')->nullable()->constrained('markers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cable_lines');
    }
};
