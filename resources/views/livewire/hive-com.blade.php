<div>
  {{-- Because she competes with no one, no one can compete with her. --}}



  <h1 class="text-5xl mt-3 leading-none font-extrabold text-white tracking-tight mb-4 text-center">
    <a href="/" class=""> {{ $this->communityInfo->title }}</a>
  </h1>


  <div
    class="flex flex-col sm:flex-col sm:mt-3 mt-5 md:flex-row w-full p-4 m-auto  sm:gap-3 lg:gap-10  gap-3 align-center justify-center text-center font-mono">


    <div class="flex h-15 sm:w-full md:w-1/3 ">
      <span class="text-sm  px-4 py-2 bg-gray-300 whitespace-no-wrap rounded-l font-semibold">Max Payout</span>
      <button data-action="decrement"
        class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-15 w-20 focus:outline-none cursor-pointer outline-none">
        <span class="m-auto text-2xl font-thin" wire:click="subMaxPayout">−</span>
      </button>
      <input
        class="h-15 px-4 py-2 w-full outline-none focus:outline-none text-center w-full bg-gray-300 font-semibold text-sm hover:text-black focus:text-black  sm:text-basecursor-default flex items-center text-gray-700  outline-none"
        type="number" wire:model="maxPayout" placeholder="Max Payout " />
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
        type="number" wire:model="maxHour" placeholder="Max Hour " />
      <button data-action="increment"
        class="bg-gray-300 text-gray-600 outline-none focus:outline-none hover:text-gray-700 hover:bg-gray-400 h-15 w-20 rounded-r cursor-pointer">
        <span class="m-auto text-2xl font-thin" wire:click="addMaxHour">+</span>
      </button>
    </div>

    <div class="flex h-15  sm:w-full  md:w-1/3 ">
      <button data-action="increment"
        class="bg-gray-300 w-full text-gray-600 outline-none focus:outline-none hover:text-gray-700 hover:bg-gray-400 h-15 w-20 rounded cursor-pointer">
        <span class="m-auto text-2xl font-thin" wire:click="addMoreData">Add 100</span>
      </button>
    </div>



  </div>


  <ul class="bg-dark grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2">
    @forelse ($this->communityPosts as $item)

      @php
        $isCrossPost = false;
        if (isset($item->json_metadata->tags)) {
            // implode('#', $item->json_metadata->tags);
            if (in_array('cross-post', $item->json_metadata->tags)) {
                $isCrossPost = true;
            }
        }
      @endphp


      <li
        class="p-4 m-2  bg-white shadow rounded-md {{ $item->payout <= $maxPayout && getMinuteAfterPosted($item->created) >= $maxHour ? '' : 'hidden' }} "
        :key='{{ $item->post_id }}' data-clipboard-text="https://peakd.com{{ $item->url }}">
        {{-- <a href="" class=""> --}}
        <div class="flex flex-row items-center">
          <div class="flex flex-1 flex-none flex-col ">
            <img class="lazy w-20 h-20"
              onError="this.onerror=null;this.src='https://www.google.com/images/errors/robot.png';"
              data-src="{{ isset($item->json_metadata->image[0]) ? 'https://images.hive.blog/80x80/' . $item->json_metadata->image[0] : 'https://images.hive.blog/u/' . $item->author . '/avatar/small' }}"
              src="{{ isset($item->json_metadata->image[0]) ? 'https://images.hive.blog/80x80/' . $item->json_metadata->image[0] : '' }}">




            <button
              class="copy font-mono mt-2 w-full text-sm text-white ml-auto flex-none rounded p-0 bg-green-700 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50"
              data-clipboard-text="https://peakd.com{{ $item->url }}">
              Copy Url
            </button>

          </div>



          <div class="flex flex-5 flex-col mb-auto">
            <p class="ml-2 text-gray-700 font-bold font-sans tracking-wide font-mono">
              <a href="https://peakd.com{{ $item->url }}" target="_blank">{{ $item->title }}</a>
            </p>


            <div class="flex flex-row  flex-wrap ml-2 mb-0 font-mono tracking-wide pt-3 text-gray-500 ">

              <div class="author flex flex-row p-1 border-grey-500 items-center">
                <img class="w-5 h-5 rounded-full lazy centered loaded"
                  data-src="https://images.hive.blog/u/{{ $item->author }}/avatar/small"
                  src="https://images.hive.blog/u/{{ $item->author }}/avatar/small" data-ll-status="loaded">

                <a href="https://peakd.com/@{{ $item->author }}" class="ml-1" target="_blank">
                  {{ $item->author }}</a>
              </div>

              <div class="flex flex-row p-1 border-grey-500 items-center text-center">
                <div class="w-5 h-5 rounded-full text-white bg-red-800 self-center items-center text-center h-auto">
                  $
                </div>
                <div class="ml-1">
                  {{ $item->payout }}
                </div>
              </div>
              <div class="flex flex-row p-1 border-grey-500 ml-0">
                <div class="w-5 h-5 rounded-full lazy centered loaded">
                  <img
                  width="20px" height="20px"
                    src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTMgMTJsLS42ODgtNGgtLjYwOWwtLjcwMyA0Yy0uNTk2LjM0Ny0xIC45ODQtMSAxLjcyMyAwIDEuMTA0Ljg5NiAyIDIgMnMyLS44OTYgMi0yYzAtLjczOS0uNDA0LTEuMzc2LTEtMS43MjN6bS0xLThjLTUuNTIyIDAtMTAgNC40NzctMTAgMTBzNC40NzggMTAgMTAgMTAgMTAtNC40NzcgMTAtMTAtNC40NzgtMTAtMTAtMTB6bTAgMThjLTQuNDExIDAtOC0zLjU4OS04LThzMy41ODktOCA4LTggOCAzLjU4OSA4IDgtMy41ODkgOC04IDh6bS0yLTE5LjgxOXYtMi4xODFoNHYyLjE4MWMtMS40MzgtLjI0My0yLjU5Mi0uMjM4LTQgMHptOS4xNzkgMi4yMjZsMS40MDctMS40MDcgMS40MTQgMS40MTQtMS4zMjEgMS4zMjFjLS40NjItLjQ4NC0uOTY0LS45MjYtMS41LTEuMzI4eiIvPjwvc3ZnPg==">
                </div>
                <div class="ml-1">{{ getMinuteAfterPosted($item->created) }}</div>

              </div>

            </div>





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
