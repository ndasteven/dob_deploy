<?php

namespace App\Livewire\Admin;

use App\Imports\drenImport;
use App\Imports\ecoleImport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

use App\Imports\elevesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

use Maatwebsite\Excel\Facades\Excel;

class Admin extends Component
{
    
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $countSuperAdmin;
    public $countAdmin;
    public $countUtilisateur;
    public $search;
    public $ide;
    public $userName;
    public $creer,$edit;
    public $name,$prenom,$email,$password,$repeatPassword,$matchPass, $role;
    public function resetInput()
    {
        $this->name=$this->prenom=$this->email=$this->password=$this->repeatPassword=$this->matchPass=$this->role='';
    }
    
    public function research(){
        
        $this->search = $this->search;
    }
    public function storeUser(){
        
        $validate = $this->validate([
            'name'=>'required|min:3',
            'prenom'=>'required|min:3',
            'email' => 'required|email|max:255',
            'password'=>'required|min:8',
            'repeatPassword'=>'required|min:8',
            'role'=>'required|min:3',
            
        ]);
        if ($this->password===$this->repeatPassword) {
           if(!User::where('email', $this->email)->exists()){
            $validate['password'] = Hash::make($this->password);
            User::create($validate,);
                session()->flash("success", "Enregistrement effectué avec succès");
                $this->resetInput();
           }else{
            session()->flash("error", "Cet email de la fiche existe déja dans la base de données");
           }
        }else{
            session()->flash("error", "les mots de passe sont pas identiques");
        }
    }
    public function updateUser(){
        $validate = $this->validate([
            'name'=>'required|min:3',
            'prenom'=>'required|min:3',
            'email' => 'required|email|max:255',
            'role'=>'required|min:3',   
        ]);
        $userInfo = User::find($this->ide);
        if(strlen($this->password) <=0){
           if($userInfo->update($validate)){
            session()->flash("success", "Mise à jour effectué avec succès");
        }else{
            session()->flash("error", "Erreur de mise à jour");
        }  
        }else{
            if($this->password===$this->repeatPassword && strlen($this->password)>=8){
                $validate['password'] = $validate['password'] = Hash::make($this->password);
                if($userInfo->update($validate)){
                    session()->flash("success", "Mise à jour effectué avec succès");
                }else{
                    session()->flash("error", "Erreur de mise à jour");
                }
            }else{
                session()->flash("error", "Entrer un mot de passe conforme");
            }
        }
        
    }
    public function create(){
        $this->creer = true;
        $this->edit = false;
        $this->resetInput();
    }
    public function update($id){
        $this->ide = $id;
        $this->creer = false;
        $this->edit = true;
        
        $userEdit = user::where("id", $id)->get(); 
        $this->name= $userEdit[0]->name;
        $this->prenom= $userEdit[0]->prenom;
        $this->email= $userEdit[0]->email;
        $this->role= $userEdit[0]->role;
    }
    public function getUserId($id){
        $this->ide= $id;
        $userName = user::where("id", $this->ide)->get(); 
        $this->userName=$userName[0]->name.' '.$userName[0]->prenom;
    }
    public function deleteUser($a){
        if (Auth::check() && Auth::user()->id !== $a ){
        User::find($a)->delete();
        $this->ide="";
        $this->dispatch("deleteUser");
    }else{
       $this->dispatch("impossibledeleteUser");
    }
        
    }
    public function close(){
        $this->edit=false;
        $this->creer=false;
        $this->resetInput();
        
    }
    //traitement d'importion fichier  excel des élèves
    
    
    public $file;
    public $checkFile;
    public $uploadProgress = 0;

    public function fileUploaded()
    {
        // Traitement après le téléchargement du fichier
        // Vous pouvez effectuer des opérations supplémentaires ici
        $this->reset(['file', 'uploadProgress']);
        $this->emit('uploaded');
    }

    public function updatedFile()
    {
        $this->uploadProgress = 0;
    }

    public function updatingFile($value)
    {
        $this->uploadProgress = $value->getClientOriginalExtension();
    }
    public function importEleve(){
        $import=$this->validate([
            'file'=>'required|mimes:xlsx, xls|max:15240'
        ]);
        if($this->file){
            $data = Excel::queueImport(new elevesImport, $this->file);
            $this->file = '';
            $this->checkFile='';
            
        }else{
            session()->flash("importOK", "fichier erroné!");
        }
 
        session()->flash("importOK", "Verification du fichier importé...");
    }
    public function importEcole(){
        $import=$this->validate([
            'file'=>'required|mimes:xlsx, xls|max:15240'
        ]);
        if($this->file){
            $data = Excel::queueImport(new ecoleImport, $this->file);
            $this->file = '';
            $this->checkFile='';
            
        }else{
            session()->flash("importEcoleOK", "fichier erroné!");
        }
 
        session()->flash("importEcoleOK", "Verification du fichier importé...");
    }

    public function importDren(){
        
        $import=$this->validate([
            'file'=>'required|mimes:xlsx, xls|max:15240'
        ]);
        if($this->file){
            $data = Excel::queueImport(new drenImport, $this->file);
            $this->file = '';
            $this->checkFile='';
            
        }else{
            session()->flash("importDrenOK", "fichier erroné!");
        }
 
        session()->flash("importDrenOK", "Verification du fichier importé...");
    }


    //fin traitement d'importion fichier excel
    public function render()
    {
        
        $this->countSuperAdmin = User::where('role','superAdmin')->count();
        $this->countAdmin = User::where('role','admin')->count();
        $this->countUtilisateur = User::where('role','utilisateur')->count();
        return view('livewire.admin.admin',['userProfile'=>User::where("email","LIKE", "%".$this->search."%" )->paginate(5)]);
    }
}
