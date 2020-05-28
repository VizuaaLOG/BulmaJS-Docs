@extends('_layouts.blog')

@section('body')
    <section class="hero is-bold is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ $page->title }}
                </h1>
                <h2 class="subtitle">
                    {{ $page->intro }}
                </h2>
                <p>
                    Published
                    @if(\Carbon\Carbon::parse($page->published_date)->isToday())
                        today
                    @else
                        {{ \Carbon\Carbon::parse($page->published_date)->diffForHumans() }}
                    @endif
                    by {{ $page->author }}
                </p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="content has-background-white">
            @yield('content')
        </div>
    </div>
@endsection
