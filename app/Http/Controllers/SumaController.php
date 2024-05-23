<?php

namespace App\Http\Controllers;

class SumaController extends Controller
{
    public function sumar($num1, $num2)
    {
        $suma = $num1 + $num2;
        return response()->json(['suma' => $suma]);
    }
}
