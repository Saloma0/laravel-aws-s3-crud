@extends('layouts.master')

@section('title','Criar Produto')

@section('content')

<div class="row lateral-margins">

    <div style="width:500px; margin: 0 auto;">

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Produto actualizado com sucesso!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao actualizar produto!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('update.product',$product->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nome do produto</label>
              <input type="text" name="title" class="form-control" value="{{$product->title}}">
            </div>
            <div class="mb-3">
              <label class="form-label">Imagem</label>
              <input type="file" name="photo" class="form-control">
            </div>
            <div class="mb-3">
                <img src="{{$product->url}}" width="80" alt="" srcset="">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </form>
    </div>

</div>

@endsection