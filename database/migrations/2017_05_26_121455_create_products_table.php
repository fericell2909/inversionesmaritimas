<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('p_id');
            $table->string('p_gname', 50)->nullable();
            $table->string('p_bname', 50)->nullable();
            $table->text('p_desc', 255)->nullable();
            $table->string('p_country', 30)->nullable();
            $table->string('p_idnumber', 30)->nullable();
            $table->dateTime('p_imdate')->nullable();
            $table->dateTime('p_exdate')->nullable();
            $table->text('p_seffect', 200)->nullable();
            $table->Integer('p_cat')->unsigned();
       
            $table->integer('p_quantity')->nullable();
            $table->integer('p_price')->nullable();
            $table->string('p_imname', 50)->nullable();
            $table->integer('p_imprice')->nullable();
            $table->integer('p_discount')->nullable();
            $table->string('p_image', 30)->nullable();
            $table->string('p_icon', 10)->nullable();
            $table->string('p_barcodeg', 40)->nullable();
            $table->foreign('p_cat')->references('id')->on('sub_categories');
            $table->timestamps();
        });


           DB::table('products')->insert([
            'p_gname'=>'Consulta Medica',
            'p_bname'=>'Consulta Medica',
            'p_desc'=>'Consulta Medica',
            'p_country'=>'Peru',
            'p_idnumber'=>0,
            'p_imdate'=>date_create()->format('Y-m-d H:i:s'),
            'p_exdate'=>date_create()->format('Y-m-d H:i:s'),
            'p_seffect'=>'Consulta Medica',
            'p_cat'=>1,
            'p_quantity'=>9999999,
            'p_price'=>25,
            'p_imname'=>'',
            'p_imprice'=>25,
            'p_discount'=>0,
            'p_image'=>'',
            'p_icon'=>'SA',
            'p_barcodeg'=>'',
            'created_at'=>date_create()->format('Y-m-d H:i:s'),
            'updated_at'=>date_create()->format('Y-m-d H:i:s'),
                    ]);

           
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
