<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class Images extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    //Problem foreign key constraint:
    //Lösung:
    //erst Tabelle(Migration) Images anlegen
    //dann migration für book mit foreign key anlegenen
    
    public function up()
    {
       Schema::create('images', function (Blueprint $table) {
            $table->increments('image_id');
            $table->string('filename');
            $table->string('path');
            $table->timestamps();
        });
        
        Artisan::call('db:seed');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
