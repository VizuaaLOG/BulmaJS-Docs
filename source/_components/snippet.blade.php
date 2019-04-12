<div class="code-snippet {{ isset($classes) ? $classes : '' }} {{ (!isset($example) || $example) ? 'is-example' : '' }}">
    @if(isset($example) && !$example)
        <pre class="{{ isset($language) ? 'language-' . $language : '' }}">
            <code>{{ $slot }}</code>
        </pre>
    @endif
        
    @if(!isset($example) || $example)
        @if(isset($isScript) && $isScript)
            <script>
                // Wrap the script to ensure BulmaJS has loaded
                window.addLoadScript(function() {
                    {{ $slot }}
                });
            </script>
        @else
            {{ $slot }}
        @endif

        <pre class="{{ isset($language) ? 'language-' . $language : 'language-javascript' }}">
            <code>{{ preg_replace('/(.*)\/\/start(.*)\/\/end(.*)/sm', '\2', $slot) }}</code>
        </pre>
    @endif
</div>