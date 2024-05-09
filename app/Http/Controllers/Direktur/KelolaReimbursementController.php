<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\Reimbursement;
use Illuminate\Http\Request;

class KelolaReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Reimbursement::where('status_pengajuan', 'Diajukan')->get();
        return view('pages.direktur.kelola-reimbursement.index', compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Reimbursement::find($id);
        return view('pages.direktur.kelola-reimbursement.show', compact('data'));
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
        try {
            $reimbursement = Reimbursement::find($id);
            $reimbursement->status_pengajuan = $request->status_pengajuan;
            $reimbursement->save();

            return redirect('/kelola-reimbursement');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal Mengelola Reimbursement: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
