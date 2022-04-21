@extends('layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 id="title">MOTOR</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('motor.create') }}"> Create</a>
        </div>
    </div>
</div>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Mesin</th>
            <th>Tipe Suspensi</th>
            <th>Tipe Transmisi</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody id="bodyData">
    </tbody>
</table>

<script>
    $(document).ready(function() {
        var url = "{{url('/motor/')}}";
        $.ajax({
            // url = "/api/motor",
            url: "{{url('/api/motor')}}",
            method: "GET",
            success: function(data) {
                var result = data.data;
                var bodyData = '';
                var i = 1;
                console.log(result);
                $.each(result, function(index, row) {
                    var editUrl = url + '/edit/' + row._id;
                    var status = (row.terjual === undefined ? 'Belum Terjual' : (row.terjual !== null ? 'Terjual' : 'Belum Terjual'));
                    bodyData += "<tr>"
                    bodyData += "<td>" + i++ + "</td>" +
                        "<td>" + row.mesin + "</td>" +
                        "<td>" + row.tipe_suspensi + "</td>" +
                        "<td>" + row.tipe_transmisi + "</td>" +
                        "<td>" + status + "</td>" +
                        "<td>" +
                        "<button class='btn btn-warning status' value='" + row._id + "' style='margin-left:20px;'>Ganti Status</button>" +
                        "<a class='btn btn-primary' href='" + editUrl + "'>Edit</a>" +
                        "<button class='btn btn-danger delete' value='" + row._id + "' style='margin-left:20px;'>Delete</button>" +
                        "</td>";
                    bodyData += "</tr>";

                })
                $("#bodyData").append(bodyData);
            },
            error: function(err) {
                alert(err)
            }
        })
    });

    $(document).on("click", ".delete", function() {
        var $ele = $(this).parent().parent();
        var id = $(this).val();
        var url = "{{url('/api/motor/')}}";
        var dltUrl = url + "/" + id;
        $.ajax({
            url: dltUrl,
            method: "DELETE",
            cache: false,
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(dataResult) {
                window.location.href = '/motor';
            }
        });
    });

    $(document).on("click", ".status", function() {
        var $ele = $(this).parent().parent();
        var id = $(this).val();
        var url = "{{url('/api/motor/status/')}}";
        var statusUrl = url + "/" + id;
        $.ajax({
            url: statusUrl,
            method: "PUT",
            cache: false,
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(dataResult) {
                window.location.href = '/motor';
            }
        });
    });
</script>
@endsection