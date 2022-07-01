@extends('admin.empty')

@section('css')
    @livewireStyles
@endsection

@section('content')
    <livewire:counter />

@endsection

@section('js')
    @livewireScripts
@endsection
