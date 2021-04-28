<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    protected Photo $model;

    public function __construct(Photo $mode)
    {
        $this->model = $mode;
    }

    public function index()
    {
        $model = $this->model->all();
        return response()
            ->json($model, 200);
    }

    public function storage(Request $request)
    {
        $files = $request->allFiles();
        if (count($files) > 0) 
        {
            return $files;
        }
        return [];
    }
}
