@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Feedback Event: {{ $event->name ?? 'Event Name' }}</h1>
        <p class="text-gray-600 mt-1">Berikan ulasan Anda terhadap event yang telah diikuti.</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('umkm.event-feedback.store', $event->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1 - 5)</label>
                <select id="rating" name="rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                    <option value="">Pilih Rating</option>
                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5 - Sangat Baik</option>
                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4 - Baik</option>
                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3 - Cukup</option>
                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2 - Buruk</option>
                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1 - Sangat Buruk</option>
                </select>
                @error('rating')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="feedback" class="block text-sm font-medium text-gray-700">Ulasan / Feedback</label>
                <textarea id="feedback" name="feedback" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="Tuliskan pengalaman atau saran Anda untuk event ini (opsional)">{{ old('feedback') }}</textarea>
                @error('feedback')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('umkm.event.history') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Batal
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Kirim Feedback
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
