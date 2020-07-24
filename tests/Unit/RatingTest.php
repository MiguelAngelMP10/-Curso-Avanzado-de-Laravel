<?php

namespace Tests\Unit;

use App\Product;
use App\Rating;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RatingTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_belongs_to_many_users()
    {

        $user = factory(User::class)->create();

        $product = factory(Product::class)->create();

        $user->rate($product, 5);

        // dd($user->ratings()->get());
        // dd($product->ratings()->get())

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->ratings(Product::class)->get());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $product->qualifiers(User::class)->get());
    }

    public function test_averageRating()
    {

        $user = factory(User::class)->create();

        $user2 = factory(User::class)->create();

        $product = factory(Product::class)->create();

        $user->rate($product, 5);
        $user2->rate($product, 10);

        $this->assertEquals(7.5, $product->averageRating(User::class));
    }

    public function test_rating_model()
    {

        $user = factory(User::class)->create();

        $product = factory(Product::class)->create();

        $user->rate($product, 5);


        $rating = Rating::first();

        $this->assertInstanceOf(Product::class, $rating->rateable);
        $this->assertInstanceOf(User::class, $rating->qualifier);
    }
}