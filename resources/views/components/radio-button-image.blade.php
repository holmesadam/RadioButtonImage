<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $id = $getId();
        $isDisabled = $isDisabled();
        $statePath = $getStatePath();
    @endphp

    <ul role="list" class="grid gap-8 xl:grid-cols-4 lg:grid-cols-3">
        @foreach ($getOptions() as $value => $image)
            @php
                $shouldOptionBeDisabled = $isDisabled || $isOptionDisabled($value, $image);
            @endphp
            <li class="overflow-hidden">
                <label class="relative">
                    <input
                        @disabled($shouldOptionBeDisabled)
                        id="{{ $id }}-{{ $value }}"
                        name="{{ $id }}"
                        type="radio"
                        value="{{ $value }}"
                        wire:loading.attr="disabled"
                        {{ $applyStateBindingModifiers('wire:model') }}="{{ $statePath }}"
                        class="rb-image"
                    />
                    <div class="img-radio">
                        <img src="{{ asset(config('radiobuttonimage.storageName')) }}/{{ $image }}" alt="{{ $value }}" class="focus:bg-primary-500 cursor-pointer">
                    </div>
                </label>
            </li>
        @endforeach
    </ul>
</x-dynamic-component>

<style>
input[name="{{ $id }}"]:checked + .img-radio {
    border: 2px solid rgba(var(--primary-600),var(--tw-bg-opacity));
    transition: all 0.3s ease;
}

.rb-image {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.img-radio {
    border: 2px solid transparent;
    max-width: 100%;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    height: auto;
    margin: auto;
    padding: 2px;
    position: relative;
    width: 100%;
}

.img-radio img {
    width: 200px;
    height: 200px;
}

.overflow-hidden {
    overflow: hidden;
}
</style>
