@extends('layouts.main')

@section('container')
    <article class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h1 class="text-3xl font-bold mb-4">{{ $news->judul }}</h1>
        <p class="text-gray-600 mb-2">Oleh {{ $news->wartawan->nama }} | {{ $news->created_at->format('d M Y') }}</p>
        <div class="prose max-w-none">
            {{-- pake {!! !!} agar tag html tidak terender --}}
            {!! $news->isi !!}
        </div>
    </article>

    <!-- Section Komentar -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-2xl font-bold mb-6">Komentar ({{ $news->komentar->count() }})</h2>
        
        @if ($news->komentar->count() > 0)
            <div class="space-y-4">
                @foreach ($news->komentar as $komentar)
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <p class="font-semibold text-gray-800">{{ $komentar->nama }}</p>
                        <p class="text-gray-600 text-sm mb-2">{{ $komentar->created_at->format('d M Y H:i') }}</p>
                        <p class="text-gray-700">{{ $komentar->isi }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 italic">Belum ada komentar untuk berita ini.</p>
        @endif
    </div>

    <a href="{{ route('news.index') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar Berita</a>
@endsection