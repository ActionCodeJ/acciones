<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
use App\Http\Resources\PaymentResource;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Payments = new Payment();
        if ($request->search) {
            $Payments = $Payments->where('name', 'LIKE', "%{$request->search}%");
        }
        $Payments = $Payments->latest()->paginate(10);
        if (request()->wantsJson()) {
            return PaymentResource::collection($Payments);
        }

        return view('payments.index')->with('Payments', $Payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = 0;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //  echo 'ordereid'.$id;

            $item = OrderItem::find($id);

            $order = $item->order;
            // echo $order->getCustomerName();

            return view('payments.create')->with('item', $item)->with('order', $order);
        }

        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentStoreRequest $request)
    {
        $Payment = Payment::create([
            'amount' => $request->amount,
            'order_id' => $request->order_id,
            'user_id' =>  $request->user()->id,
          
            'status' => $request->status,
            'date' => $request->date,
        ]);

        if (!$Payment) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while creating Payment.');
        }
        $item = OrderItem::find($request->item_id);
        if (!$item) {
            $item->payment_id = $Payment->id;
            $item->pagado = $request->amount;
            $item->estado = 'PAGO PARCIAL';
            if ($request->amount >= $item->price) {
                $item->estado = 'PAGADO';
            }

            $item->save();
        }

        return redirect()->route('payments.index')->with('success', 'El pago se ha realizado con Exito!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $Payment)
    {
        return view('payments.show')->with('Payment', $Payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $Payment)
    {
        return view('payments.edit')->with('Payment', $Payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentStoreRequest $request, Payment $Payment)
    {
        $Payment->amount = $request->amount;
        $Payment->order_id = $request->order_id;

        $Payment->date = $request->date;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($Payment->image) {
                Storage::delete($Payment->image);
            }
            // Store image
            $image_path = $request->file('image')->store('Payments', 'public');
            // Save to Database
            $Payment->image = $image_path;
        }

        if (!$Payment->save()) {
            return redirect()->back()->with('error', 'Sorry, Something went wrong while updating Payment.');
        }

        $item = OrderItem::where('payment_id', $Payment->id);
        if (!$item) {
            // $item->payment_id = $Payment->id;
            $item->pagado = $request->amount;
            $item->estado = 'PAGO PARCIAL';
            if ($request->amount >= $item->price) {
                $item->estado = 'PAGADO';
            }

            $item->save();
        }

        return redirect()->route('payments.index')->with('success', 'Pago modificado con exito!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $Payment)
    {
        if ($Payment->image) {
            Storage::delete($Payment->image);
        }
        $Payment->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
