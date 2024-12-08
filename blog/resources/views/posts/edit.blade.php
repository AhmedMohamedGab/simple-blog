@extends('layouts.app')

@section('title')
edit
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('posts.update', $post->id)}}" method="POST">
    @csrf
    @method('PUT')
  <div class="mb-3">
    <label for="exampleTitle" class="form-label">Title</label>
    <input type="text" name="title" value="{{$post->title}}" class="form-control" id="exampleTitle">
  </div>
  <div class="mb-3">
    <label for="exampleTextarea" class="form-label">Description</label>
    <textarea name="description" class="form-control" id="exampleTextarea" rows="3">{{$post->description}}</textarea>
  </div>
  <select name="postCreator" class="form-select" aria-label="Default select example">
  @foreach($users as $user)
    <!-- <option {{$post->user_id==$user->id ? 'selected' : ''}} value="{{$user->id}}" > {{$user->name}} </option> -->
    <!-- <option @if($post->user_id==$user->id) selected @endif value="{{$user->id}}" > {{$user->name}} </option> -->
    <option @selected($post->user_id==$user->id) value="{{$user->id}}" > {{$user->name}} </option>
  @endforeach
  </select>
  <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>
@endsection