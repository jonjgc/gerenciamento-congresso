<?php

namespace App\Http\Controllers;

use App\Models\Trabalho;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $trabalhos = Trabalho::query()->orderBy('updated_at', 'desc')->paginate(20);
        return view('home', compact('trabalhos'));
    }
}
