<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Nota;

class NotasController extends Controller
{
    public function index(Request $request)
    {
        $mY = $request->month;
        $mes_ano = date('m/Y', strtotime($mY));

        if ($mY != null) 
        {
        $notas = DB::table('notas')
            ->where('mes_ano', $mes_ano)
            ->orderBy('mes_ano', 'DESC')
            ->get();

        } else 
        {
        $notas = DB::table('notas')
            ->where('mes_ano',date('m/Y'))
            ->orderBy('mes_ano', 'DESC')
            ->get();
        } 

        return view('welcome', compact('notas'));
    }

    public function search()
    {
        // $search = request('search');

        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($search) {
            $notas = Nota::where('emitente', 'like', '%'.$search.'%')
            ->orWhere('serie', 'like', '%'.$search.'%')
            ->orWhere('uf', 'like', '%'.$search.'%')
            ->orWhere('n', 'like', '%'.$search.'%')
            ->orWhere('valor', 'like', '%'.$search.'%')
            ->get(); 

        } else {
            $notas = Nota::all();
        }

        return view('welcome', ['notas' => $notas]);
    }
}
