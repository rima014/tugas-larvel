@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <table>
            <div class="col-md-8 text-center">
                <h3>{{ $name }}</h3>
                <p>{{ $asal }}</p>
                <p>{{ $email }}</p>
           <img src="img/{{ $image }} " alt="{{ $name }}" width="100" class="img-thumbnail rounded-circle">
            </div>
        </table>
    </div>
</div>
@endsection()
