<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'vencimiento',
        'cheque',
        'fecha',
        'descripcion',
        'detalle',
        'descripcionOdontograma1',
        'descripcionOdontograma2',
        'cuenta_id',
        'periodo',
        'avatar',
        'monto',
        'pagado',
        'cuotas',
        'alineadores_impresos_sup',
        'alineadores_impresos_inf',
        'alineadores_estampados_sup',
        'alineadores_estampados_inf',
        'alineadores_entregados',
        'tasa',
        'estado',
        'codigo',
        'user_id',
        'imagen2',
        'imagen3',
        'imagen4',
        'imagen5',
        'imagen6',
        'imagen7',
        'imagen8',
        'imagen9',
        'documento',
        'documento2',
        'documento3',
        'documento4',
        'documento_Fase',
        'archivo_STL',
        'archivo_STL_inferior',
        'archivo_STL_mordida',
        'b_jarabak',
        'mc_namara',
        'enlace'
    ];

    public function cuentas()
    {
        return $this->hasMany(CuentaOrder::class);
    }

    public function secciones()
    {
        return $this->hasMany(OrderSeccion::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // /cuantas
    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class);
    }

    // /clientes
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    // /usuario en este caso los odontologos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserName()
    {
        if ($this->user) {
            return $this->user->first_name.' '.$this->user->last_name;
        }

        return 'Odontologo';
    }

    public function getCustomerName()
    {
        if ($this->customer) {
            return $this->customer->first_name.' '.$this->customer->last_name;
        }

        return 'Clientes';
    }

    public function total()
    {
        return $this->items->map(function ($i) {
            return $i->price;
        })->sum();
    }

    public function formattedTotal()
    {
        return number_format($this->total(), 2);
    }

    public function receivedAmount()
    {
        return $this->payments->map(function ($i) {
            return $i->amount;
        })->sum();
    }

    public function formattedReceivedAmount()
    {
        return number_format($this->receivedAmount(), 2);
    }

    public function getAvatarUrl()
    {
        return Storage::url($this->avatar);
    }

    public function getImagen2Url()
    {
        return Storage::url($this->imagen2);
    }

    public function getImagen3Url()
    {
        return Storage::url($this->imagen3);
    }

    public function getImagen4Url()
    {
        return Storage::url($this->imagen4);
    }

    public function getImagen5Url()
    {
        return Storage::url($this->imagen5);
    }

    public function getImagen6Url()
    {
        return Storage::url($this->imagen6);
    }

    public function getImagen7Url()
    {
        return Storage::url($this->imagen7);
    }

    public function getImagen8Url()
    {
        return Storage::url($this->imagen8);
    }

    public function getImagen9Url()
    {
        return Storage::url($this->imagen9);
    }

    public function getDocumentoUrl()
    {
        return Storage::url($this->documento);
    }

    public function getDocumento1Url()
    {
        return Storage::url($this->documento1);
    }

    public function getDocumento2Url()
    {
        return Storage::url($this->documento2);
    }

    public function getDocumento3Url()
    {
        return Storage::url($this->documento3);
    }

    public function getDocumento4Url()
    {
        return Storage::url($this->documento4);
    }
    public function getDocumentoFaseUrl()
    {
        return Storage::url($this->documento_Fase);
    }
    public function getArchivoSTLUrl()
    {
        return Storage::url($this->archivo_STL);
    }
    public function getArchivoSTLinferiorUrl()
    {
        return Storage::url($this->archivo_STL_inferior);
    }
    public function getArchivoSTLmordidaUrl()
    {
        return Storage::url($this->archivo_STL_mordida);
    }
    public function getBJarabakUrl()
    {
        return Storage::url($this->b_jarabak);
    }
    public function getMcNamaraUrl()
    {
        return Storage::url($this->mc_namara);
    }
}
