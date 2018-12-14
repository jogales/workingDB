<?php

namespace App\Http\Controllers;

use App\Connector\myConnector;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $productsTotal = Product::All();
        $products = DB::table('products')->skip(request('start'))->take(request('length'))->get();
        foreach ($products as $key=>$value)
        {
            $fillCategory = $this->findCategory($value->id);
            $data[] = array(
                'id' => $value->id,
                'name' => $value->name,
                'price' => $value->price,
                'categories' => $fillCategory
            );
        }
        $dataCount = count($productsTotal);
        $json_data = array('recordsTotal' => $dataCount  , 'recordsFiltered' =>  $dataCount, 'data' =>  $data );
        return json_encode($json_data);
    }

    function findCategory($id)
    {
        $product = Product::find($id);
        $titles = [];
        foreach ($product->categories as $category){
            $titles[] = $category->title;
        }
        return $titles;
    }

    public function syncDB()
    {
        $this->conn->syncCategories();
        $this->conn->syncProducts();
        return redirect('/products');

    }
}
