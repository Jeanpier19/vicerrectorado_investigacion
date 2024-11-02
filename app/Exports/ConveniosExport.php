<?php

namespace App\Exports;

use App\Convenio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ConveniosExport implements FromView, WithEvents
{
    protected $search;
    protected $qty_toshow;
    protected $tipo_convenio;
    protected $tipo_convenio_especifico_id;
    protected $facultad_id;
    
    public function __construct($search, $qty_toshow, $tipo_convenio, $tipo_convenio_especifico_id, $facultad_id)
    {
        $this->search = $search;
        $this->qty_toshow = $qty_toshow;
        $this->tipo_convenio = $tipo_convenio;
        $this->tipo_convenio_especifico_id = $tipo_convenio_especifico_id;
        $this->facultad_id = $facultad_id;
    }

	public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $title_styles = [
                    'font' => [
                        'name' => 'Calibri',
                        'bold' => true,
                        'size' => 20,
                        'color' => ['argb' => '333333'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $subtitle_styles = [
                    'font' => [
                        'name' => 'Calibri',
                        'bold' => true,
                        'size' => 17,
                        'color' => ['argb' => '333333'],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $params_styles = [
                    'font' => [
                        'name' => 'Calibri',
                        'bold' => true,
                        'size' => 13,
                        'color' => ['argb' => '333333'],
                    ],
                ];
                $header_table_styles = [
                    'font' => [
                        'name' => 'Calibri',
                        'bold' => true,
                        'size' => 14,
                        'color' => ['argb' => 'ffffff'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => '0046a8'],
                    ]
                ];
                $event->getSheet()->getDelegate()->getStyle('A1:F1')->applyFromArray($title_styles);
                $event->getSheet()->getDelegate()->getStyle('A2:F2')->applyFromArray($subtitle_styles);
                $event->getSheet()->getDelegate()->getStyle('A4:C4')->applyFromArray($params_styles);
                $event->getSheet()->getDelegate()->getStyle('A5:C5')->applyFromArray($params_styles);
                $event->getSheet()->getDelegate()->getStyle('A6:C6')->applyFromArray($params_styles);
                $event->getSheet()->getDelegate()->getStyle('A7:C7')->applyFromArray($params_styles);
                $event->getSheet()->getDelegate()->getStyle('A8:F8')->applyFromArray($header_table_styles);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(8);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(25);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);
            },
        ];
    }

    public function view(): View
    {
        // $facultad_id_aux = $this->facultad_id;
        // $tipo_convenio_especifico_id_aux = $this->tipo_convenio_especifico_id;
        // if($this->tipo_convenio == 1) {
        //     if($this->facultad_id) {
        //         if($this->tipo_convenio_especifico_id) {
        //             $items = Convenio::where('active', 1)
        //                 ->where('tipo_convenio', $this->tipo_convenio)
        //                 ->with('institucion')
        //                 ->whereHas('facultad', function($query) use ($facultad_id_aux) {
        //                     $query->where('id', $this->facultad_id);
        //                 })
        //                 ->whereHas('tipo_convenio_especifico', function($query) use ($tipo_convenio_especifico_id_aux) {
        //                     $query->where('id', $this->tipo_convenio_especifico_id);
        //                 })
        //                 ->orderBy('main', 'desc')
        //                 ->oldest()
        //                 ->paginate($this->qty_toshow);
        //         }else {
        //             $items = Convenio::where('active', 1)
        //                 ->where('tipo_convenio', $this->tipo_convenio)
        //                 ->with('institucion')
        //                 ->whereHas('facultad', function($query) use ($facultad_id_aux) {
        //                     $query->where('id', $this->facultad_id);
        //                 })
        //                 ->orderBy('main', 'desc')
        //                 ->oldest()
        //                 ->paginate($this->qty_toshow);
        //         }
        //     }elseif($this->tipo_convenio_especifico_id) {
        //         if($this->facultad_id) {
        //             $items = Convenio::where('active', 1)
        //                 ->where('tipo_convenio', $this->tipo_convenio)
        //                 ->with('institucion')
        //                 ->whereHas('facultad', function($query) use ($facultad_id_aux) {
        //                     $query->where('id', $this->facultad_id);
        //                 })
        //                 ->whereHas('tipo_convenio_especifico', function($query) use ($tipo_convenio_especifico_id_aux) {
        //                     $query->where('id', $this->tipo_convenio_especifico_id);
        //                 })
        //                 ->orderBy('main', 'desc')
        //                 ->oldest()
        //                 ->paginate($this->qty_toshow);
        //         }else {
        //             $items = Convenio::where('active', 1)
        //                 ->where('tipo_convenio', $this->tipo_convenio)
        //                 ->with('institucion')
        //                 ->whereHas('tipo_convenio_especifico', function($query) use ($tipo_convenio_especifico_id_aux) {
        //                     $query->where('id', $this->tipo_convenio_especifico_id);
        //                 })
        //                 ->orderBy('main', 'desc')
        //                 ->oldest()
        //                 ->paginate($this->qty_toshow);
        //         }
        //     }else {
        //         $items = Convenio::where('active', 1)
        //             ->where('tipo_convenio', $this->tipo_convenio)
        //             ->with('institucion')
        //             ->orderBy('main', 'desc')
        //             ->oldest()
        //             ->paginate($this->qty_toshow);
        //     }
        // }else {
        //     $items = Convenio::where('active', 1)
        //         ->where('tipo_convenio', $this->tipo_convenio)
        //         ->with('institucion')
        //         ->orderBy('main', 'desc')
        //         ->oldest()
        //         ->paginate($this->qty_toshow);
        // }
        // if(count($items) > 0) {
            return view('web.exports.convenios', [
                'qty_toshow' => $this->qty_toshow,
                'convenios' => Convenio::all(),
            ]);
        // }else {

        // }
        // return response()->json($response);
    }
}
