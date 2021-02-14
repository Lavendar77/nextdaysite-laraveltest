<x-layout>
    <x-slot name="title">
        API Search
    </x-slot>

    <div class="grid">
        <div class="p-6">
            <h3>API Search</h3>
            <p class="text-notice">
                This only explains how the API works. More like a mini-"route"-documentation.
            </p>
            <span class="text-sm">
                <ul>
                    <li>
                        Visit: <code>{{ route('api.users') }}</code>
                    </li>
                    <li>This will list all the users in the database.</li>
                    <li>
                        To perform a search:
                        <br>
                        <code>{{ route('api.users', ['search' => 'text']) }}</code>
                    </li>
                    <li>
                        Search applies directly to a non-strict:
                        <ul>
                            <li>First name</li>
                            <li>Last name</li>
                            <li>Email</li>
                            <li>Telephone</li>
                        </ul>
                    </li>
                </ul>
            </span>

            <hr>

            <h5 class="text-notice">Perform a search directly from the UI</h5>
            <form action="{{ route('api.users') }}" method="GET" class="form" target="__blank">
                <input
                    type="text"
                    name="search"
                    placeholder="Search users by first name, last name, email, telephone"
                    required
                >

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <x-return-home />
</x-layout>
