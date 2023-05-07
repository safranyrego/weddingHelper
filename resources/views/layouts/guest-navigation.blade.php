<div class="fixed top-0 left-0 px-6 py-4">
    @if (app()->isLocale('en'))
    <form method="POST" action="{{ route('locale', ['locale' => 'hu']) }}" class="inline-block">
        @csrf

        <a
            href="route('locale', ['locale' => 'hu'])"
            onclick="event.preventDefault();
                this.closest('form').submit();"
            class="text-sm text-gray-700 dark:text-gray-500 underline"
        >
            {{ __('navigation.locale.hu') }}
        </a>
    </form>
    @else
    <form method="POST" action="{{ route('locale', ['locale' => 'en']) }}" class="inline-block">
        @csrf

        <a 
            href="route('locale', ['locale' => 'en'])"
            onclick="event.preventDefault();
                this.closest('form').submit();"
            class="text-sm text-gray-700 dark:text-gray-500 underline"
        >
        {{ __('navigation.locale.en') }}
        </a>
    </form>
    @endif
    <a href="#" x-show="!darkMode" x-on:click="close(); darkMode = !darkMode" onclick="event.preventDefault();" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
        {{ __('navigation.mode.dark') }}
    </a>
    <a href="#" x-show="darkMode" x-on:click="close(); darkMode = !darkMode" onclick="event.preventDefault();" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
        {{ __('navigation.mode.light') }}
    </a>
</div>
<div class="fixed top-0 right-0 px-6 py-4">
    @auth
        <a href="{{ url('/dashboard') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
            {{ __('navigation.dashboard') }}
        </a>
    @else
        <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
            {{ __('navigation.login') }}
        </a>
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">
            {{ __('navigation.register') }}
        </a>
    @endauth
</div>