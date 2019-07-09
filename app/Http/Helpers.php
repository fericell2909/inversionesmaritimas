<?php

/*
 * Set active class
 */

function set_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array) $path) ? $active : '';
}

/*
 *  get setting from datab
 */

function get_setting()
{
    $setting = \App\Settings::all()->first();

    if ($setting !== null) {
        return $setting;
    }
}

/*
 *  Check color if white or black
 */

function get_colors()
{
    if (!empty(get_setting()) && get_setting()->color === 'white') {
        echo 'white';
    } else {
        echo 'black';
    }
}

/*
 *  Select the currently language
 */

function get_language()
{
    if (!empty(get_setting()) && get_setting()->language === 'en') {
        echo '<img src="../img/US.png"> ' . trans('setting.english');
    } elseif (!empty(get_setting()) && get_setting()->language === 'fr') {
        echo '<img src="../img/FR.png"> ' . trans('setting.france');
    } elseif (!empty(get_setting()) && get_setting()->language === 'es') {
        echo '<img src="../img/ES.png"> ' . trans('setting.espanol');
    }
}

/*
 *  Select the currently currency
 */

function get_currency()
{
    if (!empty(get_setting()) && get_setting()->currency === 'dollar') {
        echo '<i class="fa fa-dollar" ></i> Dolar';
    } elseif (get_setting()->currency === 'soles') {
        echo 'S/. Nuevo Sol';
    }elseif (get_setting()->currency === 'euro') {
        echo '<i class="fa fa-euro"></i> Euro';
    } elseif (get_setting()->currency === 'krw') {
        echo '<i class="fa fa-krw"></i> KRW';
    } elseif (get_setting()->currency === 'gbp') {
        echo '<i class="fa fa-gbp"></i> GBP';
    } elseif (get_setting()->currency === 'try') {
        echo '<i class="fa fa-try"></i> Turkish Lira';
    } elseif (get_setting()->currency === 'dn') {
        echo 'SAR';
    } elseif (get_setting()->currency === 'aed') {
        echo 'AED';
    }
}
/*
 *  Select the currently currency symbols
 */
function get_currencySymbols()
{
    if (!empty(get_setting()) && get_setting()->currency === 'dollar') {
        echo '<i class="fa fa-dollar" ></i> ';
    } elseif (get_setting()->currency === 'euro') {
        echo '<i class="fa fa-euro"></i> ';
    } elseif (get_setting()->currency === 'soles') {
        echo 'S/. ';
    } elseif (get_setting()->currency === 'krw') {
        echo '<i class="fa fa-krw"></i>';
    } elseif (get_setting()->currency === 'gbp') {
        echo '<i class="fa fa-gbp"></i>';
    } elseif (get_setting()->currency === 'try') {
        echo '<i class="fa fa-try"></i>';
    } elseif (get_setting()->currency === 'dn') {
        echo 'SAR';
    } elseif (get_setting()->currency === 'aed') {
        echo 'AED';
    }
}
// mestrada
/*
 *  Count out stock product
 */
function outStockCount()
{
    $outstock = DB::table('products')
        ->where('p_quantity', '<', '21')
        ->whereNotIn('p_id', [1])
        ->count();
    return $outstock;
}

/*
 *  Count expired product
 */

function diferenciaDias($fecha)
{
      
    $fecha= strtotime($fecha); // convierte la fecha de formato mm/dd/yyyy a marca de tiempo
    $dia=date("d",$fecha); // día del mes en número
    $mes=date("m",$fecha); // número del mes de 01 a 12
    $ano=date("Y",$fecha);
    
    $diaactual=date("d",time());
    $mesactual=date("m",time());
    $anoactual=date("Y",time());
    
    //echo $fechaactual;
    
    $fecha1=mktime(0,0,0,$mesactual,$diaactual,$anoactual);
    $fecha2=mktime(0,0,0,$mes,$dia,$ano);
 
    $diferencia=$fecha2-$fecha1;
    $dias=$diferencia/(60*60*24);
    $dias=floor($dias);
    
    if($dias>0)
    {
        return "".$dias." dias"; 
    }
    else
    {
        return "Expirado";  
    }
 
 }

 function NumerodiferenciaDias($fecha)
{
      
    $fecha= strtotime($fecha); // convierte la fecha de formato mm/dd/yyyy a marca de tiempo
    $dia=date("d",$fecha); // día del mes en número
    $mes=date("m",$fecha); // número del mes de 01 a 12
    $ano=date("Y",$fecha);
    
    $diaactual=date("d",time());
    $mesactual=date("m",time());
    $anoactual=date("Y",time());
    
    //echo $fechaactual;
    
    $fecha1=mktime(0,0,0,$mesactual,$diaactual,$anoactual);
    $fecha2=mktime(0,0,0,$mes,$dia,$ano);
 
    $diferencia=$fecha2-$fecha1;
    $dias=$diferencia/(60*60*24);
    $dias=floor($dias);
    return $dias; 
 
 }
 
 
function expiredCount()
{
    $expired = DB::table('products')
        ->join('categories', 'products.p_cat', '=', 'categories.id')
        ->whereRaw('p_exdate < CURDATE()')
        ->whereNotIn('p_id', [1])
        ->count();
    return $expired;
}

