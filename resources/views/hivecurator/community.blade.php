@extends('layouts.hivecurator')

@section('title')
  <title>Browse Post By Communities</title>
@endsection

@section('contentarea')
  @livewire('hive-com',['community'=>$community])
@endsection
