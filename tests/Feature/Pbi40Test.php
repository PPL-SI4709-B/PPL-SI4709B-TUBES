<?php

test('PBI 40: umkm can access notifikasi page when logged in', function () {
    session(['is_logged_in' => true]);
    $response = $this->get('/umkm/notifikasi');
    $response->assertStatus(200);
    $response->assertViewIs('umkm.notifikasi');
    $response->assertSee('Notifikasi & Riwayat Status');
});

test('PBI 40: notifikasi page redirects to login when not authenticated', function () {
    $response = $this->get('/umkm/notifikasi');
    $response->assertRedirect('/login');
});
