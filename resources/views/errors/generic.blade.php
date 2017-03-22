<html>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @include('errors.styles')
</html>
<body class="bg-gradient">
    <div class="error-wrapper">
        <div class="error-container">

            <div class="error-header">
                Error
            </div>

            @if (empty($message))

            <div class="error-content">
                An error has occurred.<br />
                Let's go somewhere.
            </div>

            @else

            <div class="error-content" style="text-align: center;">
                {!! $message !!}
            </div>

            @endif

            {{-- ############################################################################# --}}
            @if (env('APP-ENV') === 'local' && isset($e))
            <div class="error-content" style="text-align: left;">
                @if (isset($message))
                <div style="padding: 10px; padding-top: 30px; color: #ec0f0f;">
                    {!! $message !!}
                </div>
                @endif

                {!! dump($e) !!}
            </div>
            @endif
            {{-- ############################################################################# --}}

            <div class="error-buttons">
                <a class="btn" onclick="window.history.back()">Go back</a>
                <div class="inline-string">or</div>
                <a class="btn" href="/">Show mainpage</a>
            </div>

        </div>
    </div>
</body>