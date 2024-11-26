<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Document;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class DocumentUpload extends Controller
{
    //
    public function destroy(Document $document)
    {
        if (!$document) {
            return redirect()->back()->with('error', 'Sorry, A sucedido un inconveniente al eliminar el documento.');
        }
        
        $action=$document->action;
        Storage::delete($document->path);
        

        $document->delete();
      //  Session::flash('success', ' Documento eliminado!!!'); 


      return back()
      ->with('success','!!! Documento eliminado !!!!!!!!.')
      ;

        return response()->json([
            'success' => '!!! Documento eliminado!!!!!!!!.',
            "message" => "Documento eliminado!"

        ])  ;
//print_r($action);
        //return redirect()->route('actions.documentUpload',$action )->with('success', 'Documento Eliminado correctamente.');

    }
    
     public function createForm(){
    return view('document-upload');
  }

  public function DocumentUpload(Request $req){
        $req->validate([
        'documentFile' => 'required',
         'documentFile.*' => 'file|mimes:pdf,doc,docx|max:4048'
        ]);

        
        
        if($req->hasFile('documentFile')){
            foreach ($req->file('documentFile') as $document) {
                 $fileName = $document->getClientOriginalName();
                 //$filePath= public_path().'/Document/' .$fileName;
                 $document->move('uploads/'. $req->action_id, $fileName, 'public');
                  $fileModel = new Document() ;
     

            $fileModel->action_id = $req->action_id;
            $fileModel->name = $fileName;
            $fileModel->path = '/uploads/'. $req->action_id.'/'. $fileName;
            $fileModel->save();
            }
            
            
        }
        $action = Action::find($req->action_id);
  
     //  Session::flash('message', 'Los Documentos  han sido registradas con exito!');
     //  return view('actions.document', $action, compact('action'));

       return redirect()->route('actions.documentUpload', $action)->with('success', 'Los Documentos  han sido registradas con exito.');

       


       /*
            return back()
            ->with('success','!!! Los Documentos han sido registrados con exito :) !!!!!!!!.')
            ->with('file', $fileName);
            */
        
   }
}
