<?php


namespace App\Http\Controllers;


use App\Models\EnergyEfficiency;
use App\Models\FrequencyEfficiency;
use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $result = '';

        if (!empty($request->type)) {

            switch ($request->type) {
                case 'energy':
                    $result = $this->calcBeta($request);
                    $this->saveBeta($request);
                    break;
                case 'frequency':
                    $result = $this->calcGamma($request);
                    $this->saveGamma($request);
                    break;
            }

            return view('welcome', [
                'result' => $result,
                'type' => $request->type,
            ]);
        }

        return view('welcome');
    }

    private function saveBeta(Request $request)
    {
        $beta = new EnergyEfficiency;

        $beta->beta = $this->calcBeta($request);
        $beta->R = $request->R;
        $beta->Pe = $request->Pe;
        $beta->N0 = $request->N0;

        $beta->save();
    }

    private function saveGamma(Request $request)
    {
        $gamma = new FrequencyEfficiency;

        $gamma->gamma = $this->calcGamma($request);
        $gamma->R = $request->R;
        $gamma->deltaF = $request->deltaF;

        $gamma->save();
    }

    private function calcBeta(Request $request)
    {
        return ($request->R) / ($request->Pe / $request->N0);
    }

    private function calcGamma(Request $request)
    {
        return $request->R / $request->deltaF;
    }

    public function history()
    {
        return view('history', [
            'energy' => EnergyEfficiency::all(),
            'frequency' => FrequencyEfficiency::all(),
        ]);
    }

    public function downloadPdf($type, $id)
    {
        switch ($type) {
            case 'energy':
                $item = EnergyEfficiency::query()->where('id', '=', $id)->first();

                $pdf = PDF::loadView('energy', compact('item'));
                return $pdf->download('energy-efficiency.pdf');
            case 'frequency':
                $item = FrequencyEfficiency::query()->where('id', '=', $id)->first();

                $pdf = PDF::loadView('frequency', compact('item'));
                return $pdf->download('frequency-efficiency.pdf');
        }
    }

    public function downloadXLS($type, $id)
    {
        switch ($type) {
            case 'energy':
                $item = EnergyEfficiency::query()->where('id', '=', $id)->first();

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setCellValue('A1', 'B');
                $sheet->setCellValue('A2', $item->beta);
                $sheet->setCellValue('B1', 'R');
                $sheet->setCellValue('B2', $item->R);
                $sheet->setCellValue('C1', 'Pe');
                $sheet->setCellValue('C2', $item->Pe);
                $sheet->setCellValue('D1', 'N0');
                $sheet->setCellValue('D2', $item->N0);

                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="energy"');
                $writer->save('php://output');

            case 'frequency':
                $item = FrequencyEfficiency::query()->where('id', '=', $id)->first();

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setCellValue('A1', 'Y');
                $sheet->setCellValue('A2', $item->gamma);
                $sheet->setCellValue('B1', 'R');
                $sheet->setCellValue('B2', $item->R);
                $sheet->setCellValue('C1', 'delta F');
                $sheet->setCellValue('C2', $item->deltaF);

                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="frequency"');
                $writer->save('php://output');
        }
    }

//    public function setEnergySheet($item) {
//        $spreadsheet = new Spreadsheet();
//        $sheet = $spreadsheet->getActiveSheet();
//        $sheet->setCellValue('A1', 'B');
//        $sheet->setCellValue('A2', $item->beta);
//        $sheet->setCellValue('B1', 'R');
//        $sheet->setCellValue('B2', $item->R);
//        $sheet->setCellValue('C1', 'Pe');
//        $sheet->setCellValue('C2', $item->Pe);
//        $sheet->setCellValue('D1', 'N0');
//        $sheet->setCellValue('D2', $item->N0);
//
//        return $sheet;
//    }

//    public function setFrequencySheet($item) {
//        $spreadsheet = new Spreadsheet();
//        $sheet = $spreadsheet->getActiveSheet();
//        $sheet->setCellValue('A1', 'Y');
//        $sheet->setCellValue('A2', $item->gamma);
//        $sheet->setCellValue('B1', 'R');
//        $sheet->setCellValue('B2', $item->R);
//        $sheet->setCellValue('C1', 'delta F');
//        $sheet->setCellValue('C2', $item->deltaF);
//
//        return $sheet;
//    }
}
