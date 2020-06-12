<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Invoice</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
  <div class="card">
<div class="card-header">
Nomor Invoice:
<strong style="text-transform:uppercase">{{$data->invoice}}</strong> 
  <span class="float-right"> Status: <strong style="text-transform:uppercase">{{$data->status}}</strong></span>

</div>
<div class="card-body">
<img src="{{asset('assets/images/logo.png')}}" style="width:300px" alt="vocanesia">
<div class="row mb-4">
<div class="col-sm-6">

<!--div>Nomor Invoice: {{$data->invoice}}</div>
<div class="col-lg-4 col-sm-4 ml-auto">Status: {{$data->status}}</div-->
<div>
<!--h6 class="mb-3">Atas nama:</h6-->
<br>
<h6>Atas nama :</h6>
<strong>{{$data->getCustomerDetails()->nama}}</strong>
</div>
<div>Email : {{$data->getCustomerDetails()->email}}</div>
<div>Nomor Telepon : +62{{$data->getCustomerDetails()->no_hp}}</div>
<div>Tanggal : {{ Carbon\Carbon::parse($data->created_at)->format("d F Y h:i:s") }}</div>
</div>

<!--div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>
<strong>Bob Mart</strong>
</div>
<div>Attn: Daniel Marek</div>
<div>43-190 Mikolow, Poland</div>
<div>Email: marek@daniel.com</div>
<div>Phone: +48 123 456 789</div>
</div-->



</div>

<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<!--th class="center">#</th-->
<th>Item</th>
<!--th>Description</th-->

<!--th class="right">Unit Cost</th-->

<th class="right">Harga</th>
</tr>
</thead>
<tbody>
@php
    $grandTotal = 0;
@endphp
@foreach($data->getOrderDetails() as $row)
<tr>
<!--td class="center">1</td-->
<td class="left strong">{{$row->getProdukDetails()->name}}</td>
<!--td class="left">Extended License</td-->
<td class="right">Rp. {{ number_format($row->harga,2,",",".")}}</td>
</tr>
@php
    $grandTotal += $row->harga;
@endphp
@endforeach
<!--tr>
<td class="center">2</td>
<td class="left">mentor - orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt</td>
<td class="left">Instalation and Customization (cost per hour)</td-->

<!--td class="right">Rp. 100,000</td>
  <td class="center">1</td>
<td class="right">Rp. 100,000</td>
</tr-->
<!--tr>
<td class="center">3</td>
<td class="left">Hosting</td>
<td class="left">1 year subcription</td>

<td class="right">$499,00</td>
  <td class="center">1</td>
<td class="right">$499,00</td>
</tr>
<tr>
<td class="center">4</td>
<td class="left">Platinum Support</td>
<td class="left">1 year subcription 24/7</td>

<td class="right">$3.999,00</td>
  <td class="center">1</td>
<td class="right">$3.999,00</td>
</tr-->
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-3 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong>Rp. {{number_format($grandTotal,2,",",".")}}</strong>
</td>
</tr>
</tbody>
</table>

</div>

</div>

</div>
</div>
</div>
<!-- partial -->
  <script>
      "use strict";
  </script>

</body>
</html>
