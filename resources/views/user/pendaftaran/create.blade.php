@extends('layout.app')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <style>
        .count-box{
            border-radius: 10px;
        }

        /* nav pills */
        .nav-link.disabled{
            color: #6c757d !important;
        }

        .nav-pills .nav-link {
            color: #385d8b;
            /* font-family: "Poppins", sans-serif; */
            border-radius: 0;
        }

        .nav-pills .nav-link.active {
            background-color: #ffffff;
            color: #0F2F57;
            border-bottom: 2px solid #0F2F57;
            font-weight: 600;
        }

        .img-thumbnail{
            height: 300px;
        }
    </style>
@endpush

@push('after-script')
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            @if (Session::has('success'))
                Swal.fire(
                    'Terkirim',
                    'Data pendaftaran berhasil terkirim',
                    'success'
                ).then(function(){
                    const email = JSON.parse(localStorage.getItem('email'));
                    location.replace('/registration-success/'+ email[0].value);
                });
            @endif

            checkTabDiri();
            checkTabPendidikan();
            checkTabKeluarga();
            checkTabProdi();
            checkTabInfo();

            // disable select pilihan prodi2
            disablePilProdi($('#kelas1_id').val());
        });

        function checkTabDiri(){
            $input_value = [];
            $('.input-tabdiri').each(function(index){
                $input_value[index] = $(this).val();
            });

            if(!($input_value.includes(''))){
                $('#btn-next-diri').attr('disabled', false);
                $('#pills-pendidikan-tab').removeClass('disabled');
            }else{
                $('#btn-next-diri').attr('disabled', true);
                $('#pills-pendidikan-tab').addClass('disabled');
            };
        }

        function checkTabPendidikan(){
            $input_value = [];
            $('.input-tabpendidikan').each(function(index){
                $input_value[index] = $(this).val();
            });

            if(!($input_value.includes('')) && ($('#foto').val() != '')){
                $('#btn-next-pendidikan').attr('disabled', false);
                $('#pills-keluarga-tab').removeClass('disabled');
            }else{
                $('#btn-next-pendidikan').attr('disabled', true);
                $('#pills-keluarga-tab').addClass('disabled');
            };
        }

        function checkTabKeluarga(){
            $input_value = [];
            $('.input-tabkeluarga').each(function(index){
                $input_value[index] = $(this).val();
            });

            if(!($input_value.includes('')) && ($('#foto').val() != '')){
                $('#btn-next-keluarga').attr('disabled', false);
                $('#pills-prodi-tab').removeClass('disabled');
            }else{
                $('#btn-next-keluarga').attr('disabled', true);
                $('#pills-prodi-tab').addClass('disabled');
            };
        }

        function checkTabProdi(){
            $input_value = [];
            $('.input-tabprodi').each(function(index){
                $input_value[index] = $(this).val();
            });

            if(!($input_value.includes('')) && ($('#foto').val() != '')){
                $('#btn-next-prodi').attr('disabled', false);
                $('#pills-tambahan-tab').removeClass('disabled');
            }else{
                $('#btn-next-prodi').attr('disabled', true);
                $('#pills-tambahan-tab').addClass('disabled');
            };
        }

        function checkTabInfo(){
            let checked_group = $('div.checkbox-group.required :checkbox:checked').length;

            if(checked_group > 0){
                $('#btn-save-info').attr('disabled', false);
            }else{
                $('#btn-save-info').attr('disabled', true);
            };
        }
    </script>

    <script>
        function btnTab(idTab, judulTab){
            $(idTab).trigger('click');
            editTitleTab(judulTab);
        }

        function editTitleTab(judulTab){
            $('#titleTab').html(judulTab);
        }
        
        // input type text
        let id_input = [];
        $('.input-daftar').each(function(index){
            id_input[index] = $(this).attr('id');
        });

        // input type radio
        let name_input_radio = [];
        $('.input-radio-daftar').each(function(index){
            name_input_radio[index] = $(this).attr('name');
        });

        // storage input text
        element_input = [];
        id_input.forEach(function(data, index){
            element_input[index] = JSON.parse(localStorage.getItem(data)) ?? [];
        });

        // storage input radio
        element_radio = [];
        name_input_radio.forEach(function(data, index){
            element_radio[index] = JSON.parse(localStorage.getItem(data)) ?? [];
        });

        for (let i = 0; i < element_input.length; i++) {
            element_input[i].forEach(function(data, index){
                if(data.type == 'checkbox' && data.value != null){
                    $(`#${data.id}`).attr('checked', true);
                }else{
                    $(`#${data.id}`).val(data.value); 
                }
            });
        }

        for (let j = 0; j < element_radio.length; j++) {
            element_radio[j].forEach(function(data, index){
                $(`input[name='${data.id}'][value='${data.value}']`).attr('checked', true);
            });
        }

        // event on combo box
        function eventComboBox(element, tab){
            if(tab == 'diri'){
                checkTabDiri();
            }else{
                checkTabProdi();
            }

            if(element.id == 'kelas1_id'){
                checkPilProdi(element.value);
            }

            saveStorage(element.id, $(`#${element.id}`).val(), 'combobox')
        }

        function saveStorage(id_element, val_element, type_element){
            let obj = {id: id_element, value: val_element, type: type_element};
            let storage = JSON.parse(localStorage.getItem(id_element)) ?? [obj];

            let check = storage.find(x => x.id == id_element);

            if(!check){
                if(type_element == 'checkbox'){
                    localStorage.removeItem(id_element);
                }else{
                    storage.push(obj);
                }
            }

            storage.forEach(function(item, i){
                if(id_element == item.id){
                    item.value = val_element;
                }
            });

            localStorage.setItem(id_element, JSON.stringify(storage));
        }

        // check pilihan prodi
        function checkPilProdi(valProdi){
            if(valProdi != ''){
                $('#kelas2_id option').show();
                $(`#kelas2_id option[value='${valProdi}']`).hide();
                $('#kelas2_id').val('');
                $('#kelas2_id').attr('disabled', false);
            }else{
                disablePilProdi(valProdi);
            }
        }

        function disablePilProdi(valProdi){
            if(valProdi == ''){
                $(`#kelas2_id option[value='${valProdi}']`).hide();
                $('#kelas2_id').val('');
                $('#kelas2_id').attr('disabled', true);
            }
        }

        // event change foto
        function eventChangeImg(input){
            checkTabDiri();
            checkTabPendidikan();
            checkTabKeluarga();
            checkTabProdi();
            checkTabInfo();

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-img').html('<img class="img-thumbnail mt-3" src="'+ e.target.result +'" />');
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    {{-- <script>
        // event on input image
        function eventImage(evt){
            checkTabDiri();

            let files = evt.target.files;
            for (let i = 0, f; f = files[i]; i++) {
                let reader = new FileReader();

                reader.onload = function(e){                    
                    addImage(e.target.result);
                }

                reader.readAsDataURL(f);
            }
        }

        let imagesObject = [];

        function mouseOverImg(){
            console.log($('#foto').val());
            document.getElementById('foto').addEventListener('change', eventImage, false); 
        }

        loadImage();

        function loadImage(){
            let images = JSON.parse(localStorage.getItem('foto'));
            let name_image = JSON.parse(localStorage.getItem('nama_foto'));            

            if(images && images.length > 0){
                $('#div-foto').html('');
                $('#storage_foto').attr('value', images);
                $('#storage_nama_foto').val(name_image);
                $('#preview-img').html('<img class="text-center img-thumbnail" src="'+ images +'" />');
                $('#delete-preview-img').html('<button class="btn btn-sm btn-danger mt-2" onclick="removeLocalImg()">Ganti Gambar</button>')
            }
        }

        function addImage(imgData){
            imagesObject.push(imgData);
            let storage = JSON.parse(localStorage.getItem('foto'));
            let nama_foto = JSON.parse(localStorage.getItem('nama-foto'));
            
            let foto = document.getElementById('foto');

            if(storage){
                storage.push(imagesObject);
            }else{
                localStorage.setItem('foto', JSON.stringify(imagesObject))
            }

            if(nama_foto){
                nama_foto.push(imagesObject);
            }else{
                localStorage.setItem('nama_foto', JSON.stringify(foto.files.item(0).name))
            }

            $('#preview-img').html('<img class="img-thumbnail mt-3" src="'+ imgData +'" />');
        }

        function removeLocalImg(){
            imagesObject = [];
            localStorage.removeItem('foto');
            localStorage.removeItem('nama_foto');
            $('#preview-img').html('');
            $('#delete-preview-img').html('');
            $('#storage-foto').val('');
            $('#div-foto').html(`<input type="file" name="foto" id="foto" class="form-control input-daftar input-tabdiri @error('foto') is-invalid @enderror" onmouseover="mouseOverImg()" data-height="300" required />`);
        }
    </script> --}}
@endpush

@section('main')
    <!-- ======= About Section ======= -->
    <section id="alur" class="about pb-0 pt-110">
        <div class="container" data-aos="fade-up">
            <div class="section-title pb-3">
                <h2>Pendaftaran</h2>
                <p id="titleTab">Data Diri</p>
            </div>
        </div>
    </section><!-- End About Section -->

    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">
            <div class="row no-gutters">
                <div class="count-box">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-diri-tab" data-bs-toggle="pill" data-bs-target="#pills-diri" type="button" role="tab" aria-controls="pills-diri" aria-selected="true" onclick="editTitleTab('Data Diri')">Data Diri</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-pendidikan-tab" data-bs-toggle="pill" data-bs-target="#pills-pendidikan" type="button" role="tab" aria-controls="pills-pendidikan" aria-selected="false" onclick="editTitleTab('Data Pendidikan')">Data Pendidikan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-keluarga-tab" data-bs-toggle="pill" data-bs-target="#pills-keluarga" type="button" role="tab" aria-controls="pills-keluarga" aria-selected="false" onclick="editTitleTab('Data Keluarga')">Data Keluarga</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-prodi-tab" data-bs-toggle="pill" data-bs-target="#pills-prodi" type="button" role="tab" aria-controls="pills-prodi" aria-selected="false" onclick="editTitleTab('Data Program Studi')">Data Program Studi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-tambahan-tab" data-bs-toggle="pill" data-bs-target="#pills-tambahan" type="button" role="tab" aria-controls="pills-tambahan" aria-selected="false" onclick="editTitleTab('Informasi Tambahan')">Informasi Tambahan</button>
                        </li>
                    </ul>

                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="pills-tabContent">
                            <div class="px-4 pt-4 tab-pane fade show active" id="pills-diri" role="tabpanel" aria-labelledby="pills-diri-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabdiri @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}" onkeyup="checkTabDiri()" onblur="saveStorage('nama', this.value, 'text')" required>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kelamin <b class="text-dark">*</b></label>
                                            <div class="d-flex">
                                                <div class="bd-highlight me-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input input-radio-daftar input-tabdiri input-tabdiri @error('kelamin') is-invalid @enderror" type="radio" name="kelamin" value="Pria" id="kelamin1" onclick="checkTabDiri()" onchange="saveStorage('kelamin', this.value, 'radio')" required>
                                                        <label class="form-check-label" for="kelamin1">
                                                            Pria
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="bd-highlight">
                                                    <div class="form-check">
                                                        <input class="form-check-input input-radio-daftar input-tabdiri @error('kelamin') is-invalid @enderror" type="radio" name="kelamin" value="Wanita" onclick="checkTabDiri()" onchange="saveStorage('kelamin', this.value, 'radio')" id="kelamin2">
                                                        <label class="form-check-label" for="kelamin2">
                                                            Wanita
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Agama <b class="text-dark">*</b></label>
                                            <select class="form-select input-daftar input-tabdiri @error('agama') is-invalid @enderror" name="agama" id="agama" onchange="eventComboBox(this, 'diri')" required>
                                                <option value="Islam">Islam</option>
                                                <option value="Protestan">Protestan</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Budha">Budha</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tempat_lahir" class="form-label">Tempat Lahir <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabdiri @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" onkeyup="checkTabDiri()" onblur="saveStorage('tempat_lahir', this.value, 'text')" required>
                                            @error('tempat_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <b class="text-dark">*</b></label>
                                            <input type="date" class="form-control input-daftar input-tabdiri @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" onchange="checkTabDiri()" onblur="saveStorage('tanggal_lahir', this.value, 'date')" required>
                                            @error('tanggal_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat <b class="text-dark">*</b></label>
                                            <textarea class="form-control input-daftar input-tabdiri @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4" onkeyup="checkTabDiri()" onblur="saveStorage('alamat', this.value, 'text-area')" required>{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar @error('nik') is-invalid @enderror" name="nik" id="nik" value="{{ old('nik') }}" onkeyup="checkTabDiri()" onblur="saveStorage('nik', this.value, 'number')" required>
                                            @error('nik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="kk" class="form-label">No. Kartu Keluarga <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar input-tabdiri @error('kk') is-invalid @enderror" name="kk" id="kk" onkeyup="checkTabDiri()" onblur="saveStorage('kk', this.value, 'text')" value="{{ old('kk') }}" required>
                                            @error('kk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="kel" class="form-label">Kelurahan <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabdiri @error('kel') is-invalid @enderror" name="kel" id="kel" value="{{ old('kel') }}" onblur="saveStorage('kel', this.value, 'text')" onkeyup="checkTabDiri()" required>
                                            @error('kel')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="kec" class="form-label">Kecamatan <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabdiri @error('kec') is-invalid @enderror" name="kec" id="kec" value="{{ old('kec') }}" onblur="saveStorage('kec', this.value, 'text')" onkeyup="checkTabDiri()" required>
                                            @error('kec')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="kp" class="form-label">Kode Pos <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar input-tabdiri @error('kp') is-invalid @enderror" name="kp" id="kp" value="{{ old('kp') }}" onblur="saveStorage('kp', this.value, 'number')" onkeyup="checkTabDiri()" required>
                                            @error('kp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="tlp" class="form-label">Telepon / HP <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar input-tabdiri @error('tlp') is-invalid @enderror" name="tlp" id="tlp" value="{{ old('tlp') }}" onblur="saveStorage('tlp', this.value, 'number')" onkeyup="checkTabDiri()" required>
                                            @error('tlp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="wa" class="form-label">No. Whatsapp <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar input-tabdiri @error('wa') is-invalid @enderror" name="wa" id="wa" value="{{ old('wa') }}" onblur="saveStorage('wa', this.value, 'number')" onkeyup="checkTabDiri()" required>
                                            @error('wa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <b class="text-dark">*</b></label>
                                            <input type="email" class="form-control input-daftar input-tabdiri @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" onblur="saveStorage('email', this.value, 'email')" onkeyup="checkTabDiri()" required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Foto Profil <b class="text-dark">*</b> <em>(Rekomendasi Dimensi Foto : 300 x 300 pixel atau Ukuran maksimal 1,5 MB)</em></label>
                                            <div id="div-foto">
                                                <input type="file" name="foto" id="foto" class="form-control input-daftar input-tabdiri @error('foto') is-invalid @enderror" onchange="eventChangeImg(this)" data-height="300" required />
                                                @error('foto')
                                                    <div class="invalid-feedback d-block">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div id="preview-img" class="text-center"></div>
                                            {{-- <input type="hidden" name="foto_storage" id="storage_foto">
                                            <input type="hidden"  name="nama_foto_storage" id="storage_nama_foto">
                                            <div id="delete-preview-img" class="text-end"></div> --}}
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-outline-app me-2" id="btn-next-diri" onclick="btnTab('#pills-pendidikan-tab', 'Data Pendidikan')">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pt-4 tab-pane fade" id="pills-pendidikan" role="tabpanel" aria-labelledby="pills-pendidikan-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="slta" class="form-label">Sekolah Asal (SLTA) <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabpendidikan @error('slta') is-invalid @enderror" name="slta" id="slta" value="{{ old('slta') }}" onkeyup="checkTabPendidikan()" onblur="saveStorage('slta', this.value, 'text')" required>
                                            @error('slta')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="thn_slta" class="form-label">Tahun Masuk <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar input-tabpendidikan @error('thn_slta') is-invalid @enderror" name="thn_slta" id="thn_slta" value="{{ old('thn_slta') }}" onkeyup="checkTabPendidikan()" onblur="saveStorage('thn_slta', this.value, 'text')" required>
                                            @error('thn_slta')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="nisn" class="form-label">Nomor Induk Siswa Nasional (NISN) <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar input-tabpendidikan @error('nisn') is-invalid @enderror" name="nisn" id="nisn" value="{{ old('nisn') }}" onkeyup="checkTabPendidikan()" onblur="saveStorage('nisn', this.value, 'text')" required>
                                            @error('nisn')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="npsn" class="form-label">Nomor Pokok Sekolah Nasional (NPSN) <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar input-tabpendidikan @error('npsn') is-invalid @enderror" name="npsn" id="npsn" value="{{ old('npsn') }}" onkeyup="checkTabPendidikan()" onblur="saveStorage('npsn', this.value, 'text')" required>
                                            @error('npsn')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="jur_slta" class="form-label">Jurusan / Program Keahlian <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabpendidikan @error('jur_slta') is-invalid @enderror" name="jur_slta" id="jur_slta" value="{{ old('jur_slta') }}" onkeyup="checkTabPendidikan()" onblur="saveStorage('jur_slta', this.value, 'text')" required>
                                            @error('jur_slta')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prestasi_akd" class="form-label">Prestasi Akademik <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabpendidikan @error('prestasi_akd') is-invalid @enderror" name="prestasi_akd" id="prestasi_akd" value="{{ old('prestasi_akd') }}" onkeyup="checkTabPendidikan()" onblur="saveStorage('prestasi_akd', this.value, 'text')" required>
                                            @error('prestasi_akd')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="prestasi_non_akd" class="form-label">Prestasi Non Akademik <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabpendidikan @error('prestasi_non_akd') is-invalid @enderror" name="prestasi_non_akd" id="prestasi_non_akd" value="{{ old('prestasi_non_akd') }}" onkeyup="checkTabPendidikan()" onblur="saveStorage('prestasi_non_akd', this.value, 'text')" required>
                                            @error('prestasi_non_akd')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-outline-app me-2" onclick="btnTab('#pills-diri-tab')">Previous</button>
                                                <button type="button" class="btn btn-outline-app me-2" id="btn-next-pendidikan" onclick="btnTab('#pills-keluarga-tab', 'Data Keluarga')">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pt-4 tab-pane fade" id="pills-keluarga" role="tabpanel" aria-labelledby="pills-keluarga-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ayah" class="form-label">Nama Ayah / Wali <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabkeluarga @error('ayah') is-invalid @enderror" name="ayah" id="ayah" value="{{ old('ayah') }}" onkeyup="checkTabKeluarga()" onblur="saveStorage('ayah', this.value, 'text')" required>
                                            @error('ayah')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="kerja_ayah" class="form-label">Pekerjaan Ayah / Wali <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabkeluarga @error('kerja_ayah') is-invalid @enderror" name="kerja_ayah" id="kerja_ayah" value="{{ old('kerja_ayah') }}" onkeyup="checkTabKeluarga()" onblur="saveStorage('kerja_ayah', this.value, 'text')" required>
                                            @error('kerja_ayah')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="ibu" class="form-label">Nama Ibu / Wali <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabkeluarga @error('ibu') is-invalid @enderror" name="ibu" id="ibu" value="{{ old('ibu') }}" onkeyup="checkTabKeluarga()" onblur="saveStorage('ibu', this.value, 'text')" required>
                                            @error('ibu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="kerja_ibu" class="form-label">Pekerjaan Ibu / Wali <b class="text-dark">*</b></label>
                                            <input type="text" class="form-control input-daftar input-tabkeluarga @error('kerja_ibu') is-invalid @enderror" name="kerja_ibu" id="kerja_ibu" value="{{ old('kerja_ibu') }}" onkeyup="checkTabKeluarga()" onblur="saveStorage('kerja_ibu', this.value, 'text')" required>
                                            @error('kerja_ibu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="jum_anak" class="form-label">Jumlah Anak <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar input-tabkeluarga @error('jum_anak') is-invalid @enderror" name="jum_anak" id="jum_anak" value="{{ old('jum_anak') }}" onkeyup="checkTabKeluarga()" onblur="saveStorage('jum_anak', this.value, 'text')" required>
                                            @error('jum_anak')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Penghasilan (Ayah dan Ibu) <b class="text-dark">*</b></label>
                                            <select class="form-select input-daftar input-tabkeluarga @error('penghasilan_ortu') is-invalid @enderror" name="penghasilan_ortu" id="penghasilan_ortu" onchange="checkTabKeluarga()" onblur="saveStorage('penghasilan_ortu', this.value, 'text')" required>
                                                <option value="Kurang dari Rp 1.000.000">Kurang dari Rp 1.000.000</option>
                                                <option value="Rp 1.000.000 - 2.499.999">Rp 1.000.000 - 2.499.999</option>
                                                <option value="Rp 2.499.999 - 4.999.999">Rp 2.499.999 - 4.999.999</option>
                                                <option value="Lebih dari Rp 5.000.000">Lebih dari Rp 5.000.000</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat_ortu" class="form-label">Alamat Orang Tua <b class="text-dark">*</b></label>
                                            <textarea class="form-control input-daftar input-tabkeluarga @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" name="alamat_ortu" rows="4" onkeyup="checkTabKeluarga()" onblur="saveStorage('alamat_ortu', this.value, 'text')" required>{{ old('alamat_ortu') }}</textarea>
                                            @error('alamat_ortu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="tlp_ortu" class="form-label">Telepon/HP Orang Tua <b class="text-dark">*</b></label>
                                            <input type="number" class="form-control input-daftar input-tabkeluarga @error('tlp_ortu') is-invalid @enderror" name="tlp_ortu" id="tlp_ortu" value="{{ old('tlp_ortu') }}" onblur="saveStorage('tlp_ortu', this.value, 'text')" onkeyup="checkTabKeluarga()" required>
                                            @error('tlp_ortu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-outline-app me-2" onclick="btnTab('#pills-pendidikan-tab')">Previous</button>
                                                <button type="button" class="btn btn-outline-app me-2" id="btn-next-keluarga" onclick="btnTab('#pills-prodi-tab', 'Data Program Studi')">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pt-4 tab-pane fade" id="pills-prodi" role="tabpanel" aria-labelledby="pills-prodi-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pembiayaan <b class="text-dark">*</b></label>
                                            <select class="form-select input-daftar input-tabprodi @error('jalur_id') is-invalid @enderror" name="jalur_id" id="jalur_id" onchange="eventComboBox(this, 'prodi')" required>
                                                <option value="">-Pilih Pembiayaan-</option>
                                                @foreach ($jalur as $jlr)
                                                    <option value="{{ $jlr->id }}">{{ $jlr->judul }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pilihan Prodi 1 <b class="text-dark">*</b></label>
                                            <select class="form-select input-daftar input-tabprodi @error('kelas1_id') is-invalid @enderror" name="kelas1_id" id="kelas1_id" onchange="eventComboBox(this, 'prodi')" required>
                                                <option value="">-Pilih Prodi-</option>
                                                @foreach ($kelas as $kls)
                                                    <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pilihan Prodi 2 <b class="text-dark">*</b></label>
                                            <select class="form-select input-daftar input-tabprodi @error('kelas2_id') is-invalid @enderror" name="kelas2_id" id="kelas2_id" onchange="eventComboBox(this, 'prodi')" required>
                                                <option value="">-Pilih Prodi-</option>
                                                @foreach ($kelas as $kls)
                                                    <option value="{{ $kls->id }}">{{ $kls->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-outline-app me-2" onclick="btnTab('#pills-keluarga-tab')">Previous</button>
                                                <button type="button" class="btn btn-outline-app me-2" id="btn-next-prodi" onclick="btnTab('#pills-tambahan-tab', 'Informasi Tambahan')">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pt-4 tab-pane fade" id="pills-tambahan" role="tabpanel" aria-labelledby="pills-tambahan-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="mb-3">
                                            <strong>Orang yang memberikan rekomendasi</strong>
                                            <br>
                                            <em>Kosongkan jika tidak ada</em>
                                        </p>
                                        <div class="mb-3">
                                            <label for="nama_rekomendasi" class="form-label">Nama</label>
                                            <input type="text" class="form-control input-daftar @error('nama_rekomendasi') is-invalid @enderror" name="nama_rekomendasi" id="nama_rekomendasi" value="{{ old('nama_rekomendasi') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="tlp_rekomendasi" class="form-label">No. HP/WA</label>
                                            <input type="number" class="form-control input-daftar @error('tlp_rekomendasi') is-invalid @enderror" name="tlp_rekomendasi" id="tlp_rekomendasi" value="{{ old('tlp_rekomendasi') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            Dari manakah anda mendapatkan informasi Penerimaan Mahasiswa Baru Politeknik Hasnur?
                                            <br>
                                            <em>Pilih salah satu atau lebih</em>
                                        </p>

                                        @error('sumber_info')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
    
                                        <div class="checkbox-group required">
                                            <div class="row mt-3">
                                                @foreach ($sumber as $sum)
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input input-daftar input-tabinfo" type="checkbox" name="sumber_info[]" id="sumberinfo-{{ $sum->id }}" onclick="checkTabInfo()" onchange="saveStorage(this.id, this.value, 'checkbox')" value="{{ $sum->id }}" id="info-{{ $sum->id }}">
                                                            <label class="form-check-label" for="sumberinfo-{{ $sum->id }}">
                                                                {{ $sum->info }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-outline-app me-2" onclick="btnTab('#pills-prodi-tab')">Previous</button>
                                                <button type="submit" class="btn btn-app-secondary me-2" id="btn-save-info" >Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection