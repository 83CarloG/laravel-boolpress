@extends('layouts.main')

@section('page-content')
    <main>
        <form method="POST" action="{{ route('admin.posts.store') }}">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Titolo" value="{{ old(
                'title') }}">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ old('slug') }}">
            </div>
            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea type="text" class="form-control" name="content" id="content" placeholder="Contenuto" cols="30" rows="8" value="{{ old('content') }} "></textarea>
            </div>
            <div class="form-group">
                <label for="excerpt">Riassunto</label>
                <textarea type="text" class="form-control" name="excerpt" id="excerpt" placeholder="Contenuto" cols="20" value={{ old('excerpt') }}></textarea>
            </div>
            <div class="input-group mb-1 author__select">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="author">Autori</label>
                </div>
                    <select name="user_id" class="custom-select" id="author">
                        <option selected>Scegli...</option>
                        @foreach ($users as $user)

                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ?  'selected' : ''}} >                          {{  $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="{{ old('published') ===1 ? 'checked' : '' }} " >
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
