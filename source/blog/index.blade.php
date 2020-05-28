@extends('_layouts.blog')

@section('body')
    <section class="hero is-medium is-bold is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    BulmaJS Blog
                </h1>
                <h2 class="subtitle">
                    The single place for news and announcements around BulmaJS
                </h2>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            @foreach($posts as $post)
                <div class="card">
                    <div class="card-content">
                        <p class="title">
                            <a href="{{ $post->getUrl() }}" class="has-text-primary">{{ $post->title }}</a>
                        </p>
                        <p class="subtitle">
                            Published&nbsp;
                            @if(\Carbon\Carbon::parse($post->published_date)->isToday())
                                today
                            @else
                                {{ \Carbon\Carbon::parse($post->published_date)->diffForHumans() }}
                            @endif
                        </p>
                        <p>
                            {{ $post->intro }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection