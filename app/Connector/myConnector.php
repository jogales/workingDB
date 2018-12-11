<?php
/**
 * Created by PhpStorm.
 * User: Jose
 * Date: 2018-12-10
 * Time: 16:11
 */

namespace App\Connector;


use App\Categories;
use App\Employee;
use App\Product;

class myConnector
{
    protected $apiUrl;
    protected $config;
    public function __construct()
    {
        $this->apiUrl = 'https://api.bigcommerce.com/stores/'.env('BIG_STORE').'/v3/catalog';

        $this->config = [
            "Accepts: application/json",
            "Content-Type: application/json",
            "X-Auth-Client: ".env('BIG_API_CLIENT'),
            "X-Auth-Token: ".env('BIG_API_TOKEN'),
            "cache-control: no-cache"
        ];
    }

    function getAllEmployee()
    {
        $employees = Employee::all();
        return json_decode($employees);
    }

    function getCountEmployee()
    {
        $emp = Employee::all()->count();
        return $emp;
    }

    function getAllproducts($limit)
    {
        $products=$this->apicall('GET','/products?limit='.$limit);
        return $products;
    }

    function getAllcategories($limit)
    {
        $categories=$this->apicall('GET','/categories?limit='.$limit);
        return $categories;
    }

    function apicall($requestType,$url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $requestType,
            CURLOPT_HTTPHEADER => $this->config,
        ));

        $response = curl_exec($curl);
        return $this->response($response);

    }

    private function response($response){
        $this->originalResponse = json_decode($response);
        return json_decode($response)->data;
    }

    function syncCategories()
    {
        $categories = $this->getAllcategories(200);
        foreach ($categories as $key=>$value)
        {
            $data[] = array(
                'id' => $value->id,
                'name' => $value->name,
            );
        }
        foreach ($data as $category)
        {
            $cat = new Categories();
            $cat->id = $category['id'];
            $cat->title = $category['name'];
            $cat->save();
        }
        return 1;
    }

    function syncProducts()
    {
        $products = $this->getAllproducts(50);
        foreach ($products as $key=>$value)
        {
            $data[] = array(
                'id' => $value->id,
                'name' => $value->name,
                'price' => $value->price,
                'categories' => $value->categories
            );
        }
        foreach ($data as $product)
        {
            $prod = new Product();
            $prod->id = $product['id'];
            $prod->name = $product['name'];
            $prod->price = $product['price'];
            $prod->save();
            $this->match($product);
        }
        return 1;
    }

    function match($product)
    {
        $prodaux = Product::find($product['id']);
        $cataux = Categories::find($product['categories']);
        $prodaux->categories()->attach($cataux);
    }


    function getAllProductDB()
    {

    }

}