function porvencer()
{
    $porvencer = DB::table('products')
        ->whereRaw('DATE_SUB(p_exdate, INTERVAL 60 DAY) < CURDATE()')
        ->whereNotIn('p_id', [1])
        ->count();
    return $porvencer;
}

// Sales and Purchases

function check($yasterday,$today)
{
      //Calc
      if(isset($today) && $today > 0){
        $today1 = (1 - $yasterday / $today) * 100;
        $today_result = number_format($today1);
        }else{
        $today_result = 0;
        }
        //if number is 0
        if(isset($yasterday) && $yasterday > 0){
        $yasterday1= (1 - $today / $yasterday) * 100;
        $yasterday_result = number_format($yasterday1);
        }else{
        $yasterday_result = 0;
        }
       if(isset($today)){
       echo substr($today,0,5).get_currencySymbols().' |';
       }else{
       echo '0'.get_currencySymbols().' |';
       }
       if($today_result > $yasterday_result){
       echo '<small style="color:#2ecc71;"> '.$today_result.' <i class="fa fa-caret-up" aria-hidden="true"></i> '. trans("analysis.now").'</small><br>';
       }else{
       echo '<small style="color:#e74c3c;"> '.$today_result.' <i class="fa fa-caret-down" aria-hidden="true"></i> '.trans("analysis.now").'</small><br>';
       }
       if(isset($yasterday)){
       echo substr($yasterday,0,5).get_currencySymbols().' |';
       }else{
       echo '0'.get_currencySymbols().' |';
       }
       if($yasterday_result > $today_result){
       echo '<small style="color:#2ecc71;"> '.$yasterday_result.' <i class="fa fa-caret-up" aria-hidden="true"></i> 
       '. trans("analysis.yesterday").'</small><br>';
       }else{
       echo '<small style="color:#e74c3c;"> '.$yasterday_result.' <i class="fa fa-caret-down" aria-hidden="true"></i> 
       '.trans("analysis.yesterday").'</small><br>';
       }
    
}
function check2($yasterday,$today)
{
	//Calc
	if(isset($today) && $today > 0){
		$today1 = (1 - $yasterday / $today) * 100;
		$today_result = number_format($today1);
	}else{
		$today_result = 0;
	}
	//if number is 0
	if(isset($yasterday) && $yasterday > 0){
		$yasterday1= (1 - $today / $yasterday) * 100;
		$yasterday_result = number_format($yasterday1);
	}else{
		$yasterday_result = 0;
	}
	if(isset($today)){
		echo substr($today,0,5).get_currencySymbols().' |';
	}else{
		echo '0'.get_currencySymbols().' |';
	}
	if($today_result > $yasterday_result){
		echo '<small style="color:#2ecc71;"> '.$today_result.' <i class="fa fa-caret-up" aria-hidden="true"></i> '. trans("analysis.now").'</small><br>';
	}else{
		echo '<small style="color:#e74c3c;"> '.$today_result.' <i class="fa fa-caret-down" aria-hidden="true"></i> '.trans("analysis.now").'</small><br>';
	}
	if(isset($yasterday)){
		echo substr($yasterday,0,5).get_currencySymbols().' |';
	}else{
		echo '0'.get_currencySymbols().' |';
	}
	if($yasterday_result > $today_result){
		echo '<small style="color:#2ecc71;"> '.$yasterday_result.' <i class="fa fa-caret-up" aria-hidden="true"></i>
       '. trans("analysis.yesterday").'</small><br>';
	}else{
		echo '<small style="color:#e74c3c;"> '.$yasterday_result.' <i class="fa fa-caret-down" aria-hidden="true"></i>
       '.trans("analysis.yesterday").'</small><br>';
	}
	
}

// Product and customer
function product($yasterday,$today)
{
    //Calc
    if(isset($today) && $today > 0){
        $today1 = (1 - $yasterday / $today) * 100;
        $today_result = number_format($today1);
    }else{
        $today_result = 0;
    }
    //if number is 0
    if(isset($yasterday) && $yasterday > 0){
        $yasterday1= (1 - $today / $yasterday) * 100;
        $yasterday_result = number_format($yasterday1);
    }else{
        $yasterday_result = 0;
    }
    if(isset($today)){
        echo substr($today,0,5).' |';
    }else{
        echo '0'. '|';
    }
    if($today_result > $yasterday_result){
        echo '<small style="color:#2ecc71;"> '.$today_result.' <i class="fa fa-caret-up" aria-hidden="true"></i> '. trans("analysis.now").'</small><br>';
    }else{
        echo '<small style="color:#e74c3c;"> '.$today_result.' <i class="fa fa-caret-down" aria-hidden="true"></i> '.trans("analysis.now").'</small><br>';
    }
    if(isset($yasterday)){
        echo substr($yasterday,0,5).' |';
    }else{
        echo '0'. '|';
    }
    if($yasterday_result > $today_result){
        echo '<small style="color:#2ecc71;"> '.$yasterday_result.' <i class="fa fa-caret-up" aria-hidden="true"></i> 
       '. trans("analysis.yesterday").'</small><br>';
    }else{
        echo '<small style="color:#e74c3c;"> '.$yasterday_result.' <i class="fa fa-caret-down" aria-hidden="true"></i> 
       '.trans("analysis.yesterday").'</small><br>';
    }

}
