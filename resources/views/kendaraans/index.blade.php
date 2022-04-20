@extends('kendaraans.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 id="title"></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('kendaraan.create') }}"> Create</a>
        </div>
    </div>
</div>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nomor</th>
            <th>Tahun Keluaran</th>
            <th>Warna</th>
            <th>Harga</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody id="bodyData">
    </tbody>
</table>

<script>
    $(document).ready(function() {
        var url = "{{url('/kendaraan/')}}";
        $.ajax({
            // url = "/api/kendaraan",
            url: "{{url('/api/kendaraan')}}",
            method: "GET",
            success: function(data) {
                var result = data.data;
                var bodyData = '';
                var i = 1;
                $.each(result, function(index, row) {
                    var editUrl = url + '/edit/' + row._id;
                    bodyData += "<tr>"
                    bodyData += "<td>" + i++ + "</td>" + 
                            "<td>" + row.tahun_keluaran + "</td>" + 
                            "<td>" + row.warna + "</td>" + 
                            "<td>" + row.harga + "</td>" +
                            "<td>" + 
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
        var id= $(this).val();
        var url = "{{url('/api/kendaraan/')}}";
        var dltUrl = url+"/"+id;
		$.ajax({
			url: dltUrl,
			method: "DELETE",
			cache: false,
			data:{
				_token:'{{ csrf_token() }}'
			},
			success: function(dataResult){
                window.location.href = '/kendaraan';
			}
		});
	});
</script>
@endsection