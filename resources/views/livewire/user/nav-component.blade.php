    <div class="header-top-account d-flex justify-content-end">
        <div class="btn-group me-2">
            <div class="dropdown">
                <button class="btn btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Account
                </button>
                <ul class="dropdown-menu">
                    @guest
                        <li>
                            <a class="dropdown-item" href="{{  route('login') }}" wire:navigate>Login</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{  route('register') }}" wire:navigate>Register</a>
                        </li>
                    @endguest
                    
                    @auth

                        <li>
                            <a class="dropdown-item" href="#">My Profile</a>
                        </li>
                        @if (auth()->user()->is_admin)

                            <li>
                                <a class="dropdown-item" href="#">Dashboard</a>
                            </li>
                        @endif

                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @endauth

                   
                </ul>
            </div>
        </div>
    </div>
    <!-- ./header-top-account -->
