@extends('layout.template')
@section('title','Add Makanan')
@section('content')

<div class="container">
    @if(Session::has('alert'))
    <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action={{ url('/makanan') }} method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <legend>Add Makanan</legend>
                <div class="form-group">
                    <label for="">Nama Makanan</label>
                    <input type="text" name="nama" class="form-control" id="" placeholder="Nama Makanan">
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" name="harga" class="form-control" id="" placeholder="Harga">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="inputdeskripsi" class="form-control" rows="3"
                        required="required"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Thumbnail</label>
                    <input type="file" name="file" class="form-control" id="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection