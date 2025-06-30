<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function show($id)
    {
        return view('journal2', ['journalId' => $id]);
    }
}

