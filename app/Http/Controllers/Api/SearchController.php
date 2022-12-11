<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search($term){

        $travel=Travel::with('path.travels')->get();

        return $travel;
    }
}
