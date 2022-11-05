@extends('layouts.master')

@section('title','Início')

@section('content')


<div class="row lateral-margins">
    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Erro ao deletar produto!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Sucesso ao deletar produto!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @foreach ($products as $item)
        <div class="col mt-4">
            <div class="card" style="width: 18rem;">
                <img src="{{$item->url}}" class="card-img-top" alt="without image">
                <div class="card-body">
                <h5 class="card-title">{{$item->title}}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                
                <div class="d-flex justify-content-between">
                    <a href="{{route('edit.product',$item->id)}}" class="btn btn-warning">Editar</a>
                    <a href="{{route('delete.product',$item->id)}}" class="btn btn-danger">Eliminar</a>
                </div>
                </div>
            </div>
        </div>        
    @endforeach

</div>

@endsection