<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadgeSize extends Model
{
    

    // public function badge_discounts()
    // {
    //     return $this->hasMany('App\BadgeDiscount','badge_size_id');
    // }

    // public function cart(){
    // 	 return $this->belongsTo('App\Cart', 'badge_size_id', 'id');
    // }

  
  

    function convert_decimal_to_fraction($decimal){


    $big_fraction = $this->float2rat($decimal);
    $num_array = explode('/', $big_fraction);
    $numerator = $num_array[0];
    $denominator = $num_array[1];
    $whole_number = floor( $numerator / $denominator );
    $numerator = $numerator % $denominator;

    if($numerator == 0){
        return $whole_number;
    }else if ($whole_number == 0){
        return $numerator . '/' . $denominator;
    }else{
       
/*return <<<HTML
    {$whole_number}<sup>{$numerator}</sup>&frasl;<sub>{$denominator}</sub>
    
HTML;*/

       return $whole_number.'<sup>'.$numerator.'</sup>&frasl;<sub>'.$denominator.'</sub>';
       
        
        //$whole_number . ' ' . $numerator . '/' . $denominator;
    }
}

function float2rat($n, $tolerance = 1.e-6) {
	$n = (float)$n;
    $h1=1; $h2=0;
    $k1=0; $k2=1;
    $b = 1/$n;
    do {
        $b = 1/$b;
        $a = floor($b);
        $aux = $h1; $h1 = $a*$h1+$h2; $h2 = $aux;
        $aux = $k1; $k1 = $a*$k1+$k2; $k2 = $aux;
        $b = $b-$a;

    } while (abs($n-$h1/$k1) > $n*(float)$tolerance);
    return "$h1/$k1";
}

}