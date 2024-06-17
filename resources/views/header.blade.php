<header class="bg-dark text-light p-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            @auth
                @if(auth()->user()->roll_id == 1)
                    <a href="#" class="btn btn-light">🏠</a>
                    <h1>Admin Dashboard</h1>
                @else
                    <a href="#" class="btn btn-light">🏠</a>
                    <h1>User Dashboard</h1>
                @endif

                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</header>
