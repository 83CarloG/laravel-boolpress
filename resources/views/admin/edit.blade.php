@extends('layouts.app')

@section('page-content')
    <main>
        <form method="POST" action="{{ route('post.update', $data   ->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $data->slug }}">
            </div>
            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea type="text" class="form-control" name="content" id="content" placeholder="Contenuto" cols="30" rows="8" value="{{ $data->content }} "></textarea>
            </div>
            <div class="form-group">
                <label for="excerpt">Riassunto</label>
                <textarea type="text" class="form-control" name="excerpt" id="excerpt" placeholder="Contenuto" cols="20" value="{{ $data->excerpt }}"></textarea>
            </div>
            <div class="input-group mb-1 author__select">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="author">Autori</label>
                </div>
                    <select name="user_id" class="custom-select" id="author">
                        <option selected>Scegli...</option>
                        @foreach ($users as $user)

                        <option value="{{ $user->id }}">                          {{  $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="{{ $post->published }}" >
                    <label class="form-check-labe" for="published">Pubblicato</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Salva</button>


            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </form>
        </main>
@endsection
