@extends('layouts.main')
@section('content')

    <div class="container">
        <form action="{{route('post')}}" method="post">
            <input type="hidden" value="{{$user->id}}" name="user">
            <div class="mb-3">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input name='title' type="text" class="form-control" id="title" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success mt-3">post</button>
            </div>
        </form>
    </div>

@endsection
