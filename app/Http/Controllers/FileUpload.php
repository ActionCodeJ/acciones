<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use File;
use Illuminate\Support\Facades\Session;

class FileUpload extends Controller
{
    //
   
/**
 * Function to covert all DB files to Zip
 */
public function converToZip($imgarr)
{
            $zip = new ZipArchive;
            $storage_path =  public_path();
            $timeName = 'FotosSeleccionadas'.time();
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

        
        if(isset($request->numero) && is_array($request->numero))
        {
            return redirect()->back()->with('error', 'Para la descarga debe seleccionar al menos una imagen.');
        }


        $imagenes=$request->numero;

      
        if (empty($imagenes) ) {
           // dd( $imagenes);
           Session::flash('success', ' Documento eliminado!!!'); 
            return redirect()->back()->with('error', 'Para la descarga debe seleccionar al menos una imagen.');
        }

       
        $i=0;
    	foreach ($imagenes as $valor){
           
           // echo($valor);
            $imagen= Image::find($valor);
           // echo( public_path(). '-ruta'. $imagen->image_path);
            $imgarr[] =  public_path(). '/' . $imagen->image_path;
            $i++;
            

        }
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
                 // dd($actions);
                  $images = Image::whereIn('action_id', $actions)->get();
         }else
 
        

    	$images = Image::get();

    	return view('actions.image-gallery',compact('images'));

    }

    public function eliminar($id)

    {

    	Image::find($id)->delete();

    	return back()

    		->with('success','Imagen eliminada correctamente !!.');	

    }
    
    public function destroy(Image $image)
    {
        if (!$image) {
            return redirect()->back()->with('error', 'Sorry, A sucedido un inconveniente al eliminar el documento.');
        }
        
        $action=$image->action;
        Storage::delete($image->image_path);
        

        $image->delete();
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
    return view('file-upload');
  }
  public function upload(Request $request)

  {

      $this->validate($request, [

          'title' => 'required',

          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

      ]);



      $input['image'] = time().'.'.$request->image->getClientOriginalExtension();

      //$request->image->move(public_path('images'), $input['image']);
      $fileName = $request->image->getClientOriginalName();
      $request->image->move('uploads', $fileName, 'public');


      $input['name'] = $request->title;
      $input['image_path'] = '/uploads/' . $fileName;
      
      Image::create($input);



      return back()

          ->with('success','Image Uploaded successfully.');

  }
  public function fileUpload(Request $req){
        $req->validate([
        'imageFile' => 'required',
         'imageFile.*' => 'image|mimes:jpg,jpeg,png,gif|max:4048'
        ]);

        
        
        if($req->hasFile('imageFile')){
            foreach ($req->file('imageFile') as $imagen) {
                 $fileName = $imagen->getClientOriginalName();
                 //$filePath= public_path().'/image/' .$fileName;
                 $imagen->move('uploads', $fileName, 'public');
                  $fileModel = new Image() ;
     

            $fileModel->action_id = $req->action_id;
            $fileModel->name = $fileName;
            $fileModel->image_path = '/uploads/' . $fileName;
            $fileModel->save();
            }
            
            
        }
               
       ////Session::flash('message', 'Las Imagenes han sido registradas con exito!');

            return back()
            ->with('success','!!! Las Imagenes han sido registradas con exito!!!!!!!!.')
            ->with('file', $fileName);
        
   }
}
