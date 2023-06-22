    @if (Auth::user()->my_favorite($micropost->id))
        {{-- お気に入り外すボタン --}}
        <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" 
                onclick="return confirm('id = {{ $micropost->id }} のお気に入りを外します。よろしいですか？')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#e65c5c" viewBox="0 0 24 24" stroke-width="0" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg＞
            </button>
        </form>
    @else
        {{--お気に入りボタン--}}
        <form method="POST" action="{{ route('favorites.favorite', $micropost->id) }}">
            @csrf
            <button type="submit" >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </button>
        </form>
    @endif
