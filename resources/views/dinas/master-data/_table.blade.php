<div class="content-card" style="padding: 0; overflow: hidden;">
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 4rem;">No</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Dibuat</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="font-weight: 800; color: var(--color-gray-900);">{{ $item->name }}</td>
                        <td style="max-width: 24rem;">{{ $item->description ?? 'Belum tersedia' }}</td>
                        <td style="white-space: nowrap;">{{ $item->created_at->format('d M Y') }}</td>
                        <td style="text-align: right;">
                            <div class="action-group">
                                <a href="{{ route($editRoute, $item) }}" title="Edit" class="link-action" style="padding: 4px;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route($deleteRoute, $item) }}" method="POST" onsubmit="return confirm('{{ $deleteConfirm }}')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" style="color: var(--color-danger); padding: 4px; cursor: pointer; background: none; border: none;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">Belum ada data.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
