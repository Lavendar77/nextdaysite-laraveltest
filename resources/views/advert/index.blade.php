<x-layout>
    <x-slot name="title">
        Advert Upload System
    </x-slot>

    <div class="grid">
        <div class="p-6">
            <h3>Advert Upload System</h3>
            <p class="text-notice">
                A collection of various adverts.
            </p>

            @if ($adverts->count())
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <td width="80%"></td>
                            <td title="Impressions (Views)">👁</td>
                            <td colspan="2"></td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($adverts as $advert)
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <img
                                        src="{{ $advert->getFirstMedia()->getUrl('thumb') }}"
                                        alt="{{ $advert->id }}"
                                        class="rounded thumb"
                                    />
                                    <span class="ml-2">
                                        {{ $advert->getFirstMedia()->name }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                {{ $advert->impressions }}
                            </td>
                            <td>
                                <a href="{{ route('adverts.show', ['advert' => $advert]) }}" class="btn small">Show</a>
                            </td>
                            <td>
                                <form action="{{ route('adverts.destroy', ['advert' => $advert]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger small">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $adverts->links() }}
            </div>
            @endif

            <hr>

            <h5 class="text-notice">Upload an advert image.</h5>
            <form action="{{ route('adverts.store') }}" method="POST" class="form" enctype="multipart/form-data">
                @csrf

                <input
                    type="file"
                    name="advert"
                    accept="image/*"
                    required
                >

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <x-return-home />
</x-layout>
