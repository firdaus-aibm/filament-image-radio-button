<x-dynamic-component
    :component="$getFieldWrapperView()"
>
    <ul role="list" class="grid gap-8 xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 p-4 relative">
        @foreach ($getOptions() as $value => $image)
            <li class="overflow-hidden relative">
                <label class="relative cursor-pointer block">
                    <input
                        id="{{ $getId() }}-{{ $value }}"
                        name="{{ $getId() }}"
                        type="radio"
                        value="{{ $value }}"
                    {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
                    class="rb-image"
                    />
                    <span class="img-radio-selected absolute"></span>
                    <div class="img-radio">
                        <img
                            src="{{ asset($getDisk()->url('')) }}{{ $image }}"
                            alt="{{ $value }}"
                            class="w-full h-[300px] cursor-pointer object-contain"
                        />
                    </div>
                </label>
            </li>
        @endforeach
    </ul>
</x-dynamic-component>

<style>
    /* Common styles for both directions */
    input[name="{{ $getId() }}"]:checked + .img-radio-selected {
        background-color: rgba(var(--primary-500),var(--tw-bg-opacity));
        transform: rotate(0.8648rad);
        width: 110px;
        height: 60px;
        position: absolute;
        top: -10px;
        z-index: 99999;
    }

    /* RTL specific positioning (right corner) */
    [dir="rtl"] input[name="{{ $getId() }}"]:checked + .img-radio-selected {
        right: -40px;
        left: auto;
    }

    /* LTR specific positioning (left corner) */
    [dir="ltr"] input[name="{{ $getId() }}"]:checked + .img-radio-selected,
    html:not([dir="rtl"]) input[name="{{ $getId() }}"]:checked + .img-radio-selected {
        left: -40px;
        right: auto;
        transform: rotate(-0.8648rad); /* Flip the rotation for LTR */
    }

    input[name="{{ $getId() }}"]:checked ~ .img-radio {
        border: 3px solid rgba(var(--primary-500),var(--tw-bg-opacity));
    }

    input[name="{{ $getId() }}"]:checked ~ .img-radio {
        border: 3px solid rgba(var(--primary-500),var(--tw-bg-opacity));
    }

    input[name="{{ $getId() }}"]:checked ~ .img-radio {
        border: 3px solid rgba(var(--primary-500),var(--tw-bg-opacity));
    }

    /* ...except the one whose radio is checked */
    input[name="{{ $getId() }}"]:checked ~ .img-radio img {
        filter: none;
        opacity: 1;
    }

    .rb-image {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .img-radio {
        border: 1px solid #dee2e6;
        max-width: 100%;
        border-radius: 15px;
        cursor: pointer;
        display: block;
        height: auto;
        margin: auto;
        padding: 5px;
        position: relative;
        width: 100%;
        transition: border 0.2s ease;
    }

    .img-radio:hover img {
        -o-object-position: bottom;
        object-position: bottom;
    }

    .img-radio img {
        height: auto;
        max-height: 300px;
        -o-object-fit: contain;
        object-fit: contain;
        -o-object-position: center;
        object-position: center;
        transform-origin: 50% 50%;
        transition-duration: .1s;
        transition: all 1s ease;
        width: 100%;
        border-radius: inherit;
        filter: none;
        opacity: 1;
        transition: filter 0.2s, opacity 0.2s;
    }

    .overflow-hidden {
        overflow: hidden;
    }

    /* When a radio is selected, grey out all images */
    ul.has-selected .img-radio img {
        filter: grayscale(1);
        opacity: 0.7;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const radioButtons = document.querySelectorAll('input[type="radio"][name="{{ $getId() }}"]');
    const ul = document.querySelector('ul[role="list"]');

    function updateGreyScale() {
        // Check if any radio is selected
        const checked = Array.from(radioButtons).find(rb => rb.checked);
        if (checked) {
            ul.classList.add('has-selected');
        } else {
            ul.classList.remove('has-selected');
        }
    }

    radioButtons.forEach(rb => {
        rb.addEventListener('change', updateGreyScale);
    });

    // Initial check
    updateGreyScale();
});
</script>
