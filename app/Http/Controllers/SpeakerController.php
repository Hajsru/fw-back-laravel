<?php

namespace App\Http\Controllers;

use App\Speaker;
use Illuminate\Http\Request;

class SpeakerController extends Controller
{
    public function index() {
        $speakers = Speaker::all();

        return response()->json($speakers);
    }
}
