<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaStoreRequest;
use App\Models\Area;
use App\Models\Finca;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;

use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filename = 'demo.pdf';
  
        $data = [
            'title' => 'Generate PDF using Laravel TCPDF - ItSolutionStuff.com!'
        ];
  
        $html = view()->make('pdfSample', $data)->render();
  
        $pdf = new TCPDF;
          
        $pdf::SetTitle('Hello World');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
  
        $pdf::Output(public_path($filename), 'F');
  
        return response()->download(public_path($filename));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fincas = Finca::all();

        return view('areas.create')->with('fincas', $fincas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AreaStoreRequest $request)
    {
        $area = Area::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'ubicacion' => $request->ubicacion,
            'responsable' => $request->responsable,
            'finca_id' => $request->finca_id,
            'user_id' => 1,
        ]);

        if (!$area) {
            return redirect()->back()->with('error', 'Sorry, No se creo la area.');
        }

        return redirect()->route('areas.index')->with('success', 'area craeda con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        return view('areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $area->nombre = $request->nombre;
        $area->descripcion = $request->descripcion;

        $area->responsable = $request->responsable;
        $area->ubicacion = $request->ubicacion;

        if (!$area->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating the area.');
        }

        return redirect()->route('areas.index')->with('success', 'Success, la area ha sido modificada.');
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
