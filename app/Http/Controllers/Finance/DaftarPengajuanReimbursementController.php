<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\PenolakanReimbursement;
use App\Models\Reimbursement;
use Illuminate\Http\Request;

class DaftarPengajuanReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Reimbursement::where('status_pengajuan', 'Disetujui')->get();
        return view('pages.finance.daftar-pengajuan-reimbursement.index', compact('data'));
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
        return view('pages.finance.daftar-pengajuan-reimbursement.show', compact('data'));
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
            
            if ($request->status_pengajuan == 'Ditolak') {
                $reimbursement->status_pengajuan = $request->status_pengajuan;

                $penolakanReimbursement = new PenolakanReimbursement();
                $penolakanReimbursement->reimbursement_id = $reimbursement->id;
                $penolakanReimbursement->alasan_penolakan = $request->alasan_penolakan;
                $penolakanReimbursement->save();
            } else {
                $reimbursement->status_pengajuan = $request->status_pengajuan;
            }

            $reimbursement->save();

            return redirect('/daftar-pengajuan-reimbursement');
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
