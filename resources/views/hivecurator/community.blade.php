@extends('layouts.hivecurator')

@section('contentarea')
  @livewire('hive-com',['community'=>$community])
@endsection
