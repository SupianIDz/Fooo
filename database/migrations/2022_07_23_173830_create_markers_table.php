<?php

use App\Models\Marker;
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
        Schema::create('markers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('type')->default(Marker::TYPE_POLE);
            $table->string('address');
            $table->point('location');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('markers', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('markers');
        });
    }

    /**
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('markers');
    }
};
