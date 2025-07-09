<?php

namespace App\Http\Controllers\Admin;

use DB;
use Mail;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Mail\MailCreateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = DB::table('product')->whereNull('deleted_at')->get();

        return view('admin.product.index')->with([
            'data'  => $data,
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

        $request->validate([
            'name'      => 'required|string|max:255',
            'file'      => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'banner'    => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $filenameSimpan = NULL;
        $file = Request()->file;
        if ($file) {
            $file_path = public_path('/assets/product/' . $file);
            if (File::exists($file_path)) {
                unlink($file_path);
                $file = $file;
                    // Mendapatkan ekstensi file
                $extension = $file->getClientOriginalExtension();

                    // Membuat nama file baru
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;

                    // Menyimpan file dengan nama baru
                $file->move(public_path('/assets/product'), $filenameSimpan);
            }else{
                $file = $file;
                    // Mendapatkan ekstensi file
                $extension = $file->getClientOriginalExtension();

                    // Membuat nama file baru
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;

                    // Menyimpan file dengan nama baru
                $file->move(public_path('/assets/product'), $filenameSimpan);
            }
        }

        $filenameSimpan2 = NULL;
        $banner = Request()->banner;
        if ($banner) {
            $banner_path = public_path('/assets/banner/' . $banner);
            if (File::exists($banner_path)) {
                unlink($banner_path);
                $banner = $banner;
                    // Mendapatkan ekstensi banner
                $extension = $banner->getClientOriginalExtension();

                    // Membuat nama banner baru
                $bannername = Str::slug(pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME));
                $filenameSimpan2 = $bannername . '_' . time() . '.' . $extension;

                    // Menyimpan file dengan nama baru
                $banner->move(public_path('/assets/banner'), $filenameSimpan2);
            }else{
                $banner = $banner;
                    // Mendapatkan ekstensi banner
                $extension = $banner->getClientOriginalExtension();

                    // Membuat nama file baru
                $bannername = Str::slug(pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME));
                $filenameSimpan2 = $bannername . '_' . time() . '.' . $extension;

                    // Menyimpan banner dengan nama baru
                $banner->move(public_path('/assets/banner'), $filenameSimpan2);
            }
        }

        Product::create([
            'name'      => $request->name,
            'image'     => $filenameSimpan,
            'banner'    => $filenameSimpan2,
            'price'     => str_replace(['Rp', 'S$', '$', '.', ',', ' '], '', $request->price ?? NULL),
            'qty'       => $request->qty,
            'unit'      => $request->unit,
            'created_by'=> Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Produk Berhasil di buat');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $data = Product::where('id', $id)->first();

        $data->imageUrl = !empty($data->image) ? asset('assets/product/'.$data->image) : NULL;
        $data->bannerUrl = !empty($data->banner) ? asset('assets/banner/'.$data->banner) : NULL;
        $data->Rprice = 'Rp ' . number_format($data->price, 0, ',', '.');

        return response()->json([
            'id'    => $id,
            'data'  => $data,
        ]);

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

        $request->validate([
            'name'      => 'required|string|max:255',
            'file'      => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'banner'    => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $product = Product::findOrFail($id);

        $file = Request()->file;
        if ($file) {
            $file_path = public_path('/assets/product/' . $file);
            if (File::exists($file_path)) {
                unlink($file_path);
                $file = $file;
                    // Mendapatkan ekstensi file
                $extension = $file->getClientOriginalExtension();

                    // Membuat nama file baru
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;

                    // Menyimpan file dengan nama baru
                $file->move(public_path('/assets/product'), $filenameSimpan);
            }else{
                $file = $file;
                    // Mendapatkan ekstensi file
                $extension = $file->getClientOriginalExtension();

                    // Membuat nama file baru
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;

                    // Menyimpan file dengan nama baru
                $file->move(public_path('/assets/product'), $filenameSimpan);
            }

            $product->image = $filenameSimpan;

        }

        $banner = Request()->banner;
        if ($banner) {
            $banner_path = public_path('/assets/banner/' . $banner);
            if (File::exists($banner_path)) {
                unlink($banner_path);
                $banner = $banner;
                    // Mendapatkan ekstensi banner
                $extension = $banner->getClientOriginalExtension();

                    // Membuat nama banner baru
                $bannername = Str::slug(pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME));
                $filenameSimpan2 = $bannername . '_' . time() . '.' . $extension;

                    // Menyimpan file dengan nama baru
                $banner->move(public_path('/assets/banner'), $filenameSimpan2);
            }else{
                $banner = $banner;
                    // Mendapatkan ekstensi banner
                $extension = $banner->getClientOriginalExtension();

                    // Membuat nama file baru
                $bannername = Str::slug(pathinfo($banner->getClientOriginalName(), PATHINFO_FILENAME));
                $filenameSimpan2 = $bannername . '_' . time() . '.' . $extension;

                    // Menyimpan banner dengan nama baru
                $banner->move(public_path('/assets/banner'), $filenameSimpan2);
            }

            $product->banner = $filenameSimpan2;

        }

        $product->name       = $request->name;
        $product->qty        = $request->qty;
        $product->unit       = $request->unit;
        $product->price      = str_replace(['Rp', 'S$', '$', '.', ',', ' '], '', $request->price);
        $product->updated_by = Auth::user()->id;

        $updated = $product->save();

        if ($updated) {

            return redirect()->back()->with('success', 'Update Product berhasil.');

            // return response()->json([
            //     'success' => true,
            //     'message' => 'user berhasil diperbarui.',
            //     'data' => [
            //         'id' => $request->id,
            //         'name' => $request->name
            //     ]
            // ]);
        } else {

            return redirect()->back()->with('alert', 'Update Product error.');

            // return response()->json([
            //     'success' => false,
            //     'message' => 'Gagal memperbarui user.'
            // ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $prod = Product::findOrFail($id);
        $prod->delete();

        return redirect()->back()->with('success', 'Product berhasil dihapus.');

    }

    public function status(Request $request)
    {

        $status = $request->val == 'aktif' ? true : false;

        $updated = Product::where('id', $request->id)->update([
            'active'    => $status,
            'updated_by'=> Auth::user()->id,
            'updated_at'=> Carbon::now(),
        ]);

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Status user berhasil diperbarui.',
                'data' => [
                    'id' => $request->id,
                    'new_status' => $request->val
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status user.'
            ], 500);
        }

    }

}
