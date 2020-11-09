@extends('layouts.main')

@section('page-content')
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Riassunto</th>
            <th scope="col">Pubblicato</th>
            <th scope="col">Autore</th>
            <th scope="col">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <th>{{ $post->title }}</th>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->excerpt }}</td>
            <td>
                @if ($post->published)
                <span class="badge badge-success">SI</span>
                @else
                <span class="badge badge-danger">NO</span>
                @endif
            </td>
            <td>{{ $post->user->name }}</td>
            <td>
                <a href="{{ route('admin.posts.show', $post->id) }}"><span class="badge badge-info">Info</span></a>
                <a href="{{ route('admin.posts.edit', $post->id) }}"><span class="badge badge-secondary">Edita</span>
                <form action="{{ route('admin.posts.destroy', $post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <span class="badge badge-danger" type="button" class="btn btn-danger" type="submit">Elimina</span>
                    </form>
                </ul>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>

@endsection

