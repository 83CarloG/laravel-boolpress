
@extends('layouts.main')

@section('page-content')
    <main>
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Titolo" value="{{ old(
                'title') }}" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ old('slug') }}" required>
            </div>
            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea type="text" class="form-control" name="content" id="content" placeholder="Contenuto" cols="30" rows="8" required>{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <label for="excerpt">Riassunto</label>
                <textarea type="text" class="form-control" name="excerpt" id="excerpt" placeholder="Contenuto" cols="20" required>{{ old('excerpt') }}</textarea>
            </div>
            <div class="input-group mb-1 author__select">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="author">Autori</label>
                </div>
                <select name="user_id" class="custom-select" id="author">
                    <option selected>Scegli...</option>
                    @foreach ($users as $user)
                    <option required value="{{ $user->id }}" {{ old('user_id') == $user->id ?  'selected' : ''}}>
                    {{  $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="image" accept="image/*">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value= "1" {{ old('published') ? 'checked' : '' }} >
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
