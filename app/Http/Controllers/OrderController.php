<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Models\OrderSeccion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{


    public function seguimiento(Request $request)
    {
        $orders = new Order();
        $users = User::all();

        if ($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        if ($request->user_id) {
            $orders = $orders->where('user_id',  $request->user_id);
        }
        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(20);

        $total = $orders->map(function ($i) {
            return $i->total();
        })->sum();
        $receivedAmount = $orders->map(function ($i) {
            return $i->receivedAmount();
        })->sum();

        return view('orders.seguimiento', compact('users', 'orders', 'total', 'receivedAmount'));
    }
    public function agregarOdontograma(Request $request, Order $order)
    {
        //$imagen9 = $imagen8 = $imagen7 = $imagen6 = $imagen5 = $imagen4 = $imagen3 = $imagen2 = $imagen2 = $avatar_path = '';

        // dd( $request->descripcionOdontograma1. $request->descripcionOdontograma2);
        if ($request->SecondcheckboxInputOverrideUp1) {
            // echo($request->SecondcheckboxInputOverrideUp1);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 18,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp2) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 17,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp3) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 16,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp4) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 15,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverrideUp5) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 14,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp6) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 13,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp7) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 12,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp8) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 11,
                'order_id' => $order->id,
            ]);

            // /permanentes lado superior  derecho
            if ($request->SecondcheckboxInputOverrideUp9) {
                // echo($request->SecondcheckboxInputOverrideUp2);
                $orderSeccion = OrderSeccion::create([
                    'seccion_id' => 21,
                    'order_id' => $order->id,
                ]);
            }
        }
        if ($request->SecondcheckboxInputOverrideUp10) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 22,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverrideUp11) {
            //  echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 23,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverrideUp12) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 24,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverrideUp13) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 25,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverrideUp14) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 26,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverrideUp15) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 27,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverrideUp16) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 28,
                'order_id' => $order->id,
            ]);
        }
        // //488888888 abajo izquierda SecondcheckboxInputOverride1
        if ($request->SecondcheckboxInputOverride1) {
            // echo($request->SecondcheckboxInputOverride1);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 48,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride2) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 47,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride3) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 46,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride4) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 45,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverride5) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 44,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride6) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 43,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride7) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 42,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride8) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 41,
                'order_id' => $order->id,
            ]);

            // /permanentes lado inferior  derecho
            if ($request->SecondcheckboxInputOverride9) {
                // echo($request->SecondcheckboxInputOverrideUp2);
                $orderSeccion = OrderSeccion::create([
                    'seccion_id' => 31,
                    'order_id' => $order->id,
                ]);
            }
        }
        if ($request->SecondcheckboxInputOverride10) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 32,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverride11) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 33,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverride12) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 34,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverride13) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 35,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverride14) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 36,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverride15) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 37,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverride16) {
            // echo($request->SecondcheckboxInputOverride2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 38,
                'order_id' => $order->id,
            ]);
        }
        // ///////////////////////////////////////////////////////////
        // ////Odontograma Temporales superior derecho  SecondcheckboxInputOverrideUp1Kids
        if ($request->SecondcheckboxInputOverrideUp1Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 55,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverrideUp2Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 54,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp3Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 53,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp4Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 52,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverrideUp5Kids) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 51,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp6Kids) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 61,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp7Kids) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 62,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverrideUp8Kids) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 63,
                'order_id' => $order->id,
            ]);

            // /permanentes lado superior  derecho
            if ($request->SecondcheckboxInputOverrideUp9Kids) {
                // echo($request->SecondcheckboxInputOverrideUp2);
                $orderSeccion = OrderSeccion::create([
                    'seccion_id' => 64,
                    'order_id' => $order->id,
                ]);
            }
        }
        if ($request->SecondcheckboxInputOverrideUp10Kids) {
            // echo($request->SecondcheckboxInputOverrideUp2);
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 65,
                'order_id' => $order->id,
            ]);
        }

        /**** temporales  abado izquierda SecondcheckboxInputOverride1Kids  */
        if ($request->SecondcheckboxInputOverride1Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 85,
                'order_id' => $order->id,
            ]);
        }

        if ($request->SecondcheckboxInputOverride2Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 84,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride3Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 83,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride4Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 82,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride5Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 81,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride6Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 71,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride7Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 72,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride8Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 73,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride9Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 74,
                'order_id' => $order->id,
            ]);
        }
        if ($request->SecondcheckboxInputOverride10Kids) {
            $orderSeccion = OrderSeccion::create([
                'seccion_id' => 75,
                'order_id' => $order->id,
            ]);
        }

        $order->descripcionOdontograma1 = $request->descripcionOdontograma1;
        $order->descripcionOdontograma2 =  $request->descripcionOdontograma2;
        $order->save();
        return redirect()->route('orders.descripcion', $order)->with('success', 'El Odontograma Ingreso con exito!');

        // return redirect()->route('orders.index', $order)->with('success', 'El Odontograma Ingreso con exito!');

        // return 'success';
    }

    public function agregarDocumentos(Request $request, Order $order)
    {
        $documento = $documento2 = $documento3 = $documento4 = $documento_Fase = $archivo_STL = $archivo_STL_inferior =  $archivo_STL_mordida = $b_jarabak = $mc_namara = '';

        if ($request->hasFile('documento')) {
            $documento = $request->file('documento')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('documento2')) {
            $documento2 = $request->file('documento2')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('documento3')) {
            $documento3 = $request->file('documento3')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('documento4')) {
            $documento4 = $request->file('documento4')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('documento_Fase')) {
            $documento_Fase = $request->file('documento_Fase')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('archivo_STL')) {
            $archivo_STL = $request->file('archivo_STL')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('archivo_STL_inferior')) {
            $archivo_STL_inferior = $request->file('archivo_STL_inferior')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('archivo_STL_mordida')) {
            $archivo_STL_mordida = $request->file('archivo_STL_mordida')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('b_jarabak')) {
            $b_jarabak = $request->file('b_jarabak')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('mc_namara')) {
            $mc_namara = $request->file('mc_namara')->store('orders/' . $order->id, 'public');
        }

        $order->documento = $documento;
        $order->documento2 = $documento2;
        $order->documento3 = $documento3;
        $order->documento4 = $documento4;
        $order->documento_Fase = $documento_Fase;
        $order->archivo_STL = $archivo_STL;
        $order->archivo_STL_inferior = $archivo_STL_inferior;
        $order->archivo_STL_mordida = $archivo_STL_mordida;
        $order->b_jarabak = $b_jarabak;
        $order->mc_namara = $mc_namara;



        if (!$order->save()) {
            return redirect()->back()->with('error', 'Upps. Ha sucedido un error por favor ingrese nuevamente los datos.');
        }

        return redirect()->route('orders.odontograma', $order)->with('success', 'Documentos del tratamiento registrados con exito!. Ahora el odontograma');

        // return redirect()->route('orders.index')->with('success', 'EL Nuevo tratamiento Ingreso con exito!');

        // return 'success';
    }

    public function index(Request $request)
    {
        $orders = new Order();
        // echo (Auth::user()->id .Auth::user()->rol);
        if (Auth::user()->rol != "ADMINISTRADOR") {
            //   echo (Auth::user()->id .Auth::user()->rol);
            $orders = $orders->where('user_id', '=', Auth::user()->id);
        }


        if ($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(20);

        $total = $orders->map(function ($i) {
            return $i->total();
        })->sum();
        $receivedAmount = $orders->map(function ($i) {
            return $i->receivedAmount();
        })->sum();

        return view('orders.index', compact('orders', 'total', 'receivedAmount'));
    }

    public function store(OrderStoreRequest $request)
    {
        $avatar_path = '';
        if ($request->hasFile('avatar')) {
            $avatar_path = $request->file('avatar')->store('orders', 'public');
        }
        //  $last_week_start = date("Y-m-d",strtotime("monday last week"));
        // $last_week_end = date("Y-m-d",strtotime("sunday last week"));
        //  echo $last_week_start." ".$last_week_end;
        $cuotas = 1;
        $fecha = $request->fecha;

        $vencimiento = date('Y-m-d', strtotime('+1 month', strtotime($fecha)));
        //echo $request->descripcion;

        if (empty($request->estado)) {
            $estado =  'PENDIENTE';
        } else
            $estado = $request->estado;

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'vencimiento' => $vencimiento,
            'cheque' => $request->cheque,
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'descripcionOdontograma1' => $request->descripcionOdontograma1,
            'descripcionOdontograma2' => $request->descripcionOdontograma2,
            'user_id' => $request->user()->id,
            'cuenta_id' => 1,
            'cuotas' => 1,


            'avatar' => $avatar_path,
            'periodo' => $request->periodo, // dia de pago lunes
            'estado' => $estado,
            'codigo' => $request->descripcion,
        ]);

        // $order->save();

        $i = 1;
        for ($i; $i <= $cuotas; ++$i) {
            $vencimiento = date('Y-m-d', strtotime('+' . $i . 'month', strtotime($fecha)));

            $order->items()->create([
                'price' => 1,
                'quantity' => $i,
                'product_id' => 1,
                'estado' => 'SIN PAGAR',
                'fecha_pago' => $vencimiento,
            ]);
        }
        $request->user()->cart()->detach();

        return redirect()->route('orders.edit', $order)->with('success', 'Tratamiento registrado con exito!. Ahora las imagenes');

        // return view('users.show')->with('order', $order)->with('success', 'Ingreso creado con exito!');

        // return 'success';
    }

    public function odontograma(Request $request, Order $order)
    {
        $secciones = $order->secciones()->pluck('seccion_id');

        // echo $secciones;

        return view('orders.odontograma')->with('order', $order)->with('secciones', $secciones->all());
    }

    public function descripcion(Request $request, Order $order)
    {
        return view('orders.descripcion')->with('order', $order);
    }

    public function detalle(Request $request, order $order)
    {
        return view('orders.detalle')->whith('order',$order);
    }

    public function edit(Request $request, Order $order)
    {
        return view('orders.edit')->with('order', $order);
    }

    public function update(OrderStoreRequest $request, Order $order)
    {
        $cuotas = $request->payment_number;
        $fecha = $request->fecha;
        $periodo = $request->periodo;
        if ($periodo == 'Mensual') {
            //  echo 'Mensual';
            $vencimiento = date('Y-m-d', strtotime('+' . $cuotas . 'week', strtotime($fecha)));
        }

        if ($periodo == 'Semanal') {
            // echo 'Semanal';
            $vencimiento = date('Y-m-d', strtotime('+' . $cuotas . 'week', strtotime($fecha)));
        }
        $order->customer_id = $request->customer_id;
        $order->cuenta_id = 1;
        $order->vencimiento = $vencimiento;
        $order->cheque = $request->cheque;
        $order->fecha = $request->fecha;


        $order->user_id = $request->user()->id;
        $order->periodo = $request->periodo;
        $order->monto = $request->credito;
        $order->cuotas = $request->payment_number;
        $order->tasa = $request->utility;
        $order->descripcion = $request->descripcion;
        $order->descripcionOdontograma1 = $request->descripcionOdontograma1;
        $order->descripcionOdontograma2 = $request->descripcionOdontograma2;
        $order->monto->$request->monto;


        $order->estado = $request->estado;
        $order->codigo = $request->codigo;

        // echo($request->all());
        $order->items()->delete();

        $i = 1;
        for ($i; $i <= $cuotas; ++$i) {
            $vencimiento = date('Y-m-d', strtotime('+' . $i . 'month', strtotime($fecha)));
            if ($periodo == 'Semanal') {
                // echo 'Semanal';
                $vencimiento = date('Y-m-d', strtotime('+' . $i . 'week', strtotime($fecha)));
            }

            $order->items()->create([
                'price' => $request->monto_cuota,
                'quantity' => $i,
                'product_id' => 1,
                'fecha_pago' => $vencimiento,
            ]);
        }

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($order->avatar) {
                Storage::delete($order->avatar);
            }
            // Store avatar
            $avatar_path = $request->file('avatar')->store('orders', 'public');
            // Save to Database
            $order->avatar = $avatar_path;
        }

        if (!$order->save()) {
            return redirect()->back()->with('error', 'Upps. Ha sucedido un error por favor registre nuevamente los datos.');
        }

        return redirect()->route('orders.index')->with('success', 'Prestamo Modificado con exito!');

        // return 'success';
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function secciones(Order $order)
    {
        return view('orders.secciones', compact('order'));
    }

    public function agregarCuentas(Request $request, Order $order)
    {
        $imagenes = ['avatar', 'imagen2', 'imagen3', 'imagen4', 'imagen5', 'imagen6', 'imagen7', 'imagen8', 'imagen9'];

        foreach ($imagenes as $imagen) {
            if ($request->hasFile($imagen)) {
                // Almacena el archivo y guarda la ruta
                $ruta = $request->file($imagen)->store('orders/' . $order->id, 'public');
                // Asigna la ruta al campo correspondiente del modelo Order
                $order->{$imagen} = $ruta;
            }
        }

        // Guarda el objeto Order en la base de datos
        if (!$order->save()) {
            return redirect()->back()->with('error', 'Upps. Ha sucedido un error por favor ingrese nuevamente los datos.');
        }

        return redirect()->route('orders.secciones', $order)->with('success', 'Cuentas asociadas con el Ingreso con éxito!');




        /*$imagen9 = $imagen8 = $imagen7 = $imagen6 = $imagen5 = $imagen4 = $imagen3 = $imagen2 = $imagen2 = $avatar_path = '';

        if ($request->hasFile('avatar')) {
            $avatar_path = $request->file('avatar')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('imagen2')) {
            $imagen2 = $request->file('imagen2')->store('orders/' . $order->id, 'public');
        }
        if ($request->hasFile('imagen3')) {
            $imagen3 = $request->file('imagen3')->store('orders/' . $order->id, 'public');
        }

        if ($request->hasFile('imagen4')) {
            $imagen4 = $request->file('imagen4')->store('orders/' . $order->id, 'public');
        }

        if ($request->hasFile('imagen5')) {
            $imagen5 = $request->file('imagen5')->store('orders/' . $order->id, 'public');
        }

        if ($request->hasFile('imagen6')) {
            $imagen6 = $request->file('imagen6')->store('orders/' . $order->id, 'public');
        }

        if ($request->hasFile('imagen7')) {
            $imagen7 = $request->file('imagen7')->store('orders/' . $order->id, 'public');
        }

        if ($request->hasFile('imagen8')) {
            $imagen8 = $request->file('imagen8')->store('orders/' . $order->id, 'public');
        }

        if ($request->hasFile('imagen9')) {
            $imagen9 = $request->file('imagen9')->store('orders/' . $order->id, 'public');
        }

        if (!empty($avatar_path) && $avatar_path != '') {
            $order->avatar = $avatar_path;
        }
        if (!empty($imagen2) && $imagen2 != '') {
            $order->imagen2 = $imagen2;
        }
        if (!empty($imagen3) && $imagen3 != '') {
            $order->imagen3 = $imagen3;
        }
        if (!empty($imagen4) && $imagen4 != '') {
            $order->imagen4 = $imagen4;
        }
        if (!empty($imagen5) && $imagen5 != '') {
            $order->imagen5 = $imagen5;
        }
        if (!empty($imagen6) && $imagen6 != '') {
            $order->imagen6 = $imagen6;
        }
        if (!empty($imagen7) && $imagen7 != '') {
            $order->imagen7 = $imagen7;
        }
        if (!empty($imagen8) && $imagen8 != '') {
            $order->imagen8 = $imagen8;
        }
        if (!empty($imagen9) && $imagen9 != '') {
            $order->imagen9 = $imagen9;
        }
        if (!$order->save()) {
            return redirect()->back()->with('error', 'Upps. Ha sucedido un error por favor ingrese nuevamente los datos.');
        }

        return redirect()->route('orders.secciones', $order)->with('success', 'Cuentas asociadas con el Ingreso con exito!');

        // return 'success';*/
    }

    public function agregarDescripcion(Request $request, Order $order)
    {
        $order->descripcion = $request->descripcion;
        if (!$order->save()) {
            return redirect()->back()->with('error', 'Upps. Ha sucedido un error por favor ingrese nuevamente los datos.');
        }

        return redirect()->route('orders.index')->with('success', 'Nuevo tratamiento registrado con exito!');

        // return 'success';
    }

    public function agregarDetalle(Request $request, Order $order)
    {
        $order->detalle = $request->detalle;
        if (!$order->save()) {
            return redirect()->back()->with('error', 'Upps. Ha sucedido un error por favor ingrese nuevamente los datos.');
        }

        return redirect()->route('orders.index')->with('success', 'Tratamiento registrado con exito!');

        // return 'success';
    }


    public function estado(Order $order)
    {
        return view('orders.estado', compact('order'));
    }


    //aqui actualizo los datos del estado del seguimiento
    public function actualizarEstado(Request $request, Order $order)
    {
        $order->estado =  $request->estado;
        $order->responsable_produccion =  $request->responsable_produccion;
        $order->monto =  $request->monto;
        $order->pagado =  $request->pagado;
        $order->cuotas =  $request->cuotas;
        $order->alineadores_entregados = $request->alineadores_entregados;
        $order->alineadores_impresos_sup = $request->alineadores_impresos_sup;
        $order->alineadores_impresos_inf = $request->alineadores_impresos_inf;
        $order->alineadores_estampados_sup = $request->alineadores_estampados_sup;
        $order->alineadores_estampados_inf = $request->alineadores_estampados_inf;
        $order->enlace = $request->enlace;


        // dd($request->estado);
        if (!$order->save()) {
            return redirect()->back()->with('error', 'Upps. Ha sucedido un error por favor ingrese nuevamente los datos.');
        }

        return redirect()->route('seguimiento')->with('success', 'Estado Modificado con exito!.');

        // return 'success';
    }
    public function exportCSV()
    {
        $orders = Order::where(function ($query) {
            $query->whereColumn('monto', '>=', 'pagado')
                ->orWhere(function ($query) {
                    $query->where('monto', '>', 0)
                        ->whereNull('pagado');
                });
        })->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=deudores.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Numero', 'Profesional', 'Tipo', 'Estado', 'Monto', 'Pagado', 'Fecha'];

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF));
            $total_monto = 0;
            $total_pagado = 0;

            fputcsv($file, $columns, ';'); // Cambiar a punto y coma

            foreach ($orders as $order) {
                $total_monto = $total_monto + $order->monto;
                $total_pagado = $total_pagado + $order->pagado;
                fputcsv($file, [
                    $order->id,
                    $order->user->first_name . ', ' . $order->user->last_name,
                    $order->periodo,
                    $order->estado,
                    number_format($order->monto, 2, ',', '.'),
                    number_format($order->pagado, 2, ',', '.'),
                    $order->created_at
                ], ';');
            }
            fputcsv($file, [
                '-',
                '-',
                '-',
                'Total: ',
                number_format($total_monto, 2, ',', '.'),
                number_format($total_pagado, 2, ',', '.'),
                number_format($total_monto - $total_pagado, 2, ',', '.'),
            ], ';');
            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
