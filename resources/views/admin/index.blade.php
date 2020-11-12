@extends('layouts.main')

@section('page-content')
    <table class="table" >
    <thead>
        <tr>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Riassunto</th>
            <th scope="col">Autore</th>
            <th scope=col>Tags</th>
            <th scope="col">Pubblicato</th>
            <th scope="col">Image</th>
            <th scope="col">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->excerpt }}</td>
            <td> <i>{{ $post->user->name }}</i></td>
            <td>
                <ul style="list-style: none">
                    @foreach ($post->tags as $tag)
                        <li>{{ $tag->name }}</li>
                    @endforeach
                </ul>
            </td>
            <td>
                {{-- <img src="{{ $post->user->name }}" alt=""> --}}
                @if ($post->published)
                <span class="badge badge-success">SI</span>
                @else
                <span class="badge badge-danger">NO</span>
                @endif
            </td>
            <td><span class="badge badge-{{ empty($post->image) ? 'danger' : 'success' }}">{{ empty($post->image) ? 'NO' : 'SI' }}</span></td>
            <td>
                <a href="{{ route('admin.posts.show', $post->id) }}"><button class="badge badge-info">Info</button></a>
                <a href="{{ route('admin.posts.edit', $post->id) }}"><button class="badge badge-secondary">Edita</button></a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="badge badge-warning" class="btn btn-warning" type="submit">Elimina</button>
                </form>
            </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <form action="{{ route('admin.search') }}" method="GET">
        <input type="text" name="search" required/>
        <button type="submit">Cerca Post</button>
    </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
@endsection

