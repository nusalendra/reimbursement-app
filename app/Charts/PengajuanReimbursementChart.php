<?php

namespace App\Charts;

use App\Models\Reimbursement;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class PengajuanReimbursementChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $tahun = date('Y');
        $bulan = date('m');

        for($i = 1; $i <= $bulan; $i++) {
            $totalPengajuan = Reimbursement::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->count();
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataTotalPengajuan[] = $totalPengajuan;
        }
        
        return $this->chart->barChart()
            ->setTitle('Total Pengajuan Reimbursement Bulanan')
            ->addData('Total Pengajuan Reimbursement', $dataTotalPengajuan)
            ->setXAxis($dataBulan);
    }
}
