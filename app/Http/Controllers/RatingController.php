<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index() {
        $ratings = Rating::all();

        return response()->json($ratings);
    }
}
