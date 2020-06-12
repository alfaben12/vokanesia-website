@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
              action="@if(!is_null($dataTypeContent->getKey())){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
              method="POST" enctype="multipart/form-data" autocomplete="off">
                <!-- PUT Method if we are editing -->
                @if(isset($dataTypeContent->id))
                    {{ method_field("PUT") }}
                @endif
                {{ csrf_field() }}

                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="panel panel-bordered">
                        {{-- <div class="panel"> --}}
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="name">User</label>
                                    @php
                                        $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                        $row     = $dataTypeRows->where('field', 'withdrawal_belongsto_user_relationship')->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                                <div class="form-group">
                                    <label for="bank">Bank</label>
                                    <input required type="select" class="form-control" id="bank" name="bank" placeholder="bank"
                                           value="{{ old('bank', $dataTypeContent->bank ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="nama_rekening">Nama Bank</label>
                                    <input required type="text" class="form-control" id="nama_rekening" name="nama_rekening" placeholder="Nama Rekening"
                                           value="{{ old('nama_rekening', $dataTypeContent->nama_rekening ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label  for="nomor_rekening">Nomor Rekening</label>
                                    <input required type="text" class="form-control" id="nomor_rekening" name="nomor_rekening" placeholder="Nomor Rekening"
                                           value="{{ old('nomor_rekening', $dataTypeContent->nomor_rekening ?? '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="nominal">Nominal</label>
                                    <input required type="number" class="form-control" id="nominal" name="nominal" placeholder="nominal"
                                           value="{{ old('nominal', $dataTypeContent->nominal ?? 0) }}">
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>

                <button type="submit" class="btn btn-primary pull-right save">
                    {{ __('voyager::generic.save') }}
                </button>
        </form>
    </div>
@stop

@section('javascript')
    <script>
        $('select[name="user_id"]').on('change', function(){
            var selectedUser = $(this).children("option:selected").val();
            $.ajax({
                url : '/admin/check-user-income',
                type : 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    'user_id' : selectedUser,
                },
                success : function success(result){
                    $('#nama_rekening').val(result.data.nama_rekening)
                    $('#nomor_rekening').val(result.data.nomor_rekening)
                    $('#bank').val(result.data.bank)
                    $('#nominal').val(result.data.nominal)
                }
            });
        });
    </script>
@stop