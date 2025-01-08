<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Image;
use App\Models\Localidad;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the outlet.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //*$this->authorize('manage_outlet');

        $outletQuery = Outlet::query();
        $outletQuery->where('name', 'like', '%'.request('q').'%');
        $outlets = $outletQuery->paginate(25);

        return view('outlets.index', compact('outlets'));
    }

    /**
     * Show the form for creating a new outlet.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        //$this->authorize('create', new Outlet);
       $action_id= $request->get("action_id");
       $action = Action::find($action_id);
       $localidad=$action->localidad;
       $latitude=-24.185595; 
       $longitude=-65.298916;
       if(!empty($localidad)){
            $departamento=$action->localidad->departamento;
            //print_r($departamento);
            if(!empty($departamento)){
                if(!empty($departamento->latitude))
                $latitude=$departamento->latitude;

                if(!empty($departamento->longitude))
                $longitude=$departamento->longitude;
                 

            }
       }

        
        return view('outlets.create', compact('action','latitude','longitude'));
    }

    /**
     * Store a newly created outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //$this->authorize('create', new Outlet);

        $newOutlet = $request->validate([
            'name'      => 'required|max:60',
            'action_id'   => 'nullable',
            'observacion'   => 'nullable|max:255',
            'celular'   => 'nullable|max:25',
            'email'     => 'nullable|email',
            'latitude'  => 'required|required_with:longitude|max:15',
            'longitude' => 'required|required_with:latitude|max:15',
        ]);
		
		if(empty(auth()->id())){
			$newOutlet['creator_id'] = 2;
		}else
             $newOutlet['creator_id'] = auth()->id();

        $outlet = Outlet::create($newOutlet);

        return redirect()->route('actions.index');
       // return redirect()->route('outlet_map.index');
    
    }

    /**
     * Display the specified outlet.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\View\View
     */
    public function show(Outlet $outlet)
    {
        
        
        $imgQuery = Image::query();
        $imgQuery->where('outlet_id', '=', $outlet->id);
        $imagenes = $imgQuery->paginate(5);
        
       // print_r($imagenes);
       return view('outlets.mostrar', compact('outlet','imagenes') );
 
       // return view('outlets.show', compact('outlet','imagenes') );
    }

    /**
     * Show the form for editing the specified outlet.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\View\View
     */
    public function edit(Outlet $outlet)
    {
      //  $this->authorize('update', $outlet);

      $latitude=-24.185595; 
       $longitude=-65.298916;
       if(!empty($outlet)){
          
            //print_r($departamento);
            
                if(!empty($outlet->latitude))
                $latitude=$outlet->latitude;

                if(!empty($outlet->longitude))
                $longitude=$outlet->longitude;
                 

           
       }

     //   echo ('latitude:'.$latitude.'---longitude:'.$longitude);
        return view('outlets.edit', compact('outlet','latitude','longitude'));


    }

    /**
     * Update the specified outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Outlet $outlet)
    {
       // $this->authorize('update', $outlet);

        $outletData = $request->validate([
            
            
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);


        $outlet->update($outletData);

        return redirect()->route('actions.show', $outlet->action_id);
    }

    /**
     * Remove the specified outlet from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Outlet $outlet)
    {
        $this->authorize('delete', $outlet);

        $request->validate(['outlet_id' => 'required']);

        if ($request->get('outlet_id') == $outlet->id && $outlet->delete()) {
            return redirect()->route('outlets.index');
        }

        return back();
    }
}
