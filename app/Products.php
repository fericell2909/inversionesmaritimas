<?php

namespace App;

use App\Products;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    // PrimaryKey
  protected $primaryKey = 'p_id';
  protected $table='products';
  
  public static function devuelveNombreProducto($id)
  {

    $products = Products::select('products.p_gname')
                     ->where('p_id',$id)
                     ->get();

    return $products[0]->p_gname;

  }

  public static function devuelveDatosProducto($id)
  {

    $products = Products::select('products.p_gname','products.p_bname')
                     ->where('p_id',$id)
                     ->get();

    return $products;

  }

public static function AumentarStockProducto($id,$stock)
{

 $cantidad = Products::select("products.p_quantity")
                      ->where("products.p_id",$id)
                      ->get();

         if ($id > 1) {
          
          $valores=array('p_quantity'=>intval($cantidad[0]->p_quantity) + $stock );

          Products::where('p_id',$id)
                ->update($valores);

            $valores = null;
            $cantidad = null;
         
         } else
         {
            $cantidad = null; 
         }
            

}

  public static function ActualizarStockProducto($id,$stock)
    {
        $cantidad = Products::select("products.p_quantity")
                      ->where("products.p_id",$id)
                      ->get();

         if ($id > 1) {
          
          $valores=array('p_quantity'=>intval($cantidad[0]->p_quantity) - $stock );

          Products::where('p_id',$id)
                ->update($valores);

            $valores = null;
            $cantidad = null;
         
         } else
         {
            $cantidad = null; 
         }
            
      
    }

  public static function ValidaStockProducto($id,$stock)
  {
    $cantidad = Products::select("products.p_quantity")
                      ->where("products.p_id",$id)
                      ->get();


    if ($id > 1) {
          
          if (intval($cantidad[0]->p_quantity) > $stock ) {
              $cantidad = null;   
              return true;
           } else {
              $cantidad = null;
              return false;
           }
            
        } else
        {
          return true;
        }

  } 

  public static function ListarProductos()
  {
    $productos = Products::select("products.p_gname","products.p_bname","products.p_price","products.p_id","products.p_quantity")
                            ->where('products.p_id','>',1)
                            ->get();
  
    return $productos;
  }


}
