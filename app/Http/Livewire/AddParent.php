<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\ParentAttachement;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;

    public $successMessage='',$updateMode=false;
    public $showtable=true;
    public $currentStep=1,$Parent_id,

 // Father_INPUTS
        $Email, $Password,$photos,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;


    public function render()
    {

        return view('livewire.add-parent',[
            'Nationalities' => Nationality::all(),
            'Type_Bloods' => Blood::all(),
            'Religions' => Religion::all(),
            'my_parents'=>My_Parent::all(),
        ]);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);

    }

    public function firstStepSubmit(){

        $this->validate([

            'email' => 'required|unique:my__parents,Email,'.$this->id,
            'password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my__parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',

        ]);

        $this->currentStep=2;
    }

    public function secondStepSubmit(){

        $this->validate([

            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep=3;
    }

    public function back($s){
        $this->currentStep=$s;
    }

    public function submitForm(){

        My_Parent::create([

            'email' => $this->Email,
            'password' => Hash::make($this->Password),
            'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
        'National_ID_Father' => $this->National_ID_Father,
        'Phone_Father' => $this->Phone_Father,
        'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
        'Passport_ID_Father' => $this->Passport_ID_Father,
        'Nationality_Father_id' => $this->Nationality_Father_id,
        'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
        'Religion_Father_id' => $this->Religion_Father_id,
        'Address_Father' => $this->Address_Father,

        // Mother_INPUTS
        'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
        'National_ID_Mother' => $this->National_ID_Mother,
        'Phone_Mother' => $this->Phone_Mother,
        'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
        'Passport_ID_Mother' => $this->Passport_ID_Mother,
        'Nationality_Mother_id' => $this->Nationality_Mother_id,
        'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
        'Religion_Mother_id' => $this->Religion_Mother_id,
        'Address_Mother' => $this->Address_Mother,

        ]);

        if (!empty($this->photos)){

            foreach ($this->photos as $photo){
                $photo->storeAs($this->Nationality_Father_id,$photo->getClientOriginalName(),$disk='parent_attach');

                ParentAttachement::create([
                   'file_name'=>$photo->getClientOriginalName(),
                    'parent_id'=>My_Parent::latest()->first()->id,
                ]);
            }

        }


        $this->successMessage = trans('site.Added successfully!');
        $this->clearForm();
        $this->currentStep = 1;
    }


    public function firstStepSubmit_edit(){
        $this->updateMode=true;
        $this->currentStep = 2;

    }

    public function secondStepSubmit_edit(){
        $this->updateMode=true;
        $this->currentStep = 3;

    }

    public function edit($id){

        $this->showtable=false;
        $this->updateMode=true;

        $parent=My_Parent::find($id);


        $this->Parent_id=$parent->id;
        $this->Email=$parent->email;
        $this->Password=$parent->password;
        $this->Name_Father = $parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father_en = $parent->getTranslation('Name_Father', 'en');
        $this->Job_Father = $parent->getTranslation('Job_Father', 'ar');;
        $this->Job_Father_en = $parent->getTranslation('Job_Father', 'en');        $this->National_ID_Father=$parent->National_ID_Father;
        $this->Phone_Father=$parent->Phone_Father;
        $this->Passport_ID_Father=$parent->Passport_ID_Father;
        $this->Nationality_Father_id=$parent->Nationality_Father_id;
        $this->Blood_Type_Father_id=$parent->Blood_Type_Father_id;
        $this->Religion_Father_id=$parent->Religion_Father_id;
        $this->Address_Father=$parent->Address_Father;
        $this->Name_Mother = $parent->getTranslation('Name_Mother', 'ar');
        $this->Name_Mother_en = $parent->getTranslation('Name_Father', 'en');
        $this->Job_Mother = $parent->getTranslation('Job_Mother', 'ar');;
        $this->Job_Mother_en = $parent->getTranslation('Job_Mother', 'en');        $this->National_ID_Mother=$parent->Nationality_Mother_id;
        $this->Phone_Mother=$parent->Phone_Mother;
        $this->Passport_ID_Mother=$parent->Passport_ID_Mother;
        $this->Nationality_Mother_id=$parent->Nationality_Mother_id;
        $this->Blood_Type_Mother_id=$parent->Blood_Type_Mother_id;
        $this->Religion_Mother_id=$parent->Religion_Mother_id;
        $this->Address_Mother=$parent->Address_Mother;

    }



    public function submitForm_edit()
    {

        if ($this->Parent_id){
            $parent=My_Parent::find($this->Parent_id);

            $parent->update([

                'email' => $this->Email,
                'password' => Hash::make($this->Password),
                'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'National_ID_Father' => $this->National_ID_Father,
                'Phone_Father' => $this->Phone_Father,
                'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'Nationality_Father_id' => $this->Nationality_Father_id,
                'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
                'Religion_Father_id' => $this->Religion_Father_id,
                'Address_Father' => $this->Address_Father,

                // Mother_INPUTS
                'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
                'National_ID_Mother' => $this->National_ID_Mother,
                'Phone_Mother' => $this->Phone_Mother,
                'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                'Passport_ID_Mother' => $this->Passport_ID_Mother,
                'Nationality_Mother_id' => $this->Nationality_Mother_id,
                'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
                'Religion_Mother_id' => $this->Religion_Mother_id,
                'Address_Mother' => $this->Address_Mother,


            ]);

            return redirect()->to('/add-parent');
        }

    }




    //clearForm
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }

    public function showformadd(){
        $this->showtable=false;
    }


    public function delete($id){
        $parent=My_Parent::findOrFail($id);

        $attachment=ParentAttachement::where('parent_id',$id)->first();

        if (!empty($attachment->file_name)){
            Storage::disk('parent_attach')->deleteDirectory('$this->Nationality_Father_id');
        }

        $parent->delete();

        return redirect()->to('/add-parent');
    }

}
