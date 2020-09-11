<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\FileModel;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $code = 400;
            $status = 'file_cant_be_generated';
            $data = null;

            $isFileValid = $request->validate([
                'image' => 'mimes:jpeg,png,jpg|max:5120',
            ]);

            if ($isFileValid) {
                $image = $request->file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = explode('.',$image->getFilename())[0].'.'.$extension;
                Storage::disk('public')->put($filename,  File::get($image));
                $path = 'uploads/'.$filename;

                $data = new FileModel();
                $data->path = $path;
                $data->save();

                $code = 200;
                $status = 'file_generated';
            }
        }

        return response()->json([
            "code" => $code,
            "status" => $status,
            "data" => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
