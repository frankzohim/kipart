<?php

namespace App\Http\Controllers\Api\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    public function getImage($path){
        echo Storage::url($path);
    }
}
