@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>

    Welcome, {{ auth()->user()->name }}
</div>

<div class="row p-3 d-flex">

    <div class="col-lg-2 p-3 bg-light text-center rounded me-2 mb-3">
        <h1>{{ $users->count() }}</h1>
        <p>Users</p>
    </div>

    <div class="col-lg-2 p-3 bg-light text-center rounded me-2 mb-3">
        <h1>{{ $movies->count() }}</h1>
        <p>Movies</p>
    </div>

    <div class="col-lg-2 p-3 bg-light text-center rounded me-2 mb-3">
        <h1>{{ $comments->count() }}</h1>
        <p>Comments</p>
    </div>

</div>

<div class="bg-light">

    <div class="bg-dark p-2 rounded-top">
        <h5 class="text-white">Graph</h5>
    </div>

    <div class="mb-3" style="width: 100%;">
        {!! $chart->container() !!}
    </div>
</div>





{!! $chart->script() !!}
@endsection