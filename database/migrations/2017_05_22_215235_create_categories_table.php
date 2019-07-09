<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	// Creando la Tabla de Categoria.
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
	        $table->unsignedInteger('estado_id')->default(1);
	        $table->foreign('estado_id')->references('id')->on('estados');
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Alimenticios'],
            ['name' => 'Lubricantes'],
    
        ]);
        
        // Creando la Tabla de Subcategoria.
	
	    Schema::create('sub_categories', function (Blueprint $table) {
		    $table->engine = 'InnoDB';
		    $table->increments('id');
		    $table->unsignedInteger('categories_id');
		    $table->string('name', 100);
		    $table->foreign('categories_id')->references('id')->on('categories');
		    $table->unsignedInteger('estado_id')->default(1);
		    $table->foreign('estado_id')->references('id')->on('estados');
		    $table->timestamps();
	    });
	
	    DB::table('sub_categories')->insert([
		    ['categories_id' => '1', 'name' => 'Alimentos Farináceos'],
		    ['categories_id' => '2', 'name' => 'Grasas'],
		    ['categories_id' => '2', 'name' => 'Aceites'],
	    ]);
	    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
