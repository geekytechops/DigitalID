<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('homepage-template2');
    }

    public function login(): string
    {
        $rememberedEmail = $this->request->getCookie('rememberMe');
        return view('login', ['rememberedEmail' => $rememberedEmail]);
    }

    public function register(): string
    {
        return view('register');
    }

    public function dashboard(): string
    {
    
        return view('dashboard');
    }
    public function users(): string
    { 
        return view('users');
    }

}
