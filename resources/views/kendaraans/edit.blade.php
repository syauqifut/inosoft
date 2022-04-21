@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('kendaraan.index') }}"> Back</a>
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
            <strong>Tahun Keluaran:</strong>
            <input type="number" id="tahun_keluaran" name="tahun_keluaran" value="{{ $kendaraan->tahun_keluaran }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Warna:</strong>
            <input type="text" id="warna" name="warna" value="{{ $kendaraan->warna }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Harga:</strong>
            <input type="number" id="harga" name="harga" value="{{ $kendaraan->harga }}" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button class="btn btn-primary" id="submit" value="{{ $kendaraan->_id }}">Submit</button>
    </div>
</div>

<!-- </form> -->

<script>
    $(document).ready(function() {

        $("#submit").on("click", function() {
            var url = "{{URL('api/kendaraan/'.$kendaraan->_id)}}";
            var id =
                $.ajax({
                    url: url,
                    type: "PUT",
                    data: {
                        _token: '{{ csrf_token() }}',
                        tahun_keluaran: $('#tahun_keluaran').val(),
                        warna: $('#warna').val(),
                        harga: $('#harga').val()
                    },
                    success: function(dataResult, err) {
                        window.location = "/kendaraan";
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