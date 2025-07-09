<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {

        $banner = DB::table('product')->whereNotNull('banner')->limit(5)->get();

        $newProd = DB::table('product')->orderBy('id', 'desc')->take(10)->get();

        $product = DB::table('product')->limit(8)->get();

        return view('home')->with([
            'banner'    => $banner,
            'newProd'   => $newProd,
            'product'   => $product,
        ]);

    }

    public function produk($id)
    {

        $id = decrypt($id);

        return $id;

    }

    public function cart(Request $request)
    {



    }

}
