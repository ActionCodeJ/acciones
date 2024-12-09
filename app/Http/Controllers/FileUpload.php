<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileUpload extends Controller
{
    //
    public function index()

    {

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
