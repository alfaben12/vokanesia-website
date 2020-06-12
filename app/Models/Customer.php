<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Cart;
use App\Models\CustomerLibrary;
class Customer extends Authenticatable
{

    use Notifiable;

    protected $table = 'customers';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'profile',
        'verivied',
        'otp'
    ];

    public function totalVideo()
    {
        $data = CustomerLibrary::where(['customer_id' => $this->id, 'type' => 'video'])->count();

        return $data;
    }

    public function totalEbook()
    {
        $data = CustomerLibrary::where(['customer_id' => $this->id, 'type' => 'pdf'])->count();

        return $data;
    }

    public function totalCart()
    {
        $cart = Cart::where(['customer_id' => $this->id])->count();

        return $cart;
    }

    public function libraryVideo()
    {
        return $this->hasMany('App\Models\CustomerLibrary', 'customer_id')->where('type', 'video');
    }

    public function libraryPdf()
    {
        return $this->hasMany('App\Models\CustomerLibrary', 'customer_id')->where('type', 'pdf');
    }

    public function cart()
    {
      return $this->hasMany("App\Models\Cart", "customer_id", "id");
    }

    protected $hidden = [
        'password', 'remember_token', 'otp'
    ];

    public function personalDetails()
    {
        return $this->nama;
    }
}
