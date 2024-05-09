<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Support\Facades\Auth;

class PengajuanReinbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = Reimbursement::where('user_id', $user->id)->get();

        return view('pages.staff.pengajuan-reinbursement.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.staff.pengajuan-reinbursement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user = Auth::user();

            $reimbursement = new Reimbursement();
            $reimbursement->user_id = $user->id;
            $reimbursement->tanggal = $request->tanggal;
            $reimbursement->nama = $request->nama;
            $reimbursement->deskripsi = $request->deskripsi;

            // Upload File
            $uploadedFile = Cloudinary::uploadFile($request->file('file_pendukung')->getRealPath());
            $secureUrl = $uploadedFile->getSecurePath();
            $reimbursement->file_pendukung = $secureUrl;

            $reimbursement->status_pengajuan = 'Diajukan';
            $reimbursement->save();

            return redirect('/pengajuan-reimbursement');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Reimbursement::find($id);
        return view('pages.staff.pengajuan-reinbursement.show', compact('data'));
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
        try {
            $pengajuan = Reimbursement::find($id);
            $fileUrl = $pengajuan->file_pendukung;
            
            Cloudinary::destroy($fileUrl);

            $pengajuan->delete();

            return redirect('/pengajuan-reimbursement');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['message' => 'Gagal menghapus file: ' . $e->getMessage()], 500);
        }
    }
}
