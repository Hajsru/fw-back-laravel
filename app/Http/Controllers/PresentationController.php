<?php

namespace App\Http\Controllers;

use App\Presentation;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function index() {
        $presentations = Presentation::all();

        return response()->json($presentations);
    }
}
