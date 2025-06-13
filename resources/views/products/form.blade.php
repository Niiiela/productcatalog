@extends('layout')

@section('content')

{{-- Alertas de sucesso --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
@endif

{{-- Alertas de erro de validação --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Erro ao cadastrar o produto:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h1 class="text-xl font-bold mb-4">{{ isset($product) ? 'Editar Produto' : 'Novo Produto' }}</h1>

    <form method="POST" action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}">
        @csrf
        @isset($product) @method('PUT') @endisset

        <label class="block mb-2">Título:
            <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}" required class="border p-2 w-full">
        </label>

        <label class="block mb-2">Conteúdo:
            <textarea name="content" class="border p-2 w-full">{{ old('content', $product->content ?? '') }}</textarea>
        </label>

        <label class="block mb-4">Status:
            <select name="status" class="border p-2 w-full">
                <option value="1" {{ old('status', $product->status ?? 1) == 1 ? 'selected' : '' }}>Ativo</option>
                <option value="0" {{ old('status', $product->status ?? 1) == 0 ? 'selected' : '' }}>Inativo</option>
            </select>
        </label>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
    </form>
@endsection
