<?php
namespace App\Services\Stock;

use Illuminate\Support\Facades\Auth;
use App\User;

class AuthService
{
    public function login($payload)
    {
        $payload = collect($payload);
        $credentials = $payload->only('email', 'password');
        
        return Auth::attempt($credentials->toArray()) ?? 0;
    }

    public function logout()
    {
        Auth::logout();
        return 1;
    }
}
