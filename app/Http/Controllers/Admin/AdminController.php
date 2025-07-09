<?php

namespace App\Http\Controllers\Admin;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalUser = DB::table('users')->count();
        $aktifUser = DB::table('users')->where('active', true)->count();
        $totalProd = DB::table('product')->count();
        $aktifProd = DB::table('product')->where('active', true)->count();

        $newProd = DB::table('product')->orderBy('id', 'desc')->take(10)->get();

        foreach ($newProd as $key => $value) {

            $value->created_at = Carbon::parse($value->created_at)->locale('id')->isoFormat('DD MMMM YYYY');

        }

        return view('admin.index')->with([
            'totalUser' => $totalUser,
            'aktifUser' => $aktifUser,
            'totalProd' => $totalProd,
            'aktifProd' => $aktifProd,
            'newProd'   => $newProd,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        return $request->all();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
