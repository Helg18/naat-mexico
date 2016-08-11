
@extends('layouts.secure')

@section('content')

    <h1>Encuesta NSE</h1>
    @include('company.quiz.questions',['register'=>$register])

@endsection