<?php

use App\Enums\PengajuanStatus;

test('PBI 20: pengajuan status enum returns correct label', function () {
    expect(PengajuanStatus::PENDING->label())->toBe('Menunggu');
    expect(PengajuanStatus::APPROVED->label())->toBe('Disetujui');
    expect(PengajuanStatus::REJECTED->label())->toBe('Ditolak');
});

test('PBI 20: pengajuan status enum returns correct color', function () {
    expect(PengajuanStatus::PENDING->color())->toBe('warning');
    expect(PengajuanStatus::APPROVED->color())->toBe('success');
    expect(PengajuanStatus::REJECTED->color())->toBe('danger');
});
