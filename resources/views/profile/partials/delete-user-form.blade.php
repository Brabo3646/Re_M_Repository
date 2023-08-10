<section class="space-y-6">
    <header>
        <h2>
            アカウントの削除
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            一度アカウントを削除すると、アカウントに紐づいたあらゆるデータが永久に削除されます。</br>
            必要なデータはダウンロードを済ませておいてください。
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >アカウントを削除</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2>
                本当にアカウントを削除しますか？
            </h2>

            <p>
                一度アカウントを削除すると、アカウントに紐づいたあらゆるデータが永久に削除されます。</br>
                それでも宜しければ、アカウントのパスワードを入力してください。
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="アカウントのパスワード"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    キャンセル
                </x-secondary-button>
                <x-danger-button>
                    アカウントを削除
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
