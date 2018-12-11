<?php

namespace App\Http\Controllers;

use App\Connector\myConnector;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $conn;

    public function __construct()
    {
        $this->conn = new myConnector();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aux = Product::find(19525);
        dd($aux->categories);
        return view('products.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function fillTable()
    {
        $aux = Product::find(19525);
        dd($aux);
        foreach ($aux->categories as $cat){
            $dataa[] = $cat->title;
        }
        dd();
        $products = Product::All();
        foreach ($products as $key=>$value)
        {
            $data[] = array(
                'id' => $value->id,
                'name' => $value->name,
                'price' => $value->price,
            );
        }
        $dataCount = count($products);
        $json_data = array('recordsTotal' => $dataCount  , 'recordsFiltered' =>  $dataCount, 'data' =>  $data );
        return json_encode($json_data);
    }

    public function syncDB()
    {
        $this->conn->syncCategories();
        $this->conn->syncProducts();
        return view('products.index');
    }
}
