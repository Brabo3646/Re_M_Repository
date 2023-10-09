<x-app-layout>
    <x-slot name="title">
        Re_M Avatar Update
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M アバター設定変更
    </x-slot>
    <x-slot name="slot">
        <h1>ここではアバターのプロフィールを更新できます。</h1>
        <form method = "POST" action="{{ route('avatar.update')}}">
        @csrf
        <div>
            <label>
                アバターの名前
                <input type = "text" name = "avatar_name" value = "{{ $avatar->avatar_name }}">
            </label>
            @error('avatar_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>
                アバターのID（ほかの人があなたのアバターを検索する際に必要です）
                <input type = "text" name = "avatar_ID" value = "{{ $avatar->avatar_ID }}">
            </label>
            @error('avatar_ID')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>
                自己紹介文（省略可）
                <textarea name = "introduce">{{ $avatar->introduce }}</textarea>
            </label>
            @error('introduce')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input type="checkbox" name="searchable" value="able">
            <label for="searchable">名前での検索を許可する</label>
        </div>
        
        <div class = "form-button">
            <input type="submit" value="作成">
        </div>
    </form>
    </x-slot>
</x-app-layout>