@extends('layout.template')
@section('title','Add Cabang')
@section('content')

<div class="container">
    @if(Session::has('alert'))
    <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action={{ url('/cabang') }} method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <legend>Add Cabang</legend>
                <div class="form-group">
                    <label for="">Nama Cabang</label>
                    <input type="text" name="nama" class="form-control" id="" placeholder="Nama Cabang">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="" placeholder="Alamat Cabang">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="inputdeskripsi" class="form-control" rows="3"
                        required="required"></textarea>
                </div>                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection