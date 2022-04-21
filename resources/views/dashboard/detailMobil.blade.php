@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Detail Info</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('dashboard') }}"> Back</a>
        </div>
    </div>
</div>

<!-- <form> -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Mesin:</strong>
            <div class="form-control">{{ $mobil->mesin }}</div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Kapasitas Penumpang:</strong>
            <div class="form-control">{{ $mobil->kapasitas_penumpang }}</div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tipe:</strong>
            <div class="form-control">{{ $mobil->tipe }}</div>
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
            <strong>Terjual Pada:</strong>
            <div class="form-control">{{ $mobil->terjual }}</div>
        </div>
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
</script>
@endsection