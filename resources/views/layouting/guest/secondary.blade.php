<!DOCTYPE html>
<html>

<head>
    @include('layouting.guest._partials.headers')
</head>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="{{ asset('assets\guest\vendors\images\Peron.png') }}" alt="" width="200"
                    height="200"></div>

            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">
                Loading...
            </div>
        </div>
    </div>


    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                @yield('content')


                @include('layouting.guest._partials.footer')
            </div>
        </div>
    </div>

    @include('layouting.guest._partials.scripts')
</body>

</html>
