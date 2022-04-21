@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 id="title">Dasboard</h2>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h5 id="title">Table Kendaraan</h5>
        </div>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kendaraan Terjual</th>
            <th>Kendaraan Tidak Terjual</th>
            <th>Jumlah Semua Kendaraan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="jumlahnotsoldall"></td>
            <td id="jumlahsoldall"></td>
            <td id="jumlahall"></td>
        </tr>
    </tbody>
</table>


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h5 id="title">Table Motor</h5>
        </div>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Motor Terjual</th>
            <th>Motor Tidak Terjual</th>
            <th>Jumlah Semua Motor</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="jumlahmotorsold"></td>
            <td id="jumlahmotornotsold"></td>
            <td id="jumlahmotor"></td>
        </tr>
    </tbody>
</table>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Mesin</th>
            <th>Tipe Suspensi</th>
            <th>Tipe Transmisi</th>
        </tr>
    </thead>
    <tbody>
    <tbody id="motorSold"></tbody>
</table>



<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h5 id="title">Table Mobil</h5>
        </div>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Mobil Terjual</th>
            <th>Mobil Tidak Terjual</th>
            <th>Jumlah Semua Mobil</th>
        </tr>
    </thead>
    <!-- <tbody id="bodyData"> -->
    <tbody>
        <tr>
            <td id="jumlahmobilsold"></td>
            <td id="jumlahmobilnotsold"></td>
            <td id="jumlahmobil"></td </tr>
    </tbody>
</table>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Mesin</th>
            <th>Kapasitas Penumpang</th>
            <th>Tipe</th>
        </tr>
    </thead>
    <tbody>
    <tbody id="mobilSold"></tbody>
</table>


<script>
    $(document).ready(function() {
        var url = "{{url('/kendaraan/')}}";
        $.ajax({
            url: "{{url('/api/dashboard')}}",
            method: "GET",
            success: function(data) {
                var result = data.data;

                $("#jumlahall").html(result.jumlahall);
                $("#jumlahsoldall").html(result.jumlahsoldall);
                $("#jumlahnotsoldall").html(result.jumlahnotsoldall);

                $("#jumlahmotor").html(result.jumlahmotor);
                $("#jumlahmotorsold").html(result.jumlahmotorsold);
                $("#jumlahmotornotsold").html(result.jumlahmotornotsold);

                $("#jumlahmobil").html(result.jumlahmobil);
                $("#jumlahmobilsold").html(result.jumlahmobilsold);
                $("#jumlahmobilnotsold").html(result.jumlahmobilnotsold);
            },
            error: function(err) {
                alert(err)
            }
        })
    });

    $(document).ready(function() {
        var url = "{{url('/motor/')}}";
        $.ajax({
            url: "{{url('/api/motorsold')}}",
            method: "GET",
            success: function(data) {
                var result = data.data;
                var bodyData = '';
                var i = 1;
                $.each(result, function(index, row) {
                    var infoMotorUrl = url + '/detail/' + row._id;
                    bodyData += "<tr>"
                    bodyData += "<td>" + i++ + "</td>" +
                        "<td>" + row.mesin + "</td>" +
                        "<td>" + row.tipe_suspensi + "</td>" +
                        "<td>" + row.tipe_transmisi + "</td>" +
                        "<td>" +
                        "<a class='btn btn-primary' href='" + infoMotorUrl + "'>Info Penjualan</a>" +
                        "</td>";
                    bodyData += "</tr>";

                })
                $("#motorSold").append(bodyData);
            },
            error: function(err) {
                alert(err)
            }
        })
    });

    $(document).ready(function() {
        var url = "{{url('/mobil/')}}";
        $.ajax({
            url: "{{url('/api/mobilsold')}}",
            method: "GET",
            success: function(data) {
                var result = data.data;
                var bodyData = '';
                var i = 1;
                $.each(result, function(index, row) {
                    var infoMobilUrl = url + '/detail/' + row._id;
                    bodyData += "<tr>"
                    bodyData += "<td>" + i++ + "</td>" +
                        "<td>" + row.mesin + "</td>" +
                        "<td>" + row.kapasitas_penumpang + "</td>" +
                        "<td>" + row.tipe + "</td>" +
                        "<td>" +
                        "<a class='btn btn-primary' href='" + infoMobilUrl + "'>Info Penjualan</a>" +
                        "</td>";
                    bodyData += "</tr>";

                })
                $("#mobilSold").append(bodyData);
            },
            error: function(err) {
                alert(err)
            }
        })
    });
</script>
@endsection