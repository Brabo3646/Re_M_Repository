<x-app-layout>
    <x-slot name="title">
        Re_M New Avatar
    </x-slot>
    <x-slot name="stylesheet">
        style.css
    </x-slot>
    <x-slot name="header">
        Re_M アバターを作成
    </x-slot>
    <main>
    <p>
    デッキを共有するためには、オンライン上でのあなたのプロフィールであるアバターの作成が必須です。   
    </p>
    <form method = "POST" action="{{ route('avatar.create',$route)}}">
        @csrf
        <div>
            <label>
                アバターの名前
                <input type = "text" name = "avatar_name" value = "{{ old('avatar_name') }}">
            </label>
            @error('avatar_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>
                アバターのID（ほかの人があなたのアバターを検索する際に必要です）
                <input type = "text" name = "avatar_ID" value = "{{ old('avatar_ID') }}">
            </label>
            @error('avatar_ID')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>
                自己紹介文（省略可）
                <textarea name = "introduce">{{ old('introduce') }}</textarea>
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
    </main>
    <body></body>
    
</x-app-layout>