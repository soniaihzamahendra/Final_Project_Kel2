<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

  
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        return match($user->role) {
            'owner'          => redirect()->route('owner.dashboard'),
            'manajer_toko'   => redirect()->route('manajer.dashboard'),
            'supervisor'     => redirect()->route('supervisor.dashboard'),
            'kasir'          => redirect()->route('kasir.dashboard'),
            'pegawai_gudang' => redirect()->route('gudang.dashboard'),
            default          => redirect('/'),
        };
    }
}