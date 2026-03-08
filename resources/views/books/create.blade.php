<x-app-layout>
    <style>
        .form-container { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-width: 600px; margin: 2rem auto; }
        .form-group { margin-bottom: 1.5rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: bold; color: #374151; font-size: 0.9rem; }
        input[type="text"], input[type="number"], select { width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; font-family: sans-serif; }
        .btn-save { background-color: #111827; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.2s; }
        .btn-save:hover { background-color: #374151; }
        .btn-cancel { color: #6b7280; text-decoration: none; margin-left: 1rem; font-size: 0.9rem; }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.add_new_book') }}
        </h2>
    </x-slot>

    <div class="form-container">
        <form method="POST" action="{{ route('books.store') }}">
            @csrf

            <div class="form-group">
                <label for="author_id">{{ __('messages.select_author') }}</label>
                <select name="author_id" id="author_id" required>
                    <option value="">-- {{ __('messages.choose') }} --</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('author_id') <span style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="title">{{ __('messages.book_title') }}</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                @error('title') <span style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}" required>
                @error('isbn') <span style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="published_year">{{ __('messages.published_year') }}</label>
                <input type="number" id="published_year" name="published_year" value="{{ old('published_year') }}" required>
                @error('published_year') <span style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div style="display: flex; align-items: center;">
                <button type="submit" class="btn-save">{{ __('messages.save') }}</button>
                <a href="{{ route('books.index') }}" class="btn-cancel">{{ __('messages.cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
