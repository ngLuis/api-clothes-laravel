<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SizeModel;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SizeModel::all();
        $status = "size_found";
        $code = 200;

        if ($data->count() === 0) {
            $status = "size_cant_be_found";
            $code = 404;
        }

        return response()->json([
            "data" => $data,
            "status" => $status,
            "code" => $code
        ]);
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
        $data = new SizeModel();
        $status = 'size_created';
        $code = 200;

        $data->name = $request->input('name');

        $data->save();

        return response()->json([
            "data" => $data,
            "status" => $status,
            "code" => $code
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
        $data = SizeModel::find($id);
        $status = 'size_cant_be_found';
        $code = 404;

        if (isset($data)) {
            $status = 'size_updated';
            $code = 200;
            $data->update($request->all());
        }
        
        return response()->json([
            "data" => $data,
            "status" => $status,
            "code" => $code
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = SizeModel::find($id);
        $status = 'size_cant_be_deleted';
        $code = 404;

        if ( isset($data) ) {
            $status = 'size_deleted';
            $code = 200;
            $data->delete();
        }

        return response()->json([
            "data" => $data,
            "status" => $status,
            "code" => $code
        ]);
    }
}
