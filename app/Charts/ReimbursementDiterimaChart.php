<?php

namespace App\Charts;

use App\Models\Reimbursement;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class ReimbursementDiterimaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');

        for($i = 1; $i <= $bulan; $i++) {
            $pengajuanDiterima = Reimbursement::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->where('status_pengajuan', 'Diterima')->count();
            $pengajuanDitolak = Reimbursement::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->where('status_pengajuan', 'Ditolak')->count();
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $totalPengajuanDiterima[] = $pengajuanDiterima;
            $totalPengajuanDitolak[] = $pengajuanDitolak;
        }
        
        return $this->chart->lineChart()
            ->setTitle('Pengajuan Reimbursement')
            ->addData('Total Pengajuan Diterima', $totalPengajuanDiterima)
            ->addData('Total Pengajuan Ditolak', $totalPengajuanDitolak)
            ->setXAxis($dataBulan);
    }
}
