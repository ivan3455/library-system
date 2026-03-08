<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
            <h3 style="color: #111827; font-size: 1.5rem; margin-bottom: 10px;">
                {{ __('messages.welcome_back') }}, {{ Auth::user()->name }}!
            </h3>
            <p style="color: #6b7280;">{{ __('messages.logged_in_status') }}</p>
            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
            <div style="display: flex; justify-content: center; gap: 20px;">
                <a href="{{ route('books.index') }}" style="color: #4f46e5; text-decoration: none; font-weight: bold;">→ {{ __('messages.view_books') }}</a>
                <a href="{{ route('authors.index') }}" style="color: #4f46e5; text-decoration: none; font-weight: bold;">→ {{ __('messages.view_authors') }}</a>
            </div>
        </div>
    </div>
</x-app-layout>
