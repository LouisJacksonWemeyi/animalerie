<?php

namespace App\Http\Controllers;

use App\Agrement;
use App\AgrementUser;
use Illuminate\Support\Facades\DB;
use App\AgrementSpecie;
use App\Specie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class AgrementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //renvoie la page indexAmind si l'utilisateur authentifié est un admin ou index sinon 
        $user = Auth::user();
        if ($user->can('isadmin')){
            $agrements = Agrement::with("user")->with("species")->paginate(25);
            return view('agrements.indexAdmind')->with(["agrements" => $agrements]);
        }else{
            $agrements = Agrement::with("user")->with("species")->paginate(25);
            return view('agrements.index')->with(["agrements" => $agrements]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create'); // donne le droit de continuer à l'utilisateur qui a le droit de créer un agrement 

        $agrement = new Agrement;
        $species = Specie::get();
        $users = User::all();

        return view('agrements.form')->with(["agrement" => $agrement, "species" => $species, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create'); //donne le droit de continuer à l'utilisateur qui a le droit de créer un agrement


        $this->validate($request, Agrement::$rules);

        $agrement = new Agrement;

        $agrement->name = $request->name;
        $agrement->description = $request->description;

        $agrement->user_id = $request->user;

        $agrement->save();

        //Jackson ajout code pour permettre d'ajouter le tittulaire d'un agrement comme utlisateur de cet agrement à sa création 
        $agrement_user = DB::table('agrements')->where('name', '=', $request->name)->get();
        foreach ($agrement_user as $agrement) {
        $agrement_user1 = new AgrementUser;
        $agrement_user1->agrement_id = $agrement->id;
        $agrement_user1->user_id = $request->user;

        $agrement_user1->save();
            //echo $agrement->users()->attach(User::find($request->user));
        }
        //fin Jackson ajout code.
        

        // modification faite par jackson pour que le titulaire d'un agrement soit automatique un utilisateur de l'agrement 
      /*   $agrement_user = new AgrementUser;

        $agrement_user->agrement_id = DB::table('agrements')->where('name', '=', $request->name)->get()->id;
        $agrement_user->user_id = $request->user_id;

        $agrement_user->save(); */
        
        return redirect()->route("agrements.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize(__FUNCTION__); //donne le droit de continuer à l'utilisateur qui a le droit de modifier un agrement

        $agrement = Agrement::where("id", $id)->first();
        $species = Specie::get();
        $users = User::all();

        return view('agrements.form')->with(["agrement" => $agrement, "species" => $species, 'users' => $users]);
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
        $this->authorize(__FUNCTION__); //donne le droit de continuer à l'utilisateur qui a le droit de faire un update d'un agrement

        $this->validate($request, Agrement::$rules);

        $agrement = Agrement::where("id", $id)->first();

        $agrement->name = ($request->name);
        $agrement->description = ($request->description);
        $agrement->user_id = $request->user;

        $agrement->save();
        return redirect()->route("agrements.index");
    }

    /**
     * Export the resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $this->authorize(__FUNCTION__); //donne le droit de continuer à l'utilisateur qui a le droit d'exporter un agrement

        $agrements = Agrement::all();

        $filename = 'Export_agrements - ' . date('Y_m_d') . '.xlsx';
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

        $columns = ["Numéro",
                    "Description",
                    "Titulaire",
                    "Espèces lièes",
                    "Utilisateur(s)"];

        
        foreach($agrements as $key => $agrement) {
            $linked_species = "";
            $linked_users = "";
            
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(__FUNCTION__); // donne le droit de continuer à l'utilisateur qui a le droit de supprimer un agrement

        $agrement = Agrement::findOrFail($id)->delete();
        return redirect()->route("agrements.index");

    }
}
