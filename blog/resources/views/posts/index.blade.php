@extends('layouts.app')

@section('title')
index
@endsection

@section('content')

<div class="text-center mt-5">
    <a class="btn btn-success" href="{{route('posts.create')}}" role="button">Create Post</a>
</div>

<table class="table text-center mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Titleeeeeeeeeeetoooooo</th>
      <th scope="col">Posted Byeeeeeetoooo</th>
      <th scope="col">Created Ateeeeeeeeeeetoooooo</th>
      <th scope="col">Actionseeeeeetoooooo</th>
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
        <th scope="row">{{$post->id}}</th>
        <td>{{$post->title}}</td>
        <td>{{$post->user ? $post->user->name : 'not found'}}</td>
        <td>{{$post->created_at->format('Y-m-d H:m:s')}}</td>
        <!-- @foreach($post as $key => $value)
            <td>{{$value}}</td>
        @endforeach -->
        <td>
            <a class="btn btn-info" href="{{route('posts.show', $post->id)}}" role="button">View</a>
            <a class="btn btn-primary" href="{{route('posts.edit', $post->id)}}" role="button">Edit</a>
            <form style="display:inline" action="{{route('posts.destroy', $post->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" onClick="return confirm('Are you sure to delete the post?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection