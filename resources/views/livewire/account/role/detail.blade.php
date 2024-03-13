<form wire:submit="store">
    <div class='row'>
        <div class="col-md-12 mb-4">
            <label>Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.blur="name" />

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        @foreach ($accesses as $keyAccess => $access)
            <div class="col-md-4 mb-2" wire:key='access_{{ $keyAccess }}'>
                <div class='card'>
                    <div class='card-body'>
                        <div class='fw-bold'>
                            {{ $access['name'] }}
                        </div>
                        <hr>
                        @foreach ($access['permissions'] as $keyPermission => $permission)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="1"
                                    id="permission_{{ $keyAccess }}_{{ $keyPermission }}"
                                    wire:model='accesses.{{ $keyAccess }}.permissions.{{ $keyPermission }}.is_checked'>
                                <label class="form-check-label" for="permission_{{ $keyAccess }}_{{ $keyPermission }}">
                                    {{ $permission['translated_name'] }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-success mt-3">
        <i class='ki-duotone ki-check fs-1'></i>
        Save
    </button>
</form>
