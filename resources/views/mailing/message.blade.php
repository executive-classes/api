<header>
    @empty($header)
        @include('mailing.templates.header')
    @else
        {!! $header->content !!}
    @endempty
</header>
<main>
    {!! $content !!}
</main>
<footer>
    @empty($footer)
        @include('mailing.templates.footer')
    @else
        {!! $footer->content !!}
    @endempty
</footer>