@extends('layout.template')
@section('title','Beranda')
@section('content')

@if(Session::has('alert'))
<div class="alert alert-danger">
    <div>{{Session::get('alert')}}</div>
</div>
@endif

<link href="{{ asset('assets/jquery.dataTables.css') }}" rel="stylesheet" media="all">
<div id="add" class="row">
    <div class="col-md-6 offset-md-3">
        <form>
            <button type="submit" class="btn btn-primary btn-sm btn-block">
                <i class="fa fa-dot-circle-o"></i> Submit
            </button>
            <button type="reset" class="btn btn-danger btn-sm btn-block">
                <i class="fa fa-ban"></i> Reset
            </button>
        </form>
        <br>
        <button id="closeAdd" type="button" class="btn btn-outline-danger btn-sm btn-block"><i
                class="fa  fa-times-circle"></i> Close</button>
    </div> <!-- kolom 8 end -->
</div>
{{-- <a href="{{ url('makanan/create') }}" class="btn btn-primary">Add Data</a> --}}
<div class="row">
    <div class="col-md-10 offset-md-1">
        <a href="{{ url('makanan/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i> Add</a>
        <br><br />
        <div class="table-responsive table--no-card m-b-40">
            <div class="au-task js-list-load">
                <table id="example3" class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>Nama {{$d[0]->jo}}</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($mkn as $m)
                        <tr>
                            <td>{{$m->nama}}</td>
                            <td>{{$m->deskripsi}}</td>
                            <td><img height='150' width='150' src="{{ asset("uploads/data/thumb/$m->gambar") }}" alt=""></td>
                            <td>{{$m->harga}}</td>
                            <td>
                                <a href="{{ url("makanan/{$m->id}/edit") }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil-square-o"></i> Edit
                                </a>
                                {{-- <form action="{{ url("/makanan/{$m->id}") }}" method="post"> --}}
                                {{-- @method('DELETE') --}}
                                {{-- @csrf --}}
                                {{-- <input type="hidden" value="{{$m->id}}" id="x"> --}}
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                {{-- <button type="submit" class="btn btn-danger btn-sm"> --}}
                                <button onclick="hapus({{$m->id}})" class="btn btn-danger btn-sm">
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
                        url: "{{ url("/makanan/") }}/"+id,
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