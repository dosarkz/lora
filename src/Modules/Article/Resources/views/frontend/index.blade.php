@extends('admin::layouts.app')

@section('content')
    <h3>This is default frontend page index Article module</h3>
    <p>You cat edit this page in {{request()->route()->getActionName()}}</p>
@endsection
