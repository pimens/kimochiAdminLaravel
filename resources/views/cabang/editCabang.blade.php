@extends('layout.template')
@section('title','Edit Cabang')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action={{ url("/cabang/{$cabang->id}") }} method="post" role="form" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <legend>Edit Cabang</legend>
                <div class="form-group">
                    <label for="">Nama Cabang</label>
                    <input value="{{$cabang->nama}}" type="text" name="nama" class="form-control" id=""
                        placeholder="Nama Cabang">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input value="{{$cabang->alamat}}" type="text" name="alamat" class="form-control" id=""
                        placeholder="Alamat">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="inputdeskripsi" class="form-control" rows="3"
                        required="required">{{$cabang->deskripsi}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection