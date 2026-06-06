<?php

test('PBI 42: umkm can access faq page when logged in', function () {
    session(['is_logged_in' => true]);
    $response = $this->get('/umkm/faq');
    $response->assertStatus(200);
    $response->assertViewIs('umkm.faq');
    $response->assertSee('FAQ & Bantuan');
});

test('PBI 42: faq page redirects to login when not authenticated', function () {
    $response = $this->get('/umkm/faq');
    $response->assertRedirect('/login');
});
