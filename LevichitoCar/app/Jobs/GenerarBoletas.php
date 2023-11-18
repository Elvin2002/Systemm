<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Psy\VersionUpdater\Downloader;

class GenerarBoletas implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $ventaId;
    public function __construct($ventaId)
    {
        $this->ventaId = $ventaId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $data = GenerarBoletaVenta($this->ventaId);
            $pdf = PDF::loadView('G_Ventas/pdf/Boleta', ["data" => $data]);
            $pdfPath = storage_path('app/temp/boleta_' . $this->ventaId . '_' . time() . '.pdf');
            Log::info("La boleta se genero");
       //     $pdf.Downloader()
            $pdf->save($pdfPath);
        } catch (\Exception $e) {
            // Registra el error o toma medidas para manejarlo adecuadamente
            Log::error('Error al generar la boleta: ' . $e->getMessage());
        }
    }
}
