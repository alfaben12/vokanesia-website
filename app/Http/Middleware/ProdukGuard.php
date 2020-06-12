<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\CustomerLibrary;
use App\Models\VideoProduk;
class ProdukGuard
{
  /**
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \Closure  $next
  * @return mixed
  */
  public function handle($request, Closure $next)
  {
    $user = Auth::user();

    if($request->route()->getName() == 'customers.video.kelas' || $request->route()->getName() == 'customers.video.show')
    {
      $prodId = $request->video;
      $find = CustomerLibrary::where(['customer_id' => $user->id, 'produk_id' => $prodId, 'type' => 'video'])->first();
      if($find)
      {
        return $next($request);
      }

      if($request->route()->getName() == 'customers.video.show')
      {
        $prod_id= $request->prod_id;
        $find = VideoProduk::find($prod_id);
        if(isset($find->youtube_url))
        {
          return $next($request);
        }
      }
    }else{
      $prodId = $request->pdf;

      $find = CustomerLibrary::where(['customer_id' => $user->id, 'produk_id' => $prodId, 'type' => 'pdf'])->first();

      if($find)
      {
        return $next($request);
      }
    }

    return redirect('customers.c.dashboard');
  }
}
