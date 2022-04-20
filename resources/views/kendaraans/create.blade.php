@extends('kendaraans.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create</h2>
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

<form>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tahun Keluaran:</strong>
                <input type="number" name="tahun_keluaran" class="form-control" placeholder="Tahun Keluaran">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Warna:</strong>
                <input type="text" name="warna" class="form-control" placeholder="Warna">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Harga:</strong>
                <input type="number" name="harga" class="form-control" placeholder="Harga">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button class="btn btn-primary btn-submit" id="submit">Submit</button>
        </div>
    </div>

</form>

<script type="text/javascript">
    $(document).ready(function() {

        $('#submit').on('click', function() {
            var tahun_keluaran = $("input[name=tahun_keluaran]").val();
            var warna = $("input[name=warna]").val();
            var harga = $("input[name=harga]").val();
            if (tahun_keluaran != "" && warna != "" && harga != "") {
                $.ajax({
                    url: "{{url('/api/kendaraan')}}",
                    type: "POST",
                    data: {
                        _token: $("#csrf").val(),
                        tahun_keluaran: tahun_keluaran,
                        warna: warna,
                        harga: harga
                    },
                    cache: false,
                    success: function(dataResult) {
                        window.location.href = '/kendaraan';
                    }
                });
            } else {
                alert('Please fill all the field !');
            }
        });
    });
</script>

@endsection