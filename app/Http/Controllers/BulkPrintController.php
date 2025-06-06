<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BulkPrintController extends Controller
{
    public function printAll()
    {
        $users = User::all();
        return view('prints.all-id', compact('users'));
    }
}
