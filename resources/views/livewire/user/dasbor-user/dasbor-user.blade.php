<div>

@if(Auth::check())
    <p>Welcome, {{ Auth::user()->name }}!</p>
@else
    <p>You are not logged in.</p>
@endif

    <x-card>
        <h1>Welcome User</h1>
    </x-card>

</div>
