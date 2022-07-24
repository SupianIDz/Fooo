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
        Schema::create('tube_lines', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('tube_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->foreignId('attached_on')->nullable()->constrained('markers');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('tube_lines');
    }
};
