<?php

Route::get('pack', function () {

    return 'Calling from inside package.';

});

Route::get('countries', function () {

    $data = 'Qatar,Romania,Russia,Zimbabwe';
    $arr = explode(',', trim(preg_replace('/\s+/', ' ', $data)));
    // dd(($arr));
    $x = [];
    foreach ($arr as $item) {
        // $x.= '' .str_replace(' ','-',strtolower($item)) .''.',';
        // dd($item);
        // dd(trim(strtolower(str_replace(' ','-',$item))));
        $x[] = strtolower(str_replace(' ', '-', trim($item)));
        $y = '';
        foreach ($x as $value) {
            $y .= "'" . $value . "',";
        }
    }
    //    dd($y);

});