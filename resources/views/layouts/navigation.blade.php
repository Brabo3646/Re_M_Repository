<link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
<nav x-data="{ open: false }" class="bg-blue-500 border-b border-blue-500">
    <!-- ナビゲーションメニュー -->
    <div class="nav">
        <div class="nav-top">
            <!--ロゴの表示 -->
            <div class="logo-space">
                <a href="{{ route('user.home') }}">
                    <img src="{{ asset('/logo/Re_M_Logo.png') }}" class="logo">
                </a>
            </div>
            <!--名前の表示-->
            <div class="nameplate">
                ようこそ<a href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a>さん
            </div>
            <div id="logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <button id="logout-btn">ログアウト</button> 
                    </x-dropdown-link>
                </form>
            </div>
            <div>
                <img src="{{ asset('/logo/menu.png') }}" id="menu">
            </div>
        </div>
        <!--各リンク -->
        <div class=linkspace>
            <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <button id="smartphone-logout-btn" class="link-btn">ログアウト</button> 
                    </x-dropdown-link>
                </form>
            <img src="{{ asset('/logo/close.png') }}" id="close">
            
            <a href="{{ route('deck.newdeck')}}">
                <button class="link-btn">新しいデッキ</button>
            </a>
            <a href="{{ route('deck.check.list')}}">
                <button class="link-btn">デッキ一覧</button>
            </a>
            <a href="{{ route('deck.answer.list')}}">
                <button class="link-btn">クイズを解く！</button>
            </a>
        </div>
    </div>
</nav>
<script src="{{ asset('js/navigation.js') }}"></script>
