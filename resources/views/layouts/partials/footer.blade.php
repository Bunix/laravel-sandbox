<footer class="widewrapper footer">
    <div class="container">
        <div class="row footer">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-3">
                <div class="indent30">
                    <h4>Recent News</h4>
                    <ul class="grove-list">
                        <li><a href="#">Hello World</a></li>
                        <li><a href="#">Foobar in the sky flying so high</a></li>
                        <li><a href="#">Wild things happening, all around</a></li>
                        <li><a href="#">No time for that, no time for that</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-3">
                <h4></h4>
                <p></p>
            </div>

            <div class="col-sm-3">
                <h4>Connect</h4>
                <a href="#" class="social facebook"></a>
                <a href="#" class="social twitter"></a>
                <a href="#" class="social google_plus"></a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            <p>&copy; <?= date('Y'); ?>, All Rights Reserved. </p>
        </div>
    </div>

    <!-- Google Analytics Partial -->
    @if (App::environment() != 'development')
        @include('layouts.partials.googleanalytics')
    @endif
</footer>