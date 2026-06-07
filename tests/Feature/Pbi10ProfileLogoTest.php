<?php

use App\Models\Category;
use App\Models\Region;
use App\Models\Scale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('PBI-10: UMKM dapat mengunggah logo profil', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'umkm']);
    $category = Category::factory()->create();
    $region = Region::factory()->create();
    $scale = Scale::factory()->create();

    $this->actingAs($user)->put(route('umkm.profile.update'), [
        'business_name' => 'Toko Maju',
        'business_address' => 'Jl. Mawar 1',
        'category_id' => $category->id,
        'region_id' => $region->id,
        'scale_id' => $scale->id,
        'logo' => UploadedFile::fake()->create('logo.png', 100, 'image/png'),
    ]);

    $profile = $user->fresh()->umkmProfile;
    expect($profile->logo)->not->toBeNull();
    Storage::disk('public')->assertExists($profile->logo);
});
