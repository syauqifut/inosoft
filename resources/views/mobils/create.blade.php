@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('mobil.index') }}"> Back</a>
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
                <strong>Mesin:</strong>
                <input type="text" name="mesin" class="form-control" placeholder="Mesin">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kapasitas Penumpang:</strong>
                <input type="number" name="kapasitas_penumpang" class="form-control" placeholder="Kapasitas Penumpang">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tipe:</strong>
                <input type="text" name="tipe" class="form-control" placeholder="Tipe">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kendaraan:</strong>
                <select id="kendaraanData" name="kendaraan" class="form-control">
                    <option value="" disabled selected>Kendaraan</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button class="btn btn-primary btn-submit" id="submit">Submit</button>
        </div>
    </div>

</form>

<script type="text/javascript">
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

        $('#submit').on('click', function() {
            var mesin = $("input[name=mesin]").val();
            var kapasitas_penumpang = $("input[name=kapasitas_penumpang]").val();
            var tipe = $("input[name=tipe]").val();
            var kendaraan = $("#kendaraanData").val();


            if (mesin != "" && kapasitas_penumpang != "" && tipe != "") {
                $.ajax({
                    url: "{{url('/api/mobil')}}",
                    type: "POST",
                    data: {
                        _token: $("#csrf").val(),
                        mesin: mesin,
                        kapasitas_penumpang: kapasitas_penumpang,
                        tipe: tipe,
                        kendaraan: kendaraan,
                    },
                    cache: false,
                    success: function(dataResult) {
                        window.location.href = '/mobil';
                    }
                });
            } else {
                alert('Please fill all the field !');
            }
        });
    });
</script>

@endsection