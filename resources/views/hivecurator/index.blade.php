@extends('layouts.hivecurator')

@section('title')
  <title>Select Tools</title>
@endsection
@section('contentarea')

  <div>
    <h1 class="text-3xl mt-3 leading-none font-extrabold text-white tracking-tight mb-4 text-center">HIVE CURRATOR TOOLS
    </h1>
  </div>

  <div class="flex flex-wrap flex-col  space-y-4  text-center items-center ">
    <a class="w-full sm:w-auto flex-none bg-gray-900 hover:bg-gray-700 text-white text-lg leading-6 font-semibold py-3 px-6 border border-transparent rounded-xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 keychainify-checked"
      href="{{ route('curator.search-tags') }}">Find By Tags</a>
    <a class="w-full sm:w-auto flex-none bg-gray-900 hover:bg-gray-700 text-white text-lg leading-6 font-semibold py-3 px-6 border border-transparent rounded-xl focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 keychainify-checked"
      href="{{ route('curator.select-community') }}">Find By Community</a>


  </div>


@endsection
