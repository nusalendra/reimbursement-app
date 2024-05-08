<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('jabatan', 'Finance')->orWhere('jabatan', 'Staff')->get();
        return view('pages.direktur.karyawan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.direktur.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'NIP' => 'required|max:18|unique:users,NIP',
            'password' => 'required',
            'jabatan' => 'required'
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        try {
            $user = new User();
            $user->nama = $request->nama;
            $user->NIP = $request->NIP;
            $user->password = Hash::make($request->password);
            $user->jabatan = $request->jabatan;
            $user->save();
        
            return redirect('/karyawan');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
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
        $data = User::find($id);
        return view('pages.direktur.karyawan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'string',
            'NIP' => 'max:18|unique:users,NIP',
            'password' => '',
            'jabatan' => ''
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        try {
            $user = User::find($id);
            $user->nama = $request->nama;
            $user->NIP = $request->NIP;
            $user->password = Hash::make($request->password);
            $user->jabatan = $request->jabatan;
            $user->save();
        
            return redirect('/karyawan');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/karyawan');
    }
}
