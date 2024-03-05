@if ($paginator->hasPages())

	<ul class="pagination m-0 ms-auto">
		{{-- Previous Page Link --}}
	  <li class="page-item {{$paginator->onFirstPage()?'disabled':''}}">
	    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-disabled="true">
	      <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
	      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="15 6 9 12 15 18"></polyline></svg>
	      prev
	    </a>
	  </li>
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true">
                    	<a class="page-link" href="#">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                            	<a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach


	  {{-- Next Page Link --}}
	  <li class="page-item {{$paginator->hasMorePages()?'':'disabled'}}">
	    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
	      next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
	      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg>
	    </a>
	  </li>
	</ul>


@endif
