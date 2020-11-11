@extends('layouts.main')

@section('page-content')

<table class="table" >
    <thead>
        <tr>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Riassunto</th>
            <th scope="col">Autore</th>
            <th scope="col">Pubblicato</th>
            <th scope="col">Image</th>
            <th scope="col">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @if($posts->isNotEmpty())
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->excerpt }}</td>
            <td> <i>{{ $post->user->name }}</i></td>
            <td class="text-center">
                @if ($post->published)
                <span class="badge badge-success">SI</span>
                @else
                <span class="badge badge-danger">NO</span>
                @endif
            </td>
            <td class="text-center"><span class="badge badge-{{ empty($post->image) ? 'danger' : 'success' }}">{{ empty($post->image) ? 'NO' : 'SI' }}</span></td>
            <td class="text-center">
                <a href="{{ route('admin.posts.show', $post->id) }}"><button class="badge badge-info">Info</button></a>
                <a href="{{ route('admin.posts.edit', $post->id) }}"><button class="badge badge-secondary">Edita</button></a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="badge badge-warning" class="btn btn-warning" type="submit">Elimina</button>
                </form>
            </td>
        </tr>
    </tbody>
    @endforeach
</table>


    @else
    <div>
        <h2>Nessun Risultato</h2>
    </div>
@endif
@endsection
