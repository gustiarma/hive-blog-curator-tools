<div>
  {{-- Because she competes with no one, no one can compete with her. --}}



  <h1 class="text-5xl mt-3 leading-none font-extrabold text-white tracking-tight mb-4 text-center">
    {{ $this->communityInfo->title }}</h1>


  <div
    class="flex flex-col sm:flex-col sm:mt-2 md:flex-row w-full p-4  m-auto   gap-3 align-center justify-center text-center font-mono">


    <div class="flex h-15 sm:w-full md:w-1/3 ">
      <span class="text-sm  px-4 py-2 bg-gray-300 whitespace-no-wrap rounded-l font-semibold">Max Payout</span>
      <button data-action="decrement"
        class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-15 w-20 focus:outline-none cursor-pointer outline-none">
        <span class="m-auto text-2xl font-thin" wire:click="subMaxPayout">−</span>
      </button>
      <input
        class="h-15 px-4 py-2 w-full outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-sm hover:text-black focus:text-black  sm:text-basecursor-default flex items-center text-gray-700  outline-none"
        type="number" wire:model.lazy="maxPayout" placeholder="Max Payout " />
      <button data-action="increment"
        class="bg-gray-300 text-gray-600 outline-none focus:outline-none hover:text-gray-700 hover:bg-gray-400 h-15 w-20 rounded-r cursor-pointer">
        <span class="m-auto text-2xl font-thin" wire:click="addMaxPayout">+</span>
      </button>
    </div>

    <div class="flex h-15  sm:w-full  md:w-1/3 ">
      <span class="text-sm  px-4 py-2 bg-gray-300 whitespace-no-wrap rounded-l font-semibold">Min Hour</span>
      <button data-action="decrement"
        class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-15 w-20 focus:outline-none cursor-pointer outline-none">
        <span class="m-auto text-2xl font-thin" wire:click="subMaxHour">−</span>
      </button>
      <input
        class="h-15 px-4 py-2 w-full outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-sm hover:text-black focus:text-black  sm:text-basecursor-default flex items-center text-gray-700  outline-none"
        type="number" wire:model.lazy="maxHour" placeholder="Max Hour " />
      <button data-action="increment"
        class="bg-gray-300 text-gray-600 outline-none focus:outline-none hover:text-gray-700 hover:bg-gray-400 h-15 w-20 rounded-r cursor-pointer">
        <span class="m-auto text-2xl font-thin" wire:click="addMaxHour">+</span>
      </button>
    </div>



  </div>


  <ul class="bg-dark grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2">
    @forelse ($this->communityPosts as $item)


      <li
        class="p-4 m-2  bg-white shadow rounded-md {{ $item->payout <= $maxPayout && getMinuteAfterPosted($item->created) >= $maxHour && !in_array('cross-post',$item->json_metadata->tags) ? '' : 'hidden' }} "
        :key='{{ $item->post_id }}'>
        {{-- <a href="" class=""> --}}
        <div class="flex flex-row items-center">
          <img class="w-20 h-20 lazyload" loading="lazy"
            onError="this.onerror=null;this.src='https://www.google.com/images/errors/robot.png';"
            src="{{ isset($item->json_metadata->image[0]) ? $item->json_metadata->image[0] : '' }}"
            alt="Post - {{ $item->post_id }}">
          <div class="flex flex-col mb-1">
            <p class="ml-2 text-gray-700 font-bold font-sans tracking-wide">{{ $item->title }}</p>
            @isset($item->json_metadata->tags)
              <p class="ml-2 font-mono tracking-wide">Tags: #{{ implode(' #', $item->json_metadata->tags) }}</p>
            @endisset
            <p class="ml-2 font-mono tracking-wide"> Payout : {{ $item->payout }} * Posted :
              {{ getMinuteAfterPosted($item->created) }}</p>


          </div>
        </div>
        {{-- </a> --}}
      </li>


      {{-- @break --}}
    @empty
      kosong
    @endforelse
  </ul>





</div>
