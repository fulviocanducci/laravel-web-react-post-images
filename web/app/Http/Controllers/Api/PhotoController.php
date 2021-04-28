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
        $file = $request->file('image');
        if ($file); 
        {
            $ext = $file->extension();
            $model = $this->model->create(['description' => 'photo', 'filename' => 'f', 'ext' => 'e']);
            $name = 'image-' . str_pad($model->id, 5,"0", STR_PAD_LEFT).'.'.$ext;            
            $file->storeAs('', $name);
            $model->description = $name;
            $model->filename = $name;
            $model->ext = $ext;
            $model->save();
            return response()->json(['model' => $model->toArray()], 201);
        }
        return response()->json(['status' => 'error'], 404);
    }
}
