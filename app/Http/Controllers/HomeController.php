<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        // Definir el tipo de usuario para el mensaje
        $userType = match($user->role) {
            'admin' => 'Administrador',
            'staff' => 'Staff',
            'profesor' => 'Profesor',
            'estudiante' => 'Estudiante',
            default => 'Usuario'
        };

        return view('home', compact('user', 'userType'));
    }
}