@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                  @foreach($practice as $prac)
			<h1>{{ $prac->practice_name  }}</h1>
			<h2>{{ date("g:i a", strtotime("15:00"))  }}</h2>
		  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
