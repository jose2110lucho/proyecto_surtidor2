<?php

namespace App\Exports;

use App\Models\NotaVentaProducto;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class VentasProductosExport implements FromCollection
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return NotaVentaProducto::all();
    }
}
