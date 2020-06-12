<div id="id_{{$row->field}}"></div>
<input 
       type="hidden"
       class="form-control"
       name="{{ $row->field }}"
       id="field_{{$row->field}}"
       data-name="{{ $row->display_name }}"
       
       @if($row->required == 1) required @endif
            step="any"
            placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}"
            value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif">
@push('javascript')
       <script>
        options = {
           success: function(files) {
               console.log(files)
             $("#field_{{$row->field}}").val(files[0].link)
           },
           cancel: function() {
             //optional
           },
           linkType: "preview", // "preview" or "direct"
           multiselect: false, // true or false
        };
        var buttonDropbox = Dropbox.createChooseButton(options);
        document.getElementById("id_{{ $row->field }}").appendChild(buttonDropbox);
       </script>
@endpush