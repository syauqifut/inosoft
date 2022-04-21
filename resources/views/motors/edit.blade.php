@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('motor.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- <form> -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Mesin:</strong>
            <input type="text" id="mesin" name="mesin" value="{{ $motor->mesin }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tipe Suspensi:</strong>
            <input type="text" id="tipe_suspensi" name="tipe_suspensi" value="{{ $motor->tipe_suspensi }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tipe Transmisi:</strong>
            <input type="text" id="tipe_transmisi" name="tipe_transmisi" value="{{ $motor->tipe_transmisi }}" class="form-control">
        </div>
    </div>
    @if ($kendaraan)
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Informasi Detail Kendaraan:</strong>
            <div class="form-control">
                Tahun Keluaran : {{ $kendaraan->tahun_keluaran }} <br>
                Warna : {{ $kendaraan->warna }} <br>
                Harga : {{ $kendaraan->harga }}
            </div>
        </div>
    </div>
    @endif
    
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Kendaraan:</strong>
            <select id="kendaraanData" name="kendaraan" class="form-control">
                <option value="" disabled selected>--Ganti--</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button class="btn btn-primary" id="submit" value="{{ $motor->_id }}">Submit</button>
    </div>
</div>

<!-- </form> -->

<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{url('/api/kendaraan')}}",
            method: "GET",
            dataType: "json",
            success: function(data) {
                var result = data.data;
                var bodyData = '';
                var i = 1;
                $.each(result, function(index, row) {
                    bodyData += "<option value='" + row._id + "'> (" + row.tahun_keluaran + "-" + row.warna + ") Rp. " + row.harga + "</option>"

                })
                $("#kendaraanData").append(bodyData);
            },
            error: function(err) {
                alert(err)
            }
        })
    });

    $(document).ready(function() {

        $("#submit").on("click", function() {
            var url = "{{URL('api/motor/'.$motor->_id)}}";
            var id =
                $.ajax({
                    url: url,
                    type: "PUT",
                    data: {
                        _token: '{{ csrf_token() }}',
                        mesin: $('#mesin').val(),
                        tipe_suspensi: $('#tipe_suspensi').val(),
                        tipe_transmisi: $('#tipe_transmisi').val(),
                        kendaraan: $("#kendaraanData").val()
                    },
                    success: function(dataResult, err) {
                        window.location = "/motor";
                    },
                    error: function(err) {
                        alert(err)
                    }
                });
            console.log(id);

        });
    });
</script>
@endsection