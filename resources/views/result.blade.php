@extends('layout.master')
@section('content')
<nav class="level is-mobile">
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Total Available Slugs</p>
        <p class="title">
        @if (session('slugs'))
              {{ count(session('slugs')) }}
           @else
             0
        @endif
      </p>
    </div>
  </div>
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Total Slugs Not Matched</p>
        <p class="title">
        @if (session('broken_slugs'))
              {{ count(session('broken_slugs')) }}
           @else
             0
        @endif
      </p>
    </div>
  </div>

@if (session('processed_slugs'))
  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Total Slugs Fixed</p>
        <p class="title">
       @if (session('processed_slugs')['fixed'])
          {{ count(session('processed_slugs')['fixed']) }}
       @else
          0
      @endif
      </p>
    </div>
  </div>

  <div class="level-item has-text-centered">
    <div>
      <p class="heading">Total Slugs Cant Be Fixed</p>
        <p class="title">
       @if (session('processed_slugs')['not_fixed'])
          {{ count(session('processed_slugs')['not_fixed']) }}
         @else
          0
      @endif
      </p>
    </div>
  </div>
@endif

</nav>

<hr>
<div class="notification">
  <h3>Total Slugs Not Matched</h3>
</div>
<div class="content">
<p>
  <ol>
    @if (session('broken_slugs'))
            @foreach (session('broken_slugs') as $broken_slug)
              <li>{{$broken_slug}}</li>
            @endforeach
    @endif
  </ol>
</p>
</div>

@if (session('processed_slugs'))
<hr>
<div class="notification">
  <h3>Total Slugs Fixed</h3>
</div>
<div class="content">
<p>
  <ol>
    @if (session('processed_slugs')['fixed'])
            @foreach (session('processed_slugs')['fixed'] as $slug_fixed)
              <li>{{$slug_fixed}}</li>
            @endforeach
    @endif
  </ol>
</p>
</div>


<hr>
<div class="notification">
  <h3>Total Slugs Cant Be Fixed</h3>
</div>
<div class="content">
<p>
  <ol>
    @if (session('processed_slugs')['not_fixed'])
            @foreach (session('processed_slugs')['not_fixed'] as $slug_not_fixed)
              <li>{{$slug_not_fixed}}</li>
            @endforeach
    @endif
  </ol>
</p>
</div>
@endif


@endsection