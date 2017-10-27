                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/foundation.min.js') }}"></script>
    <script src="{{ URL::asset('js/app.js') }}"></script>

    <script>
        // initialize Foundation 
        $(document).foundation();
        // add custome javascript
        @yield('javascript')
    </script>
</body>
</html>
