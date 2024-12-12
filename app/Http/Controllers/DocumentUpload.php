<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Document;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use ZipArchive;


class DocumentUpload extends Controller
{

    public function converToZip($imgarr)
    {
                $zip = new ZipArchive;
                $storage_path =  public_path();
                $timeName = 'ArchivosSeleccionados'.time();
                $zipFileName = $storage_path . '/' . $timeName . '.zip';
                $zipPath = asset($zipFileName);
                if ($zip->open(($zipFileName), ZipArchive::CREATE) === true) {
                    foreach ($imgarr as $relativName) {
                        $zip->addFile($relativName,"/".$timeName."/".basename($relativName));
                    }
                    $zip->close();
    
                    if ($zip->open($zipFileName) === true) {
                        return response()->download($zipFileName);
                        unlink($zipFileName);//Destruye el archivo temporal
    
                        //return $zipPath;
                    } else {
                        return false;
                    }
                }
    }
    
    
        public function descargar(Request $request)
    
        {
    
           
           
    
    
            $imagenes=$request->numero;
           // dd($imagenes);

          
            if (empty($imagenes) ) {
               
               Session::flash('success', ' Documento eliminado!!!'); 
                return redirect()->back()->with('error', 'Para la descarga debe seleccionar al menos una archivo.');
            }
    
           
            $i=0;
          //  dd($i);
            foreach ($imagenes as $valor){
               
              // echo($valor);
                $document= Document::find($valor);
               /// echo( public_path(). '-ruta'. $document->path);
                $imgarr[] =  public_path() . $document->path;
                $i++;
                
    
            }

          //  dd($imgarr);
            if (empty($i)) {
                session()->flash('error', 'Selecione al menos un checkbox');
    
                return redirect()->back()->with('error', 'Para la descarga debe seleccionar al menos una imagen.');
            }

          
            $ziplink = $this->converToZip($imgarr);
            return $ziplink;
    
        }
    

    public function index(Request $request)

    {

        
        // Verificamos si hay un término de búsqueda
        if ($request->has('search') && $request->search != null) {
            // Iniciamos la consulta para obtener las acciones con la relación de 'localidad' y 'departamento' de la localidad
        $query = Action::orderBy('id', 'desc')->with('localidad.departamento');


        $search = $request->search;
        // Filtramos las acciones por el contenido de las columnas 'nombre' y 'descripcion', o por el nombre de la localidad
        $query->where('nombre', 'LIKE', "%$search%")
            ->orWhere('descripcion', 'LIKE', "%$search%")
            ->orWhere('tags', 'LIKE', "%$search%")

            ->orWhere('fecha', 'LIKE', "%$search%")

            ->orWhereHas('localidad', function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%")
                    ->orWhereHas('departamento', function ($q) use ($search) {
                        $q->where('nombre', 'LIKE', "%$search%");
                    });
            })
            ->orWhereHas('entidad', function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%$search%");
            });
                // Ejecutamos la consulta y obtenemos las acciones filtradas
                $actions = $query->pluck('id');
           //  dd($actions);
                $documentos = Document::whereIn('action_id', $actions)->get();
        }else

    	$documentos = Document::get();

    	return view('actions.archivos-gallery',compact('documentos'));

    }




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
