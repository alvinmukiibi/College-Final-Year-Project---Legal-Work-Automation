<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DueDiligence;
use App\File;
class DueDiligenceController extends Controller
{
    public function makeDueDiligence(Request $request){
        $case_id = $request->segment(4);

        $dd = new DueDiligence;
        $dd->case_id = $case_id;
        $diligences = $dd->getCaseDueDiligences();

        return view('firm.associate.due_diligence')->with(['caseID' => $case_id, 'diligences' => $diligences]);
    }
    public function storeAndGenerateNewName(){
        $fileName = $this->fileName;
        $request = $this->request;
        if($request->hasFile($fileName) && $request->file($fileName)->isValid()){
            $file = $request->file($fileName);
            $savedTo = 'public'.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR;
            $originalName = $file->getClientOriginalName();
            $name = pathinfo($originalName, PATHINFO_FILENAME);
            $replaced = \str_replace(' ', '_', $name);
            $newName = $replaced . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($savedTo, $newName);
            return $newName;
    }else{
        return null;
    }
    }
    public function addDueDiligence(Request $request){
        $data = $this->validate($request, [
            'caseID' => 'required|numeric',
            'date_carried_out' => 'required|date',
            'description' => 'nullable',
            'file1' => 'nullable|mimes:jpg,jpeg,png,zip,rar,docx,doc,xls,ppt,xlsx,pptx,txt,pdf,webp|max:10240',
            'file2' => 'nullable|mimes:jpg,jpeg,png,zip,rar,docx,doc,xls,ppt,xlsx,pptx,txt,pdf,webp|max:10240',
            'file3' => 'nullable|mimes:jpg,jpeg,png,zip,rar,docx,doc,xls,ppt,xlsx,pptx,txt,pdf,webp|max:10240',
            'file4' => 'nullable|mimes:jpg,jpeg,png,zip,rar,docx,doc,xls,ppt,xlsx,pptx,txt,pdf,webp|max:10240',
        ]);

        $due_d = new DueDiligence;
        $due_d->data = $data;
        $due_d->case_id = $request->input('caseID');

        $due_id = $due_d->addDueDiligence();

        $this->request = $request;
        $this->fileName = 'file1';
        $file1 = $this->storeAndGenerateNewName();
        $this->fileName = 'file2';
        $file2 = $this->storeAndGenerateNewName();
        $this->fileName = 'file3';
        $file3 = $this->storeAndGenerateNewName();
        $this->fileName = 'file4';
        $file4 = $this->storeAndGenerateNewName();

        $newFile = new File;
        $newFile->description = "due_diligence_file";
        $newFile->case_id = $request->input('caseID');
        $newFile->due_diligence_id = $due_id;

        if($file1 !== null){
            $newFile->location = $file1;
            $newFile->addFile();
        }
        if($file2 !== null){
            $newFile->location = $file2;
            $newFile->addFile();
        }
        if($file3 !== null){
            $newFile->location = $file3;
            $newFile->addFile();
        }
        if($file4 !== null){
            $newFile->location = $file4;
            $newFile->addFile();
        }


        return redirect()->back()->with('success', 'Information Successfully Saved!!');




    }
}
