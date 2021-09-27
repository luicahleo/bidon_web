<?php

namespace App\Http\Controllers\Nivel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('nivel.index');
    }
}
