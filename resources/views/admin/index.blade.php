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

        </tr>
        @endforeach
      </tbody>
    </table>

@endsection

