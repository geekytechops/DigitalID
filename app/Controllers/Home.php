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
        $data['pageTitle'] = "Dashboard"; 
        return view('dashboard',$data);
    }
    public function users(): string
    {
        $data['pageTitle'] = "Users"; 
        return view('users',$data);
    }
}
