<div class="card" style="padding: 0; overflow: hidden;">
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: var(--color-input-bg); border-bottom: 1px solid var(--color-border);">
                    <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em; width: 50px;">No</th>
                    <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Nama</th>
                    <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Deskripsi</th>
                    <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Dibuat</th>
                    <th style="padding: var(--space-3) var(--space-4); text-align: right; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $i => $item)
                    <tr style="border-bottom: 1px solid var(--color-border);" onmouseover="this.style.backgroundColor='var(--color-input-bg)'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: var(--space-3) var(--space-4); font-size: var(--text-sm); color: var(--color-text-muted);">{{ $i + 1 }}</td>
                        <td style="padding: var(--space-3) var(--space-4); font-size: var(--text-sm); font-weight: 600; color: var(--color-text-dark);">{{ $item->name }}</td>
                        <td style="padding: var(--space-3) var(--space-4); font-size: var(--text-sm); color: var(--color-text-main); max-width: 300px;">{{ $item->description ?? '-' }}</td>
                        <td style="padding: var(--space-3) var(--space-4); font-size: var(--text-sm); color: var(--color-text-muted);">{{ $item->created_at->format('d M Y') }}</td>
                        <td style="padding: var(--space-3) var(--space-4); text-align: right;">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route($editRoute, $item) }}" title="Edit" style="color: var(--color-primary); padding: 4px;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route($deleteRoute, $item) }}" method="POST" onsubmit="return confirm('{{ $deleteConfirm }}')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" style="color: var(--color-status-reject-text); padding: 4px; cursor: pointer; background: none; border: none;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: var(--space-8); text-align: center; color: var(--color-text-muted); font-size: var(--text-sm);">
                            Belum ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
