<?php

namespace App\Controllers;

class dashboardcontroller
{
    public function index()
    {

        $this->adminAuth();

        return view('admin/dashboard');
    }

    private function adminAuth()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['id'])) {
            header('Location: /login');
            exit;
        }
    }
}