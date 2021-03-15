<div>
  {{-- In work, do what you enjoy. --}}

  <div>
    <h1 class="text-5xl mt-3 leading-none font-extrabold text-white tracking-tight mb-4 text-center">Find Content By
      Communities</h1>
  </div>
  <div class="search-community mt-10 mb-3 p-3">
    <input type="text" wire:model="searchTerm" name="searchTerm" class="w-full shadow rounded h-10 p-3">
  </div>


  <ul class="bg-dark grid grid-cols-1 gap-2 md:grid-cols-2 lg:grid-cols-3">
    @forelse ($this->communityList as $item)
      <li class="p-4 m-2  bg-white shadow rounded-lg " :key='{{ $item->name }}'>
        <a href="{{ route('goto.community', ['community' => $item->name]) }}" class="">
          <div class="flex items-center">
            <img class="w-10 h-10 rounded-full" src="{{ $item->avatar_url }}" alt="{{ $item->title }}">
            <p class="ml-2 text-gray-700 font-semibold font-sans tracking-wide">{{ $item->title }}</p>
          </div>
        </a>
      </li>

    @empty
      kosong
    @endforelse
  </ul>

</div>
