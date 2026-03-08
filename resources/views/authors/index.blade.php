<x-app-layout>
    <style>
        .content-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; }
        th { background-color: #f8f9fa; color: #333; font-size: 0.9rem; text-transform: uppercase; }
        .btn-add { background: #4f46e5; color: white; padding: 8px 16px; text-decoration: none; border-radius: 5px; font-size: 0.9rem; }
        .action-links a { color: #4f46e5; text-decoration: none; margin-right: 10px; font-weight: bold; }
        .btn-delete { background: none; border: none; color: #ef4444; cursor: pointer; font-weight: bold; padding: 0; }
        .alert-success { background: #ecfdf5; color: #065f46; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #a7f3d0; }
    </style>

    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="margin: 0;">{{ __('messages.authors') }}</h2>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('authors.create') }}" class="btn-add">+ {{ __('messages.add_author') }}</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12" style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
        <div class="content-container">
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.bio') }}</th>
                        @if(Auth::user()->role === 'admin')
                            <th>{{ __('messages.actions') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{{ Str::limit($author->bio, 50) }}</td>
                            @if(Auth::user()->role === 'admin')
                                <td class="action-links">
                                    <a href="{{ route('authors.edit', $author) }}">{{ __('messages.edit') }}</a>
                                    <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
