@extends('layouts.master')

@section('title','Criar Produto')

@section('content')

<div class="row lateral-margins">

    <div style="width:500px; margin: 0 auto;">

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Produto adicionado com sucesso!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao cadastrar produto!
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

        <form method="POST" action="{{route('store.product')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nome do produto</label>
              <input type="text" name="title" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Imagem</label>
              <input type="file" name="photo" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </form>
    </div>

</div>

@endsection