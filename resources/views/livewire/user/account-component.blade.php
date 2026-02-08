<div>
            @section('title') {{'Your Account'}} @endsection

    <div class="container">
        <div class="col-12">
            <nav class="breadcrumbs">
                <ul>
                    <li><a wire:navigate href="{{ route('home') }}">Home</a></li>
                    <li><span>Your Account</span></li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="container">

        <div class="row">

            <div class="col-lg-4 mb-3">

                <div class="Checkout p-3 h-100 bg-white">

                    <h1 class="section-title h5"><span>Links</span></h1>
                    <ul class="list-unstyled">
                        <li><a wire:navigate href="{{ route('account') }}">Account Overview</a></li>
                        <li><a wire:navigate href="{{ route('change-account') }}">Change Account</a></li>
                        <li><a wire:navigate href="{{ route('orders') }}">Orders</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8 mb-3">

                <div class="cart-content p-3 h-100 bg-white">
                    <h1 class="section-title h5"><span>Account Details</span></h1>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td style="width: 90%;"> {{auth()->user()->name}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{auth()->user()->email}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-end mt-3">
                        <a href="{{ route('change-account') }}" class="btn btn-outline-warning" wire:navigate>Change
                            Account</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
