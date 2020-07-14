@extends('layout.template')
@section('title','Add Promo')
@section('content')

<div class="container">
    @if(Session::has('alert'))
    <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action={{ url('/promo') }} method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <legend>Add Promo</legend>
                <div class="form-group">
                    <label for="">Judul Promo</label>
                    <input type="text" name="judul" class="form-control" id="" placeholder="Judul Promo">
                </div>
                <div class="form-group">
                    <label for="">Thumbnail</label>
                    <input type="file" name="file" class="form-control" id="">
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