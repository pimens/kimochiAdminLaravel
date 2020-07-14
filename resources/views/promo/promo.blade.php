@extends('layout.template')
@section('title','Promo')
@section('content')

@if(Session::has('alert'))
<div class="alert alert-danger">
    <div>{{Session::get('alert')}}</div>
</div>
@endif

<link href="{{ asset('assets/jquery.dataTables.css') }}" rel="stylesheet" media="all">
<div class="row">
    <div class="col-md-10 offset-md-1">
        <a href="{{ url('promo/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Add</a>
        <br><br />
        <div class="table-responsive table--no-card m-b-40">          
            <div class="au-task js-list-load">
                <table id="example3" class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Thumbnail</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promos as $promo)
                        <tr>
                            <td>{{$promo->judul}}</td>
                            <td>{{$promo->deskripsi}}</td>
                            <td><img height='150' width='150' src="{{ asset("uploads/data/thumb/$promo->gambar") }}" alt=""></td>
                            
                            <td>
                                <a href="{{ url("promo/{$promo->id}/edit") }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </a>
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <button onclick="hapus({{$promo->id}})" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
@section('page-js-script')
<script type="text/javascript">
    $(function() {
        $('#example3').dataTable();
    });
</script>
<script src="{{ asset('assets/jquery.dataTables.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {       
        $("#add").hide(1000);
        $("#addButton").click(function() {
            $("#add").show(1000);
        });
        $("#closeAdd").click(function() {
            $("#add").hide(1000);
        });
    });
    function hapus(id) {
        // var str = $("#x").val();
        // alert(str);
        swal({
                title: 'Konfirmasi?',
                text: "Apakah anda yakin ingin menghapus data ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                closeOnConfirm: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ url("/promo/") }}/"+id,
                        method:"delete",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                        },
                        type: "DELETE",
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status) //if success close modal and reload ajax table
                            {

                                swal({
                                    title: "Data Berhasil dihapus",
                                    type: "success",
                                });
                                window.location.reload();
                            }

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error adding / update data');
                        }
                    });
                }
            });
    }
</script>
@stop