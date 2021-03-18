<div>
  {{-- The whole world belongs to you --}}

  <div>
    <h1 class="text-5xl mt-3 leading-none font-extrabold text-white tracking-tight mb-4 text-center"><a href="/"
        class="">Find Content By
        Tags</a></h1>
  </div>
  <div class="container flex items-center ">
    <div class="relative text-center m-auto">
      <div class="absolute top-4 left-3"> <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i> </div>
      <input type="text" wire:keydown.enter="searchTag()" wire:model.defer="selectedTags"
        class="h-14 w-96 pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none" placeholder="Search anything...">
      <div class="absolute top-2 right-2"> <button class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
          wire:click="searchTag">Search</button> </div>
    </div>

  </div>

  <div wire:loading class="w-full h-full fixed block top-0 left-0 bg-white opacity-75 z-50">
    <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0" style="
      top: 50%;  ">
      <i class="fas fa-circle-notch fa-spin fa-5x"></i>
    </span>
  </div>



  <span class="flex flex-col items-center justify-center" style="height:calc(100% - 60px);">
    <atom-spinner :animation-duration="1000" :size="160" :color="'#1f6492'" />
  </span>
  <ul class="bg-dark grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2">


    @forelse ($tagPosts as $item)
      @isset($item->payout)
        <li
          class="p-4 m-2  bg-white shadow rounded-md {{ $item->payout <= $maxPayout && getMinuteAfterPosted($item->created) >= $maxHour ? '' : 'hidden' }} "
          :key='{{ $item->post_id }}' data-clipboard-text="https://peakd.com{{ $item->url }}">
          {{-- <a href="" class=""> --}}
          <div class="flex flex-row items-center">
            <div class="flex flex-1 flex-none flex-col ">
              @isset($item->json_metadata->image)
                @if (is_array($item->json_metadata->image))
                  <img class="lazy w-20 h-20"
                    onError="this.onerror=null;this.src='https://www.google.com/images/errors/robot.png';"
                    data-src="{{ isset($item->json_metadata->image[0]) ? 'https://images.hive.blog/80x80/' . $item->json_metadata->image[0] : 'https://images.hive.blog/u/' . $item->author . '/avatar/small' }}"
                    src="{{ isset($item->json_metadata->image[0]) ? 'https://images.hive.blog/80x80/' . $item->json_metadata->image[0] : '' }}">
                @endif
              @endisset






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
                    <img width="20px" height="20px"
                      src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTMgMTJsLS42ODgtNGgtLjYwOWwtLjcwMyA0Yy0uNTk2LjM0Ny0xIC45ODQtMSAxLjcyMyAwIDEuMTA0Ljg5NiAyIDIgMnMyLS44OTYgMi0yYzAtLjczOS0uNDA0LTEuMzc2LTEtMS43MjN6bS0xLThjLTUuNTIyIDAtMTAgNC40NzctMTAgMTBzNC40NzggMTAgMTAgMTAgMTAtNC40NzcgMTAtMTAtNC40NzgtMTAtMTAtMTB6bTAgMThjLTQuNDExIDAtOC0zLjU4OS04LThzMy41ODktOCA4LTggOCAzLjU4OSA4IDgtMy41ODkgOC04IDh6bS0yLTE5LjgxOXYtMi4xODFoNHYyLjE4MWMtMS40MzgtLjI0My0yLjU5Mi0uMjM4LTQgMHptOS4xNzkgMi4yMjZsMS40MDctMS40MDcgMS40MTQgMS40MTQtMS4zMjEgMS4zMjFjLS40NjItLjQ4NC0uOTY0LS45MjYtMS41LTEuMzI4eiIvPjwvc3ZnPg==">
                  </div>
                  <div class="ml-1">{{ getMinuteAfterPosted($item->created) }}</div>

                </div>
                @isset($item->community)
                  <div class="flex flex-row p-1 border-grey-500 items-center text-center">
                    <div class="w-5 h-5 rounded-full text-white bg-purple-800 self-center items-center text-center h-auto">
                      Posted
                    </div>
                    <div class="ml-1">
                      <a href="{{ $selectedServer . 'c/' . $item->community }}" class="" target="_blank">
                        {{ $item->community_title }}</a>
                    </div>
                  </div>
                @endisset

              </div>





            </div>


          </div>
          {{-- </a> --}}
        </li>
      @endisset








      {{-- @break --}}
    @empty
      {{-- kosong --}}
    @endforelse
  </ul>

  @if (count($tagPosts) > 0)

    <div class="container flex items-center pt-5 ">
      <button class="h-10 w-full p-2 text-white rounded-lg bg-red-500 hover:bg-red-600" wire:click="loadMore">Load
        More</button>

    </div>
  @endif



</div>
