@extends('layouts.main')

@section('page-content')
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Data</th>
            <th scope="col">Autore</th>
            <th scope="col">Riassunto</th>
            <th scope="col">Autore</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <th>{{ date('d-m-Y', strtotime($post->created_at)) }}</th>
            <th>{{ $post->title }}</th>
            <td>{{ $post->excerpt }}</td>
            <td>{{ $post->user->name }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

@endsection

