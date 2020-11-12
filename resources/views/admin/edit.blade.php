
@extends('layouts.main')

@section('page-content')



    <main>
        <form method="POST" action="{{ route('admin.posts.update', $post->id)}}"  enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title') ?  old('title') :  $post->title }}" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') ?? $post->slug }}" required>
            </div>
            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea type="text" class="form-control" name="content" id="content" cols="30" rows="8" required>{{ old('content') ?? $post->slug }}</textarea>
            </div>
            <div class="form-group">
                <label for="excerpt">Riassunto</label>
                <textarea type="text" class="form-control" name="excerpt" id="excerpt" placeholder="Contenuto" cols="20" required>{{ old('excerpt') ?? $post->excerpt}}</textarea>
            </div>
            <div class="input-group mb-1 author__select">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="author">Autori</label>
                </div>
                    <select name="user_id" class="custom-select" id="author">
                        <option selected>Scegli...</option>
                        @php
                            $selected = old('user_id')  ? old('user_id') :   $post->user_id;
                        @endphp
                        @foreach ($users as $user)
                            <option required value="{{ $user->id }}" {{ $selected == $user->id ? 'selected' : ''}}>
                            {{  $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image" id="image" accept="image/*" value="{{ $post->image }}" required>
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>
            @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="tags[]" id="genre-{{ $tag->id }}" value="{{ $tag->id }}" {{ $tagsChecked }}>
                    <label class="form-check-label" for="genre-{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
            @endforeach
            <div class="form-group">
                <div class="form-check">
                    @php
                        $checked = old('published') !== null ? old('published') :   $post->published;
                    @endphp
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ $checked == 1 ? 'checked' : '' }} >
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
