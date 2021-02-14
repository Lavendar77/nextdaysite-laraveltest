<x-layout>
    <x-slot name="title">
        Advert [{{ $advert->getFirstMedia()->name }}]
    </x-slot>

    <div class="grid">
        <div class="p-6">
            <div class="text-right">
                <a href="{{
                    url()->previous() == url()->current()
                    ? route('adverts.index')
                    : url()->previous()
                }}">⬅ Back</a>
            </div>
            <div class="flex items-center sm:justify-between">
                <h3>{{ $advert->getFirstMedia()->name }}</h3>
                <span>
                    👁 {{ $advert->impressions }}
                    <br>
                </span>
            </div>

            <div>
                <img
                    src="{{ $advert->getFirstMediaUrl('default') }}"
                    alt="{{ $advert->id }}"
                    width="100%"
                />
            </div>
        </div>
    </div>

    <x-return-home />
</x-layout>
