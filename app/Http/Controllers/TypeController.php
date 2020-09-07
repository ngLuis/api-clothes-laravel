<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeModel;
use Illuminate\Support\Facades\DB;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $typeToShow = request('typeToShow');
        $data = array();
        $status = 'types_founded';
        $code = 200;

        if (isset($typeToShow)) {
            if (strtolower($typeToShow) === 'type') {
                $data = DB::table('types')->whereNull('parentId')->get();
            } else if (strtolower($typeToShow) === 'subtype') {
                $data = DB::table('types')->whereNotNull('parentId')->get();
            }
        } else {
            
            $data = TypeModel::all();
        }

        if (count($data) === 0) {
            $status = 'types_cant_be_founded';
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
        $data = new TypeModel();
        $status = 'type_created';
        $code = 200;
        $parentId = $request->input('parentId');

        $data->name = $request->input('name');

        if (isset($parentId)) {
            $status = 'subtype_created';
            $data->parentId = $parentId;
        }

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
        $data = TypeModel::find($id);
        $code = 404;
        $status = 'type_cant_be_updated';
        $parentId = $request->input('parentId');

        if (!isset($parentId)) {
            $status = 'subtype_cant_be_updated';
        }

        if (isset($data)) {
            $code = 200;
            $status = 'type_updated';
            $data->update($request->all());

            if (isset($parentId)) {
                $status = 'subtype_updated';
            }
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
        $data = TypeModel::find($id);
        $code = 404;
        $status = 'cant_be_deleted';
        

        if (isset($data)) {
            $parentId = $data->parentId;
            $code = 200;
            if (isset($parentId)) {
                $status = 'subtype_deleted';
            } else {
                $status = 'type_deleted';
            }
            $data->delete();
        }

        return response()->json([
            "data" => $data,
            "status" => $status,
            "code" => $code
        ]);
    }
}
