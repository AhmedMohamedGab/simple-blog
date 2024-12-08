@extends('layouts.app')

@section('title')
create
@endsection

@section('content')

<form action="{{route('posts.store')}}" method="POST">
    @csrf
  <div class="mb-3">
    <label for="exampleTitle" class="form-label">Title</label>
    <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" id="exampleTitle">
    @error('title')
      <div class="alert alert-danger">{{'enter a valid title'}}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="exampleTextarea" class="form-label">Description</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="exampleTextarea" rows="3">{{old('description')}}</textarea>
    @error('description')
      <div class="alert alert-danger">{{'enter a valid description'}}</div>
    @enderror
  </div>
  <select name="postCreator" class="form-select @error('postCreator') is-invalid @enderror" aria-label="Default select example">
    @foreach($users as $user)
      <option value="{{$user->id}}">{{$user->name}}</option>
    @endforeach
  </select>
  @error('title')
    <div class="alert alert-danger">{{'enter a valid post creator'}}</div>
  @enderror
  <button type="submit" class="btn btn-success mt-3">Submit</button>
</form>
@endsection