<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Cuenta;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {
        $orders = new OrderItem();
        if ($request->start_date) {
            $orders = $orders->where('fecha_pago', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $orders = $orders->where('fecha_pago', '<=', $request->end_date.'');
        }
        $orders = $orders->with(['order', 'payment'])->latest()->paginate(20);

       

        return view('orderItems.index', compact('orders'));
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
        $cuotas = $request->payment_number;
        $fecha = $request->fecha;
        $periodo = $request->periodo;
        $prestamos = OrderItem::where('customer_id', $request->customer_id)->get();
        //   dd($prestamos->count());
        $cantidad = 1;
        if ($prestamos->count() > 0) {
            $cantidad = $prestamos->count();
            // dd($cantidad);
            ++$cantidad;
        }

        $cantidad = $request->customer_id.'/'.$cantidad;
        //  dd($cantidad);
        if ($periodo == 'Mensual') {
            //  echo 'Mensual';
            $vencimiento = date('Y-m-d', strtotime('+'.$cuotas.'week', strtotime($fecha)));
        }

        if ($periodo == 'Semanal') {
            // echo 'Semanal';
            $vencimiento = date('Y-m-d', strtotime('+'.$cuotas.'week', strtotime($fecha)));
        }

        $order = OrderItem::create([
            'customer_id' => $request->customer_id,
            'vencimiento' => $vencimiento,
            'cheque' => $request->cheque,
            'fecha' => $request->fecha,
            'descripcion' => $request->monto,
            'user_id' => $request->user()->id,
            'cuenta_id' => 1,
            'avatar' => $avatar_path,
            'periodo' => $request->periodo, // dia de pago lunes

            'monto' => $request->credito,
            'cuotas' => $request->payment_number,
            'tasa' => $request->utility,

            'estado' => $request->estado,
            'codigo' => $cantidad,
        ]);

        // $order->save();

        $i = 1;
        for ($i; $i <= $cuotas; ++$i) {
            $vencimiento = date('Y-m-d', strtotime('+'.$i.'month', strtotime($fecha)));
            if ($periodo == 'Semanal') {
                // echo 'Semanal';
                $vencimiento = date('Y-m-d', strtotime('+'.$i.'week', strtotime($fecha)));
            }

            $order->items()->create([
                'price' => $request->monto_cuota,
                'quantity' => $i,
                'product_id' => 1,
                'fecha_pago' => $vencimiento,
            ]);
        }
        $request->user()->cart()->detach();

        return redirect()->route('orders.index')->with('success', 'Credito aprobado con exito!');

        // return view('users.show')->with('order', $order)->with('success', 'Ingreso creado con exito!');

        // return 'success';
    }

    public function edit(Request $request, OrderItem $order)
    {
        $products = Product::all();
        $customers = Customer::all();
        $items = $order->items;

        $user = $request->user();
        $cuentas = $user->cuentas;
        // print_r($cuentas);

        //   foreach ($cuentas as $item) {
        //    echo $user->id.'- IDD:'.$item->cuenta->id.'- precio:'.$item->cuenta->cbu.' - quantity:'.$item->cuenta->alias;
        // }

        return view('orders.edit')->with('cuentas', $cuentas)->with('items', $items)->with('order', $order)->with('products', $products)->with('customers', $customers);
    }

    public function update(OrderStoreRequest $request, OrderItem $order)
    {
        $cuotas = $request->payment_number;
        $fecha = $request->fecha;
        $periodo = $request->periodo;
        if ($periodo == 'Mensual') {
            //  echo 'Mensual';
            $vencimiento = date('Y-m-d', strtotime('+'.$cuotas.'week', strtotime($fecha)));
        }

        if ($periodo == 'Semanal') {
            // echo 'Semanal';
            $vencimiento = date('Y-m-d', strtotime('+'.$cuotas.'week', strtotime($fecha)));
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
        $order->descripcion = $request->monto;

        $order->estado = $request->estado;
        $order->codigo = $request->codigo;

        //  dd($request->all());
        $order->items()->delete();

        $i = 1;
        for ($i; $i <= $cuotas; ++$i) {
            $vencimiento = date('Y-m-d', strtotime('+'.$i.'month', strtotime($fecha)));
            if ($periodo == 'Semanal') {
                // echo 'Semanal';
                $vencimiento = date('Y-m-d', strtotime('+'.$i.'week', strtotime($fecha)));
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

    public function show(OrderItem $order)
    {
        // echo $order->getCustomerName();
        $items = $order->items;
        $secciones = $order->secciones;
        $cuentas = $order->cuentas;

        return view('orders.show', compact('order', 'items', 'secciones', 'cuentas'));
    }

}
