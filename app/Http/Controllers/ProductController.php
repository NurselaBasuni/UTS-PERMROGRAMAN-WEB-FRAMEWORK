<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //menambahkan data ke database
    public function store(Request $request) {
        //memvalidasi inputan
        $validator = Validator::make($request->all(),[
            'product_name' => 'required|max:50',
            'product_type' => 'required|in:snack,drink,makeup,drugs',
            'product_price' => 'required|numeric',
            'expired_at' => 'required|date'
        ]);
        //kondisi apabila inputan yang diinginkan tidak sesuai
        if($validator->fails()) {
            //response json akan dikirim jika ada inputan yang salah
            return response()->json($validator->messages())->setStatusCode(422);
        }
        $payload = $validator->validated();
        //masukkan inputan yang benar ke database (table product)
        Product::where('id',$id)->update([
            'product_name' => $payload['product_name'],
            'product_type' => $payload['product_type'],
            'product_price' => $payload['product_price'],
            'expired_at' => $payload['expired_at']
        ]);
        //response json akan dikirim jika inputan benar
        return response()-> json([
            'msg' => 'Data produk berhasil diubah'
        ],201);
    }
    function showAll(){
        //panggil semua data produk dari tabel products
        $products = Product::all();
        //kirim response json
        return response() -> json([
            'msg' => 'Data produk keseluruhan',
            'data' => $products
        ],200);
    }
    function showById($id){
        //mencari data berdasarkan ID produk
        $product = Product::where('id',$id)->first();
        //kondisi apabila data dengan ID ada
        if($product) {
            //response ketika data ada
            return response()->json([
                'msg' => 'Data produk dengan ID: '.$id,
                'data' => $product
            ],200);
        
        }
        //response ketika data tidak ada
        return response()->json([
          'msg' => 'Data produk dengan ID: '.$id.' tidak ditemukan',
        ],404);
    }
    function showByName($product_name){
        //cari data berdasarkan nama produk yang mirip
        $product = Product::where('product_name','LIKE','%'.$product_name.'%')->get();

        //apbila data produk ada
        if($product->count() > 0){

            return response()->json([
                'msg' => 'Data produk dengan nama yang mirip: '.$product_name,
                'data' => $product
            ],200);
        }
        //response ketika data tidak ada
        return response()->json([
            'msg' => 'Data produk dengan nama yang mirip: '.$product_name. 'tidak ditemukan',
        ],404);
    }
    function update(Request $request,$id)
    {
        $product = Product::where('id', $id)->get();
        if ($product) {
            $validator = Validator::make($request->all(),[
                'product_name' => 'required|max:50',
                'product_type' => 'required|in:snack,drink,makeup,drugs',
                'product_price' => 'required|numeric',
                'expired_at' => 'required|date'
            ]);
            //kondisi apabila inputan yang diinginkan tidak sesuai
            if($validator->fails()) {
                //response json akan dikirim jika ada inputan yang salah
                return response()->json($validator->messages())->setStatusCode(422);
            }else{
             $payload = $validator->validated();
             Product::where('id',$id)->update([
                'product_name' => $payload['product_name'],
                'product_type' => $payload['product_type'],
                'product_price' => $payload['product_price'],
                'expired_at' => $payload['expired_at']
            ]);
            return response()->json([
                'msg' => 'Data produk berhasil diubah'
            ], status: 201);
        }
    }else {
        return response()->json([

            'msg' => 'Data produk dengan ID:' .$id. 'tidak ditemukan'
        ], status: 404);
    }
}
    public function delete($id) {
        $product = Product::where('id',$id)->get();
        if($product){

            Product::where('id',$id)->delete();

            //response json akan dikirim
            return response()->json([
                'msg' => 'Data produk dengan ID: '.$id.' berhasil dihapus'
            ],404);
        }
    }
}