@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-weight-bold text-danger">
            {{ __('Login Gagal') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
