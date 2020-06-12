
@extends('voyager::master')

@section('css')
    <style>
        .card-counter{
          box-shadow: 2px 2px 10px #DADADA;
          margin: 5px;
          padding: 20px 10px;
          background-color: #fff;
          height: 100px;
          border-radius: 5px;
          transition: .3s linear all;
        }
    
        .card-counter:hover{
          box-shadow: 4px 4px 20px #DADADA;
          transition: .3s linear all;
        }
    
        .card-counter.primary{
          background-color: #007bff;
          color: #FFF;
        }
    
        .card-counter.danger{
          background-color: #ef5350;
          color: #FFF;
        }  
    
        .card-counter.success{
          background-color: #66bb6a;
          color: #FFF;
        }  
    
        .card-counter.info{
          background-color: #26c6da;
          color: #FFF;
        }  
    
        .card-counter i{
          font-size: 5em;
          opacity: 0.2;
        }
    
        .card-counter .count-numbers{
          position: absolute;
          right: 35px;
          top: 20px;
          font-size: 32px;
          display: block;
        }
    
        .card-counter .count-name{
          position: absolute;
          right: 35px;
          top: 65px;
          font-style: italic;
          text-transform: capitalize;
          opacity: 0.5;
          display: block;
          font-size: 18px;
        }
    </style>
@endsection
@section('content')
    <div class="page-content edit-add container-fluid">
        @if($dashboard == 'admin')
        <div class="row">
            <div class="col-md-4">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">{{$card_data['customers']}}</span>
                    <span class="count-name">Customers</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">{{$card_data['book_store']}}</span>
                    <span class="count-name">Book Store</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">{{$card_data['mentor']}}</span>
                    <span class="count-name">Mentor</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">{{$card_data['penjualan_course']}}</span>
                    <span class="count-name">Penjualan Course</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">Rp {{number_format($card_data['keuntungan_course'])}}</span>
                    <span class="count-name">Keuntungan Penjualan Course</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">{{$card_data['penjualan_ebook']}}</span>
                    <span class="count-name">Penjualan Ebook</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">Rp {{number_format($card_data['keuntungan_ebook'])}}</span>
                    <span class="count-name">Keuntungan Penjualan Ebook</span>
                </div>
            </div>
        </div>
        @elseif($dashboard == 'mentor')
        <div class="row">
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">{{$card_data['total_penjualan']}}</span>
                    <span class="count-name">Total Penjualan Course</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">Rp {{number_format($card_data['total_keuntungan'])}}</span>
                    <span class="count-name">Total Keuntungan Penjualan Course</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">{{$card_data['penjualan']}}</span>
                    <span class="count-name">Penjualan Course Bulan Ini</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">Rp {{number_format($card_data['keuntungan'])}}</span>
                    <span class="count-name">Keuntungan Penjualan Course Bulan Ini</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Total Penjualan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($card_data['data_table'] as $row)
                                    <tr>
                                        
                                        <td>
                                            {{$row->name}}
                                        </td>
                                        <td>
                                            {{$row->jumlahOrderan()}}
                                        </td>
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($dashboard == 'book_store')
        <div class="row">
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">{{$card_data['total_penjualan']}}</span>
                    <span class="count-name">Total Penjualan Buku</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">Rp {{number_format($card_data['total_keuntungan'])}}</span>
                    <span class="count-name">Total Keuntungan Penjualan Buku</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">{{$card_data['penjualan']}}</span>
                    <span class="count-name">Penjualan Buku Bulan Ini</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="icon voyager-bread"></i>
                    <span class="count-numbers">Rp {{number_format($card_data['keuntungan'])}}</span>
                    <span class="count-name">Keuntungan Penjualan Buku Bulan Ini</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Total Penjualan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($card_data['data_table'] as $row)
                                    <tr>
                                        
                                        <td>
                                            {{$row->name}}
                                        </td>
                                        <td>
                                            {{$row->jumlahOrderan()}}
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('javascript')
<script>
$(document).ready( function () {
    $('#dataTable').DataTable();
} );
</script>
@endsection