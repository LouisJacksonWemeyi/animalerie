<?php

namespace App\Http\Controllers;

use App\InfoPlace;
use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class InfoPlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = InfoPlace::orderBy('info_date', 'desc')->orderBy('place_id', 'asc')->get();

        $info_place = new InfoPlace;

        $places = Place::get();

        $places_w_infos = [];

        foreach ($places as $place) {
            $places_w_infos[$place->id] = InfoPlace::where('place_id', $place->id)->get();
        }
        
        //jackson modif: renvoie la page info_places.index si l'utilisateur est un admin sinon info_places.indexUtilisateurs

        $user = Auth::user();
        if ($user->can('isadmin')){
            return view('info_places.index')->with(['info_place' => $info_place, 'infos' => $infos, 'places' => $places, 'places_w_infos' => $places_w_infos]);
        }else{
            return view('info_places.indexUtilisateurs')->with(['info_place' => $info_place, 'infos' => $infos, 'places' => $places, 'places_w_infos' => $places_w_infos]);
        }

        /* 
        ancienne version mis en commentaire par jackson
        return view('info_places.index')->with(['info_place' => $info_place, 'infos' => $infos, 'places' => $places, 'places_w_infos' => $places_w_infos]); */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize(__FUNCTION__); Jackson Modif pour permettre à un user de stocker une infoplace 

        $this->validate($request, InfoPlace::$rules);
        $info = new InfoPlace;

        $info->humidity = $request->humidity;
        $info->temperature = $request->temperature;
        $info->place_id = $request->place_id;
        $info->note = $request->note;
        $info->info_date = $request->info_date;
        $info->user_id = Auth::id();
        $info->save();

        return redirect()->route("info.places.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->authorize(__FUNCTION__); Jackson Modif pour permettre à un user d'éditer une infoplace 

        $info = InfoPlace::find($id);
        $places = Place::all();

        return view('info_places.form')->with(['info_place' => $info, 'places' => $places]);
    }

    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //$this->authorize(__FUNCTION__); Jackson Modif pour permettre à un user de faire un update d'une infoplace 

        $this->validate($request, InfoPlace::$rules);

        $info = InfoPlace::find($id);

        $info->humidity = $request->humidity;
        $info->temperature = $request->temperature;
        $info->place_id = $request->place_id;
        $info->note = $request->note;
        $info->info_date = $request->info_date;

        $info->save();

        return redirect()->route("info.places.index");
    }


    /**
     * Export the resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportByDate()
    {
        
        //$this->authorize(__FUNCTION__); Jackson Modif pour permettre à un user d'exporter une infoplace 

        $infos = InfoPlace::orderBy('info_date', 'desc')->orderBy('place_id', 'asc')->get();

        $filename = 'Export_info_lieux - ' . date('Y_m_d') . '.xlsx';
        $filepath = 'storage/tmp/'.$filename;

        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','Content-Disposition: attachment;filename="'.$filename.'"','Cache-Control: max-age=0'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],

        ];

        $columns = ["Date",
                    "Humidité",
                    "Température",
                    "Remarque",
                    "Utilisateur",
                    "Lieu"];

        
        foreach($infos as $key => $info) {
           $datas[$key] = [$info->date,
                     $info->humidity,
                     $info->temperature,
                     $info->note,
                     $info->user->name,
                     $info->place->name];
        }

        $case_letter = '0';            
        foreach ($columns as $column) {
            $case = ord('A') + $case_letter;
            $sheet->SetCellValue(chr($case).'1', $column);
            $case_letter++;
        }        

        $i = 2;
        foreach ($datas as $data) {
            $case_letter = '0';            
            foreach ($data as $key => $value) {
                $case = ord('A') + $case_letter;
                $sheet->SetCellValue(chr($case).$i, $value);
                $case_letter++;
            }
            $i++;
        }

        for ($col = 'A'; $col <= 'F'; $col++)
        {
            $sheet->getStyle($col.'1')->applyFromArray($styleArray);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($filepath);

        return response()->download($filepath, $filename, $headers)->deleteFileAfterSend(true);
    }

    /**
     * Export the resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportByPlace($place_id)
    {
        $place = Place::find($place_id);
        $infos = InfoPlace::where('place_id', $place_id)->orderBy('info_date', 'desc')->get();

        $filename = $place->name .' - ' . date('Y_m_d') . '.xlsx';
        $filepath = 'storage/tmp/'.$filename;

        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','Content-Disposition: attachment;filename="'.$filename.'"','Cache-Control: max-age=0'];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],

        ];

        $columns = ["Humidité",
                    "Température",
                    "Remarque",
                    "Date",
                    "Utilisateur"];

        
        foreach($infos as $key => $info) {
           $datas[$key] = [$info->humidity,
                          $info->temperature,
                          $info->note,
                          $info->date,
                          $info->user->name];
        }

        $case_letter = '0';            
        foreach ($columns as $column) {
            $case = ord('A') + $case_letter;
            $sheet->SetCellValue(chr($case).'1', $column);
            $case_letter++;
        }        

        $i = 2;
        foreach ($datas as $data) {
            $case_letter = '0';            
            foreach ($data as $key => $value) {
                $case = ord('A') + $case_letter;
                $sheet->SetCellValue(chr($case).$i, $value);
                $case_letter++;
            }
            $i++;
        }

        for ($col = 'A'; $col <= 'F'; $col++)
        {
            $sheet->getStyle($col.'1')->applyFromArray($styleArray);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($filepath);

        return response()->download($filepath, $filename, $headers)->deleteFileAfterSend(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InfoPlace::findOrFail($id)->delete();
        return redirect()->route("info.places.index");
    }
}
