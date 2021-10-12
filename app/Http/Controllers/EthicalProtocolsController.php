<?php

namespace App\Http\Controllers;

use App\Agrement;
use App\ApplicationDomain;
use App\EthicalProtocol;
use App\EthicalProtocolUser;
use App\Severity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\EthicalProtocolArchive;
use App\User;

class EthicalProtocolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //jackson modif: renvoie la page protocols.index si l'utilisateur est un admin sinon protocols.indexUtilisateurs
        $user = Auth::user();
        if ($user->can('isadmin')){
            $protocols = EthicalProtocol::orderBy('ethical_number')->with("user")->paginate(25);
            return view('protocols.index')->with(["protocols" => $protocols]);
        }else{
            $protocols = EthicalProtocol::orderBy('ethical_number')->with("user")->paginate(25);
            return view('protocols.indexUtilisateurs')->with(["protocols" => $protocols]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize(__FUNCTION__); acienne version mit en commentaire par Jackson afin de permettre un user de créer un protocol  
        $protocol = new EthicalProtocol;
        $domains = ApplicationDomain::all();
        $agrements = Agrement::all();
        $severities = Severity::all();
        return view("protocols.formAjouter")->with(["protocol" => $protocol, "domains" => $domains, "agrements" => $agrements, "severities" => $severities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->authorize(__FUNCTION__); jackson modif pour permettre à un utilisateur de de faire une suvegarde dans la base de donnée 

        $this->validate($request, EthicalProtocol::$rules);

        $protocol = new EthicalProtocol;

        $protocol->title = $request->title;
        $protocol->ethical_number = $request->ethical_number;
        $protocol->total_animals = $request->total_animals;
        $protocol->date_beginning = $request->date_beginning;
        $protocol->date_end = $request->date_end;
        $protocol->application_domain_id = $request->application_domain_id;
        $protocol->agrement_id = $request->agrement_id;
        $protocol->severity_id = $request->severity_id;
        $protocol->uploaded = $request->uploaded;
        $protocol->accepted = $request->accepted;
        $protocol->acceptation_email = $request->acceptation_email;
        $protocol->retrospective_study = $request->retrospective_study;

        $protocol->user_id = Auth::id();

        $protocol->save();

        //Jackson ajout code pour permettre d'ajouter l'utilisateur connecté comme utilisateur d'un protocol ethique à sa création

                $ethical_protocol = EthicalProtocol::all()->last();

                $ethical_protocol_user = new  EthicalProtocolUser;

                    $ethical_protocol_user->ethical_protocol_id = $ethical_protocol->id;
                    
                    $ethical_protocol_user->user_id = $ethical_protocol->user_id;

                $ethical_protocol_user->save();

        return redirect()->route("protocols.index");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        //$this->authorize(__FUNCTION__); mis en commentaire pour permettre qu'un user puisse faire un edit

        $protocol = EthicalProtocol::where("id", $id)->first();
        $domains = ApplicationDomain::all();
        $agrements = Agrement::all();
        $severities = Severity::all();
        return view("protocols.form")->with(["protocol" => $protocol, "domains" => $domains, "agrements" => $agrements, "severities" => $severities]);
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
        //$this->authorize(__FUNCTION__); jackson modif pour permettre qu'un utilisateur puisse faire un update

        $this->validate($request, EthicalProtocol::$rules);

        $protocol = EthicalProtocol::where("id", $id)->first();

        $protocol->title = $request->title;
        $protocol->ethical_number = $request->ethical_number;
        $protocol->total_animals = $request->total_animals;
        $protocol->date_beginning = $request->date_beginning;
        $protocol->date_end = $request->date_end;
        $protocol->application_domain_id = $request->application_domain_id;
        $protocol->agrement_id = $request->agrement_id;
        $protocol->severity_id = $request->severity_id;
        $protocol->uploaded = $request->uploaded;
        $protocol->accepted = $request->accepted;
        $protocol->acceptation_email = $request->acceptation_email;
        $protocol->retrospective_study = $request->retrospective_study;
        
        $protocol->save();

        // Jackson ajout: on sauve dans la table Ethical_Protocol_Archive de la BD toutes modifications réalisées sur protocle  
        if($request->title != $request->title_old){
        $archive = new EthicalProtocolArchive;

        
        $archive->note = 'Modification du champ, Titre, de ce protocole par '.User::find(Auth::id())->name.', Ancienne valeur : '.$request->title_old.', Nouvelle valeur : '.$request->title;
        
        $archive->date = date("Y-m-d H:i:s", time());
        $archive->ethical_protocol_id = $id;
        $archive->user_id = Auth::id();
        $archive->save();
        }

        if($request->ethical_number != $request->ethical_number_old){

            $archive = new EthicalProtocolArchive;
    
            
            $archive->note = 'Modification du champ, N° éthique, de ce protocole par '.User::find(Auth::id())->name.', Ancienne valeur : '.$request->ethical_number_old.', Nouvelle valeur : '.$request->ethical_number;
            
            $archive->date = date("Y-m-d H:i:s", time());
            $archive->ethical_protocol_id = $id;
            $archive->user_id = Auth::id();
            $archive->save();
       }
       if($request->total_animals != $request->total_animals_old){

        $archive = new EthicalProtocolArchive;

        
        $archive->note = 'Modification du champ, Nb animaux accordés, de ce protocole par '.User::find(Auth::id())->name.', Ancienne valeur : '.$request->total_animals_old.', Nouvelle valeur : '.$request->total_animals;
        
        $archive->date = date("Y-m-d H:i:s", time());
        $archive->ethical_protocol_id = $id;
        $archive->user_id = Auth::id();
        $archive->save();
        }

        if($request->date_beginning != $request->date_beginning_old){

            $archive = new EthicalProtocolArchive;

            
            $archive->note = 'Modification du champ, Début validité, de ce protocole par '.User::find(Auth::id())->name.', Ancienne valeur : '.$request->date_beginning_old.', Nouvelle valeur : '.$request->date_beginning;
            
            $archive->date = date("Y-m-d H:i:s", time());
            $archive->ethical_protocol_id = $id;
            $archive->user_id = Auth::id();
            $archive->save();
        } 

    if($request->date_end != $request->date_end_old){

            $archive = new EthicalProtocolArchive;
    
            
            $archive->note = 'Modification du champ, Fin validité, de ce protocole par '.User::find(Auth::id())->name.', Ancienne valeur : '.$request->date_end_old.', Nouvelle valeur : '.$request->date_end;
            
            $archive->date = date("Y-m-d H:i:s", time());
            $archive->ethical_protocol_id = $id;
            $archive->user_id = Auth::id();
            $archive->save();
    }

    if($request->application_domain_id != $request->application_domain_id_old){

            $archive = new EthicalProtocolArchive;
            
            $archive->note = 'Modification du champ, Domaine, de ce protocole par '.User::find(Auth::id())->name.', Ancienne valeur : '.ApplicationDomain::find($request->application_domain_id_old)->title. ', Nouvelle valeur : '.ApplicationDomain::find($request->application_domain_id)->title;
            
            $archive->date = date("Y-m-d H:i:s", time());
            $archive->ethical_protocol_id = $id;
            $archive->user_id = Auth::id();
            $archive->save();
    }

    if($request->agrement_id != $request->agrement_id_old){

        $archive = new EthicalProtocolArchive;

        
        $archive->note = 'Modification du champ, N° agrément, de ce protocole par '.User::find(Auth::id())->name.', Ancienne valeur : '.Agrement::find($request->agrement_id_old)->name. ', Nouvelle valeur : '.Agrement::find($request->agrement_id)->name;
        
        $archive->date = date("Y-m-d H:i:s", time());
        $archive->ethical_protocol_id = $id;
        $archive->user_id = Auth::id();
        $archive->save();
    }

    if($request->severity_id != $request->severity_id_old){

            $archive = new EthicalProtocolArchive;

            
            $archive->note = 'Modification du champ, Classe de sévérité, de ce protocole par '.User::find(Auth::id())->name.', Ancienne valeur : '.Severity::find($request->severity_id_old)->title.', Nouvelle valeur : '.Severity::find($request->severity_id)->title;
            
            $archive->date = date("Y-m-d H:i:s", time());
            $archive->ethical_protocol_id = $id;
            $archive->user_id = Auth::id();
            $archive->save();
    }
        return redirect()->route("protocols.index");
}

    /**
     * Export the resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        //$this->authorize(__FUNCTION__); jackson modif pour permettre qu'un utilisateur puisse faire un export

        $protocols = EthicalProtocol::orderBy('ethical_number')->with("user")->get();

        $filename = 'Export_protocoles_éthiques - ' . date('Y_m_d') . '.xlsx';
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

        $columns = ["N° agrément",
                    "N° éthique",
                    "Titre",
                    "Résponsable",
                    "Nb animaux accordés",
                    "Domaine",
                    "Début validité",
                    "Fin validité",
                    "Classe de sévérité",
                    "Utilisateur(s) lié(s)",
                    "Fichier du protocole chargé sur ownCloud ?",
                    "E-mail d’acceptation chargé sur ownCloud ?",
                    "Attestation du protocole chargé sur ownCloud ?",
                    "Protocole modifié ?",
                    "Etude rétrospective complétée chargée sur ownCloud ?"];

        
        foreach($protocols as $key => $protocol) {
            $linked_users = "";
            foreach ($protocol->users as $user) {
                $linked_users .= $user->name . ' / ';
            }

            $uploaded = $protocol->uploaded ? 'Oui' : 'Non';
            $is_modified = $protocol->archives->isNotEmpty() ? 'Oui' : 'Non';
            $accepted = $protocol->accepted ? 'Oui' : 'Non';
            $acceptation_email = $protocol->acceptation_email ? 'Oui' : 'Non';
            $retrospective_study = $protocol->retrospective_study ? 'Oui' : 'Non';

           $datas[$key] = [$protocol->agrement->name,
                           $protocol->ethical_number,
                           $protocol->title,
                           $protocol->user->name,
                           $protocol->total_animals,
                           $protocol->domain->title,
                           $protocol->beginning,
                           $protocol->end,
                           $protocol->severity->title,
                           $linked_users,
                           $uploaded,
                           $acceptation_email,
                           $accepted,
                           $is_modified,
                           $retrospective_study];
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
        $this->authorize(__FUNCTION__); // seule la personne autorisé peut faire une suppression  
        
        $protocol = EthicalProtocol::findOrFail($id);

        if (!empty($protocol->valid_file)) {
            Storage::delete($protocol->valid_file);
        }

        $protocol->delete();
        return redirect()->route("protocols.index");
    }
}
