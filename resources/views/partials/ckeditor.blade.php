@push('after-style')
    <style>
        .ck-editor__editable {min-height: 200px;}
    </style>
@endpush


<script src="{{ asset('plugins/ckeditor5/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/ckfinder/ckfinder.js') }}"></script>
<script>
    let url = "{{ asset('plugins/ckfinder/core/connector/php/connector.php') }}";
    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        ckfinder: {
			uploadUrl: url + '?command=QuickUpload&type=Files&responseType=json',
		},
        toolbar: [ 'heading', '|', 'bold', 'italic', '|', 
                    'undo', 'redo', '|', 'link', 'bulletedList', 'numberedList', 'blockQuote' ,
                    'imageStyle:full', 'imageStyle:side', '|', 'imageTextAlternative', '|', 
                    'alignment:left', 'alignment:right', 'alignment:center', 'alignment:justify'
                ]
    })
    .catch( error => {
        console.log( error );
    } );
</script>