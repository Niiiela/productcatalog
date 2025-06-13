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
        <strong>Erro ao processar:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h1 class="text-xl font-bold mb-4">Catálogo de Produtos</h1>

    <a href="{{ route('products.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Novo Produto</a>

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Título</th>
                <th class="border px-4 py-2">Conteúdo</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Ações</th>
            </tr>
        </thead>
        
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $product->title }}</td>
                    <td class="border px-4 py-2">{{ $product->content }}</td>
                    <td class="border px-4 py-2">{{ $product->status ? 'Ativo' : 'Inativo' }}</td>
                    <td class="border px-4 py-2 space-x-2">
                    <a href="{{ route('products.edit', $product) }}" class=" no-underline inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition"> ✏️ Editar</a>
                        <form method="POST" action="{{ route('products.destroy', $product) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Tem certeza que deseja excluir este produto? Esta ação é irreversível.')"
                                class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded" >🗑️ Excluir </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Nenhum produto encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection