<x-app-layout>
    <x-slot name="title">
        Re_M 新しいグループ
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M 新しいグループの作成
    </x-slot>
    <form method = "POST" action="{{ route('group.create')}}">
        @csrf
        <div>
            <label>
                グループの名前
                <input type = "text" name = "group_name" value = "{{ old('group_name') }}">
            </label>
            @error('group_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class = "form-group">
            <label>
                グループの説明
                <textarea name = "description">{{ old('description') }}</textarea>
            </label>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class = "form-button">
            <input type="submit" value="作成">
        </div>
    </form>
</x-app-layout>