<?php

namespace App\Http\Controllers;

use App\Experience;
use App\StockRegistry;
use App\Supplier;
use App\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockRegistriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //jackson modif: renvoie la page stock_registries.index si l'utilisateur est un admin sinon stock_registries.indexUtilisateur
        $user = Auth::user();
        if ($user->can('isadmin')){
            $registries = StockRegistry::orderBy('created', 'desc')->paginate(25);

            return view("stock_registries.index")->with(["registries" => $registries]);
        }else{
            $registries = StockRegistry::orderBy('created', 'desc')->paginate(25);

            return view("stock_registries.indexUtilisateur")->with(["registries" => $registries]);
        }
        
        /* 
        ancienne version mis en commentaire par Jackson
        $registries = StockRegistry::orderBy('created', 'desc')->paginate(25);

        return view("stock_registries.index")->with(["registries" => $registries]); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create($supply_id) ancienne version mis en commentaire par Jackson
    public function create(Request $request)
    {
        //$this->authorize(__FUNCTION__);jackson modif mis en commentaire par Jackson pour permettre aux users de créer un StockrRegistry

        $registry = new StockRegistry;

        $suppliers = Supply::orderBy('name', 'asc')->get();
        $experiences = Experience::get();
        //$supply = $registry->supply; ancienne version mis en commentaire par Jackson
        //$supply = Supply::where("id", $supply_id)->first(); ancienne version mis en commentaire par Jackson

        /*
        ancienne version mis en commentaire par Jackson 
        return view("stock_registries.form")->with(["suppliers" => $suppliers, "experiences" => $experiences, "supply" => $supply,"registry" => $registry]);*/
        if ($request->supply_id){

        return view("stock_registries.form")->with(["suppliers" => $suppliers, "experiences" => $experiences,"registry" => $registry]);

        }else{

        return view("stock_registries.formUtilisateur")->with(["suppliers" => $suppliers, "experiences" => $experiences,"registry" => $registry]);

        }
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(Request $request, $supply_id)
    public function store(Request $request)
    {
        //$this->authorize(__FUNCTION__); jackson modif pour permettre aux users de stocker dans la BD un StockRegistry 

        $this->validate($request, StockRegistry::$rules);

        $registry = new StockRegistry;

        $registry->in  = $request->in;
        $registry->out = $request->out;
        $registry->note = $request->note;
        if ($request->supply_id){
            $registry->supply_id = $request->supply_id;
        }else{
            $registry->supply_id = $request->fourniture;
        }
        //$registry->supply_id   = $supply_id;
        //$registry->supply_id   = $request->fourniture;
        $registry->expiration_date = $request->expiration_date;
        $registry->user_id = Auth::user()->id;
        $registry->experience_id   = $request->experience_id;

        $registry->save();

        return redirect()->route("stock.registries.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->authorize(__FUNCTION__); jackson pour permettre aux users d'éditer un StockRegistry

        $registry = StockRegistry::where("id", $id)->first();
        $suppliers = Supply::orderBy('name', 'asc')->get();
        $experiences = Experience::get();
        $supply = $registry->supply;
        return view("stock_registries.formUtilisateur")->with(["suppliers" => $suppliers, "experiences" => $experiences, "supply" => $supply,"registry" => $registry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$this->authorize(__FUNCTION__); jackson modif pour permettre aux users de mettre à jour un StockRegistry

        $this->validate($request, StockRegistry::$rules);
        
        $registry = StockRegistry::where("id", $id)->first();

        $registry->in  = $request->in;
        $registry->out = $request->out;
        $registry->note = $request->note;
        $registry->supply_id   = $request->fourniture;
        $registry->expiration_date = $request->expiration_date;
        $registry->experience_id   = $request->experience_id;

        $registry->save();
        return redirect()->route("stock.registries.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(__FUNCTION__);
        
        StockRegistry::findOrFail($id)->delete();
        return redirect()->route("stock.registries.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, $id)
    {
        //$this->authorize(__FUNCTION__);Jackson modif: permettre aux utilisateurs de modifier un agrement

        $this->validate($request, Agrement::$rules);

        $agrement = Agrement::where("id", $id)->first();

        $agrement->name = ($request->name);
        $agrement->description = ($request->description);
        $agrement->user_id = $request->user;

        $agrement->save();
        return redirect()->route("agrements.index");
    }*/

    /**
     * Export the resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function export()
    {
        $this->authorize(__FUNCTION__);

        $stock_registries = StockRegistry::all();

        $filename = 'Export_stock_registries - ' . date('Y_m_d') . '.xlsx';
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

        $columns = ["Entrée",
                    "Sortie",
                    "Date de péremption",
                    "Remarque",
                    "Utilisateur",
                    "Expérience liée",
                    "Créer",
                    "Modifiée"];

        
        foreach($stock_registries as $key => $stock_registry) {
            $utilisateur = "";
            $fourniture = Supply::where("id", $stock_registry->supply_id)->first();
            
            foreach ($agrement->species as $specie) {
                $linked_species .= $specie->name . ' / ';
            }    

            foreach ($agrement->users as $user) {
                $linked_users .= $user->name . ' / ';
            }

           $datas[$key] = [$agrement->name,
                           $agrement->description,
                           $agrement->user->name,
                           $linked_species,
                           $linked_users];
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

        for ($col = 'A'; $col <= 'Z'; $col++)
        {
            $sheet->getStyle($col.'1')->applyFromArray($styleArray);
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($filepath);

        return response()->download($filepath, $filename, $headers)->deleteFileAfterSend(true);
    }*/
}
