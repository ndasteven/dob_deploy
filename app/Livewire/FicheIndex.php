<?php

namespace App\Livewire;

use App\Models\dren;
use App\Models\ecole;
use App\Models\eleve;
use App\Models\fiche;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;
use Smalot\PdfParser\Parser; // bibliotehque pdf pour lire dans un fichier pdf;



class FicheIndex extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';   
    public $nom, $fiche_nom, $classe, $annee,$type_fiche, $ecole_id, $dren_id, $remarkFiche;
    public $search;
    public $shareAnnee;
    public $countFicheMatricule = 0;
    public $countFicheEleve=1;
    public $elevematricule;
    public $eleveFicheInfos;
    public $matriculesExtraits;
    public $icon;
    public $fileName;
    public $idefiche;
    public $ficheInfo;
    public $ide;
    public $backgroundUpload;
    public $creer,$edit;
    public $liste_students_fiche;
    public $serie;
    public $dateNaissance;
    public $elevefiche_eleveFichePivot;
    public $countMatricule = 0;
    public $resteMatricule;
    private function resetInput(){
        $this->nom = $this->fiche_nom=$this->classe=$this->annee=$this->ecole_id=$this->dren_id =$this->type_fiche=$this->remarkFiche="";
    }
    public function getfilenames(){
        $this->fileName ='file name : ' ; 
        
        if(strlen($this->fileName)>10){
            $this->dispatch("uploaded");
            $this->backgroundUpload = "green";
        }; 
        
    }
    public string $orderField= 'nom';
    public string $orderDirection = 'ASC';
    public function setOrderField(string $nom){
        if($nom === $this->orderField){
            $this->orderDirection = $this->orderDirection ==='ASC' ? 'DESC': 'ASC';
            $this->icon ='check';
        }else{
            $this->orderField = $nom;
            $this->reset('orderDirection');
            
        }
       
    }
    public function create(){
        $this->creer = true;
        $this->edit = false;
        $this->resetInput();
    }
    protected $queryString = [
        'search'=> ['except'=>''],
        'orderField'=> ['except'=>'title'],
        'oderDirection'=> ['except'=>'ASC']
    ];
    public function research(){
        $this->search = $this->search;
        
        
    }
    

    public function ficheinfo(){
        
        $fiche = $this->ficheInfo=fiche::with('fiche_dren')->with('fiche_ecole')->with("fiche_eleve")->where('fiches.id',$this->idefiche)->get() ;
        $fiches= fiche::find($this->idefiche); 
        $this->elevefiche_eleveFichePivot=$fiches->eleveS->merge(eleve::where('fiche_id',$this->idefiche)->get()); //une fusion des eleves qui ont cette fiche comme primaire et les eleve ayant fiche annex
        $this->countMatricule=$this->resteMatricule=0;

        
    }
    public function addStudentOnDecision(){ // function pour faire ressortir les matricules de la fiche
        $fiche = fiche::where('fiches.id',$this->idefiche)->get() ;
        $parser = new Parser(); 
        $pdfFilePath = storage_path('app/public/fiche_orientation/'.$fiche[0]->fiche_nom);
        $pdf = $parser->parseFile($pdfFilePath);
        $text = $pdf->getText();
        // Expression régulière pour rechercher les numéros de matricules
        $pattern = '/\b\d{8}[A-Za-z]\b/'; // Supposons que les numéros de matricule ont 8 chiffres

        // Recherche des correspondances avec l'expression régulière
        preg_match_all($pattern, $text, $matches);

        // Les numéros de matricules extraits
        $this->matriculesExtraits = $matches[0];
        $this->recupInfoMatricule();
        
       
    }
    public function recupInfoMatricule(){  //fonction pour aficher les informations du matricule trouver en cour de la
     
     $this->countFicheMatricule = count($this->matriculesExtraits); //on compte le nombre de matricule trouve dans la fiche
     if($this->countFicheMatricule>0){ // si le nombre de matricule est supperieur a zero alors on peut attribuer des fiche aux eleves ayant ses matricules
         
        if($this->countMatricule < $this->countFicheMatricule){
                $this->elevematricule=  $this->matriculesExtraits[$this->countMatricule]; //on recupère le premier matricule sur la fiche selectionner
                if(eleve::where('matricule', $this->elevematricule)->exists()){ // on verifie si un élève existe sous ce matricule
                    $eleve=eleve::with('eleve_fiche')->where('matricule', $this->elevematricule)->get();
                    $this->eleveFicheInfos=$eleve;   
                }else{
                    $this->eleveFicheInfos=null;
                } 
        }
          
        }
        
    }
    public function nextMatricule(){
        
            $this->countMatricule++;
            $this->resteMatricule = $this->countFicheMatricule - $this->countMatricule;
            $this->recupInfoMatricule();  
        
        
    }
    public function searcheMatricule(){
        $validate = $this->validate([
            'elevematricule'=>'required|min:9|max:9'
        ]);
        if(eleve::where('matricule', $this->elevematricule)->exists()){ // on verifie si un élève existe sous ce matricule
            $eleve=eleve::with('eleve_fiche')->where('matricule', $this->elevematricule)->get();
            $this->eleveFicheInfos=$eleve;  
            
           }else{
            $this->eleveFicheInfos=null;
           }        
    }
    public function updateDateNaissance($id){ //on modifie la date de naissance pour le matricule extrait sur la fiche si ya lieu
        $validate = $this->validate([
            'dateNaissance'=>'required|date'
        ]);
        $eleveupdate = eleve::find($id);
        if($eleveupdate->update($validate)){ //on modifie la serie pour un eleve de seconde pour le matricule extrait sur la fiche si ya lieu
            session()->flash("valide_date", "Mise à jour effectué avec succès");
        }
    }
    public function updateSerie($id){
        $validate = $this->validate([
            'serie'=>'required|min:1'
        ]);
        $eleveupdate = eleve::find($id);
        if($eleveupdate->update($validate)){
            session()->flash("valide_serie", "Mise à jour effectué avec succès");
        }
    }
    public function attribuerDecision($id){ //fonction pour attribuer la decision aux eleves donc les matricules ont été trouvé
        $eleve = eleve::find($id);
        if($eleve->fiche_id== null){
            
            if($eleve->update(['fiche_id'=>$this->ficheInfo[0]->id,'ecole_A'=>$this->ficheInfo[0]->ecole_id, 'annee'=>$this->ficheInfo[0]->annee,'classe'=>$this->ficheInfo[0]->classe])){
                session()->flash("success", "Décision a bien été attribué");
                $this->dispatch('mise_a_jour');
                $this->dispatch('update')->to(StudentTable::class);
                $this->dispatch('update')->to(FicheTable::class);
            }else{
                session()->flash("error", "Erreur de mise à jour");
            }
        }else{
          $count_fiche = 0;
            foreach($eleve->ficheS as $fiche){ //on verifie dans la table pivot eleve_fiche si il ya une fiche qui est selectionner associer deja a l'eleve
                if($fiche->id==$this->ficheInfo[0]->id){
                    $count_fiche++;  // si oui on incremente le nombre de fiche
                }
            }
            if($eleve->fiche_id != $this->ficheInfo[0]->id && $count_fiche==0){//on verifie si la seconde id de la seconde fiche a attribuer est differente de celle de la premiere fiche reçu
                $eleve->ficheS()->attach($this->ficheInfo[0]->id);
                $eleve->update(['ecole_A'=>$this->ficheInfo[0]->ecole_id, 'annee'=>$this->ficheInfo[0]->annee,'classe'=>$this->ficheInfo[0]->classe] );
                session()->flash("success", "Décision a bien été attribué");
                $this->dispatch('mise_a_jour');
            }else{
                $this->dispatch('update')->to(StudentTable::class);
                $this->dispatch('update')->to(FicheTable::class);
                session()->flash("error", "Décision déjà attribué à l'élève");
            }
         
        }

        
        
    }
    public function mise_a_jour(){ //permet juste de rafraichir la modification des fichier detacher 
        //on a fait expres de le laisser vide
        
    }
    public function closefiche(){
        $this->ficheInfo="";
        $this->liste_students_fiche="";
        $this->creer = false;
        $this->edit = false;
        $this->countFicheMatricule=0;
        $this->eleveFicheInfos=null;
    }
    public function storeFiche(){
        $validate = $this->validate([
            'nom'=>'required|min:3',
            'fiche_nom'=>'required|file|mimes:pdf|max:4000',
            'classe'=>'required|min:1',
            'type_fiche'=>'required|min:5',
            'ecole_id'=>'required|min:1',
            'dren_id'=>'required|min:1',
            'annee'=>'required|min:4',
            'remarkFiche'=>'',
        ]);
        if($this->fiche_nom!==null ){
            $extensiValide = array("PDF","pdf");
            $fichiers = $this->fiche_nom->store('fiche_orientation', 'public');
            $this->fiche_nom= basename($fichiers);
            $validate['fiche_nom'] = $this->fiche_nom;
            
            if(in_array((pathinfo($this->fiche_nom, PATHINFO_EXTENSION)),$extensiValide)){

                if(!fiche::where('nom', $this->nom)->exists() ){
                   fiche::create($validate);
                    session()->flash("success", "Enregistrement effectué avec succès");
                    $this->resetInput();
                    $this->fiche_nom==null; 
                    $this->dispatch('save');
                    $this->dispatch('create')->to(FicheTable::class);
                }else{
                    $nom=trim($this->nom, " \t"); // je supprime des espace en fin du nom de la fiche s'il en a
                    $Type_fiche=fiche::select('type_fiche')->where('nom','like', '%'.$nom.'%')->get();
                    if(count($Type_fiche)>0){
                        if($Type_fiche[0]->type_fiche!=$this->type_fiche){//on verifie si la fiche dont le nom existe a le meme type que la fiche qui est entrain detre creer 
                        fiche::create($validate);
                        session()->flash("success", "Enregistrement effectué avec succès");
                        $this->resetInput();
                        $this->fiche_nom==null; 
                        $this->dispatch('save');
                        $this->dispatch('create')->to(FicheTable::class);
                        }else{// si oui le type est identique aussi alors la fiche existe
                        session()->flash("error", "Ce nom de la fiche existe déja dans la base de données");
                        $this->dispatch('error');  
                    }
                    }
                    
                    
                }
                    
            }else{
                $this->fileName='erreur de fichier! selectionner le fichier au format PDF';
                $this->dispatch('errorFile');
            }
        } 
        
    }
    public function close(){
        $this->edit=false;
        $this->creer=false;
        $this->resetInput();
        $this->backgroundUpload = " ";
        
    }
    public function update($id){
        $this->ide = $id;
        $this->creer = false;
        $this->edit = true;
        
        $ficheEdit = fiche::where("id", $id)->get(); 
        $this->nom = $ficheEdit[0]->nom;
        $this->fiche_nom = $ficheEdit[0]->fiche_nom;
        $this->classe = $ficheEdit[0]->classe;
        $this->annee = $ficheEdit[0]->annee;
        $this->type_fiche = $ficheEdit[0]->type_fiche;
        $this->remarkFiche = $ficheEdit[0]->remarkFiche;
        $this->ecole_id = $ficheEdit[0]->ecole_id;
        $this->dren_id = $ficheEdit[0]->dren_id;
        $this->dispatch('check');
 
        $getEcoleOrigin = collect(ecole::select('id','NOMCOMPLs')->where('id',$this->ecole_id)->first());
        $this->dispatch('getEcoleOrigin', id:$this->ecole_id, data:$getEcoleOrigin);

       
    }
    public function updateFiche(){
        $validate = $this->validate([
            'nom'=>'required|min:3',
            'type_fiche'=>'required|min:5',
            'classe'=>'required|min:1',
            'ecole_id'=>'required|min:1',
            'dren_id'=>'required|min:1',
            'annee'=>'required|min:4',
            'remarkFiche'=>'',
        ]);
        $ficheInfo = fiche::find($this->ide);
        
        if(strlen($this->fiche_nom) >=10 && !is_string($this->fiche_nom)){
            $extensiValide = array("PDF","pdf");
            Storage::disk('public')->delete('fiche_orientation/'.$ficheInfo->fiche_nom);//supprime la precedente fiche
            $fichiers = $this->fiche_nom->store('fiche_orientation', 'public');
            $this->fiche_nom= basename($fichiers);
            $validate['fiche_nom'] = $this->fiche_nom;
            if($ficheInfo->update($validate)){
                session()->flash("success", "Mise à jour effectué avec succès");
                $this->dispatch('update')->to(FicheTable::class);
                $this->dispatch('save');
            }else{
                session()->flash("error", "Erreur de mise à jour");
                $this->dispatch('error');
            }
        }else{
            if($ficheInfo->update($validate)){
                session()->flash("success", "Mise à jour effectué avec succès");
                $this->dispatch('update')->to(FicheTable::class);
                $this->dispatch('save');
            }else{
                session()->flash("error", "Erreur de mise à jour");
                $this->dispatch('error');
            }   
        }
       
    }
    public function getEcole($ecole){// fountion qui fait une recherche des ecole grace a la saisi de utilisateur dans le tomSelect de la vue modal_form_student
        $mots = explode(' ', $ecole);
        $result = collect(ecole::select('id','NOMCOMPLs')->where(function($query) use ($mots) {
            foreach ($mots as $mot) {
                $query->where('NOMCOMPLs', 'like', '%' . $mot . '%');
            }
        })
        ->orderBy('created_at', 'desc')  // Tri par date de création décroissante
        ->take(3)
        ->get());
        return $result;
    }
    public function render()
    {
        $elevesPagines=[]; //important
        $this->shareAnnee = session('shareYear');
        $matriculeRecherche=$this->search;
        if($this->elevefiche_eleveFichePivot){
         $elevesFiches=$this->elevefiche_eleveFichePivot->filter(function ($eleve) use ($matriculeRecherche) {
            return stripos($eleve->matricule, $matriculeRecherche) !== false;
            
        }); 
        //ne pouvant pas utiliser paginate() directement sur la fusion $this->elevefiche_eleveFichePivot on utilise ce mode pagination
        $page = Request::get('page'); // Récupérer le numéro de page à partir de la requête, par défaut 1
        $perPage = 10; // Nombre d'éléments par page
        
        $sliced =  $elevesFiches->slice(($page - 1) * $perPage, $perPage); // Extraire les éléments pour la page en cours
        
        $elevesPagines = new LengthAwarePaginator($sliced, $elevesFiches->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(), // Résoudre le chemin de la pagination
            'pageName' => 'page',
        ]);
        }
        //fin
        
        return view('livewire.fiche-index',[ 
            'liste_students_fiches'=>$elevesPagines,           
            'ecole'=>ecole::select('id','NOMCOMPLs')->get(),
            'codeDren'=>  dren::select('id','code_dren','nom_dren')
            ->orderBy('code_dren', 'ASC')
            ->get() ,
            "colorUpload"=>$this->backgroundUpload ,
            "eleveFicheInfo"=>$this->eleveFicheInfos
        ]);
    }
}
