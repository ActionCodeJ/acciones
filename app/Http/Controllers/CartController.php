<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // crear order o carrito
    public function index(Request $request)
    {
       

        $user = $request->user();
        $cuentas = $user->cuentas;
//dd($cuentas);
        $products = Product::all();
        $customers = Customer::all();
        if (Auth::user()->rol =="ADMINISTRADOR") {
            // echo (Auth::user()->rol);
            $customers = Customer::all();
         }else
         $customers = Customer::where('user_id',Auth::user()->id)->get();
 
        return view('cart.create')->with('cuentas', $cuentas)->with('products', $products)->with('customers', $customers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required|exists:products,barcode',
        ]);
        $barcode = $request->barcode;

        $product = Product::where('barcode', $barcode)->first();
        $cart = $request->user()->cart()->where('barcode', $barcode)->first();
        if ($cart) {
            // check product quantity
            if ($product->quantity <= $cart->pivot->quantity) {
                return response([
                    'message' => 'Product available only: '.$product->quantity,
                ], 400);
            }
            // update only quantity
            ++$cart->pivot->quantity;
            $cart->pivot->save();
        } else {
            if ($product->quantity < 1) {
                return response([
                    'message' => 'Producto fuera de stock',
                ], 400);
            }
            $request->user()->cart()->attach($product->id, ['quantity' => 1]);
        }

        return response('', 204);
    }

    public function changeQty(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $request->user()->cart()->where('id', $request->product_id)->first();

        if ($cart) {
            $cart->pivot->quantity = $request->quantity;
            $cart->pivot->save();
        }

        return response([
            'success' => true,
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);
        $request->user()->cart()->detach($request->product_id);

        return response('', 204);
    }

    public function empty(Request $request)
    {
        $request->user()->cart()->detach();

        return response('', 204);
    }
}
