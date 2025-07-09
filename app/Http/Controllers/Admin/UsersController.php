<?php

namespace App\Http\Controllers\Admin;

use DB;
use Mail;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\MailCreateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = DB::table('users')->whereNull('deleted_at')->get();

        return view('admin.users.index')->with([
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
            'name'     => 'required|string|max:255',
            'no_telp'  => 'nullable|string|unique:users,no_telp',
            'email'    => 'required|email|unique:users,email',
        ]);

        $email = $request->email;

        $password = Str::random(8);
        $hashedPassword = Hash::make($password);

        User::create([
            'name'      => $request->name,
            'email'     => $email,
            'no_telp'   => $request->no_telp,
            'password'  => $hashedPassword,
            'created_by'=> Auth::user()->id,
        ]);

        $emailData = [
            'appName'   => config('app.name', 'Laravel'),
            'created_by'=> Auth::user()->name,
            'createMail'=> Auth::user()->email,
            'name'      => $request->name,
            'no_telp'   => $request->no_telp,
            'email'     => $email,
            'password'  => $password,
            'logo'      => public_path('assets/logo.png'),
        ];

        Mail::to($email)
            ->send(new MailCreateUser($emailData));

        return redirect()->back()->with('success', 'User Berhasil di buat dan email password berhasil di kirim');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $data = User::where('id', $id)->first();

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
            'name'     => 'required|string|max:255',
            'no_telp'  => 'nullable|string|unique:users,no_telp',
            'email'    => 'required|email|unique:users,email',
        ]);

        $updated = User::where('id', $id)->update([
            'name'      => $request->name,
            'no_telp'   => $request->no_telp,
            'email'     => $request->email,
            'updated_by'=> Auth::user()->id,
        ]);

        if ($updated) {

            return redirect()->back()->with('success', 'Update User berhasil.');

            // return response()->json([
            //     'success' => true,
            //     'message' => 'user berhasil diperbarui.',
            //     'data' => [
            //         'id' => $request->id,
            //         'name' => $request->name
            //     ]
            // ]);
        } else {

            return redirect()->back()->with('alert', 'Update User Gagal.');

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

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');

    }

    public function status(Request $request)
    {

        $status = $request->val == 'aktif' ? true : false;

        $updated = User::where('id', $request->id)->update([
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
