@extends('voyager::master')

@section('page_header')
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered" style="padding-bottom:5px">
                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">Ticket Number : #{{$data->ticket_no}}</h3>
                    </div>
                    <div class="panel-body" style="padding-top:0">
                    <h4 class="panel-title">Nama Customer : <span>{{$data->customerDetails()->nama}}</span></h4>
                    <h4 class="panel-title">Status : <span>{{$data->status}}</span></h4>
                    <h4 class="panel-title">Message</h4>
                        {!! $data->message !!}
                    </div>
                </div>
            </div>
            @foreach($data->ticketMessages() as $row)
            <div class="col-md-10 {{$row->user_id ? 'pull-right' : ''}}">
                <div class="panel panel-bordered" style="padding:30px">
                    {!! $row->reply !!}
                </div>
            </div>
            @endforeach
            <div class="col-md-10 pull-right"  {{$data->status == 'closed' ? 'hidden' : ''}}>
                <div class="panel panel-bordered" style="padding-bottom:5px">
                    <textarea class="form-control richTextBox" name="reply" id="richtext_reply">
                    </textarea>
                </div>
                <a href="{{url('admin/resolve-case/'.$data->id)}}" class="btn btn-success save">
                    Resolve Issue
                </a>
                <button type="submit" id="balas_button" class="btn btn-primary pull-right save">
                    Balas
                </button>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        $(document).ready(function() {
            var additionalConfig = {
                selector: 'textarea.richTextBox[name="reply"]',
            }

            $.extend(additionalConfig, {!! json_encode($options->tinymceOptions ?? '{}') !!})

            tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
        });

        $("#balas_button").on('click', function(){
            var replyForm = tinymce.get("richtext_reply").getContent();
            $.ajax({
                url : '/admin/reply-ticket/{{$data->id}}',
                type : 'POST',
                data : {
                    reply : replyForm
                },
                success : function success(res){
                    location.reload()
                }
            })
        })
    </script>
@endpush

