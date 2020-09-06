<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProductModel::all();
        $status = 200;
        $code = 'products_finded';

        if (count($data) === 0) {
            $status = 404;
            $code = 'products_cant_be_found';
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
        $data = new ProductModel();
        $status = 200;
        $code = 'product_created';

        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->sizeId = $request->input('size'); // We need to create sizes controller to manipulate
        $data->type = $request->input('type'); // We need to create types controller to manipulate
        $data->subType = $request->input('subType'); // We need to create subtypes controller to manipulate
        $data->color = $request->input('color');
        $data->price = $request->input('price');
        $data->stock = $request->input('stock');

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
        $data = ProductModel::find($id);

        $status = "product_cant_be_found";
        $code = 404;

        if (isset($data)) {
            $status = "product_updated";
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
        $data = ProductModel::find($id);
        $status = 'product_cant_be_found';
        $code = 404;

        if (isset($data)) {
            $status = 'product_deleted';
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
