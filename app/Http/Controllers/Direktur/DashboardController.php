<?php

namespace App\Http\Controllers\Direktur;

use App\Charts\PengajuanReimbursementChart;
use App\Charts\ReimbursementDiterimaChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(PengajuanReimbursementChart $pengajuanReimbursementChart, ReimbursementDiterimaChart $reimbursementDiterimaChart) {
        return view('pages.direktur.dashboard.index', ['pengajuanReimbursementChart' => $pengajuanReimbursementChart->build(), 'reimbursementDiterimaChart' => $reimbursementDiterimaChart->build()]);
    }
}
