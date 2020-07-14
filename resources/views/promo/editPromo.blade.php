@extends('layout.template')
@section('title','Edit Promo')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action={{ url("/promo/{$promo->id}") }} method="post" role="form" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <legend>Edit Promo</legend>
                <div class="form-group">
                    <label for="">Judul Promo</label>
                    <input value="{{$promo->judul}}" type="text" name="judul" class="form-control" id=""
                        placeholder="Nama Makanan">
                </div>
                <div class="form-group">
                    <label for="">Thumbnail</label>
                    <img height='150' width='150' src="{{ asset("uploads/$promo->gambar") }}" alt=""><br><br>
                    <input type="file" name="file" class="form-control" id="">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" id="inputdeskripsi" class="form-control" rows="3"
                        required="required">{{$promo->deskripsi}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection