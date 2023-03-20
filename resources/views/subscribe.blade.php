@extends('layouts.main')
@section('content')
    <div class="container">
        <form action="{{route('store')}}" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
                <button type="submit" class="btn btn-success mt-3">subscribe</button>
            </div>
        </form>
    </div>
@endsection
