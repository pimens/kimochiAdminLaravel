@extends('layout.template')
@section('title','Edit Makanan')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <form action={{ url("/makanan/{$makanan->id}") }} method="post" role="form" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <legend>Edit Makanan</legend>
                <div class="form-group">
                    <label for="">Nama Makanan</label>
                    <input value="{{$makanan->nama}}" type="text" name="nama" class="form-control" id="" placeholder="Nama Makanan">
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input value="{{$makanan->harga}}" type="text" name="harga" class="form-control" id="" placeholder="Harga">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="inputdeskripsi" class="form-control" rows="3" required="required">{{$makanan->deskripsi}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Gambar</label>
                    <input type="file" name="file" class="form-control" id="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection