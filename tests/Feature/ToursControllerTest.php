<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\clients\Tours;

class ToursControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_index_returns_view_with_data()
    {
        // Tạo dữ liệu test
        Tours::insert([
            ['tourId'=>1, 'name'=>'Tour 1', 'priceAdult'=>100, 'domain'=>'b', 'averageRating'=>4, 'time'=>'3 ngày 2 đêm'],
            ['tourId'=>2, 'name'=>'Tour 2', 'priceAdult'=>200, 'domain'=>'t', 'averageRating'=>5, 'time'=>'4 ngày 3 đêm'],
            ['tourId'=>3, 'name'=>'Tour 3', 'priceAdult'=>150, 'domain'=>'n', 'averageRating'=>3, 'time'=>'5 ngày 4 đêm'],
        ]);

        $response = $this->get('/tours');

        $response->assertStatus(200)
                 ->assertViewIs('clients.tours')
                 ->assertViewHas('title', 'Tours')
                 ->assertViewHas('tours')
                 ->assertViewHas('domainsCount', [
                     'mien_bac'=>1,
                     'mien_trung'=>1,
                     'mien_nam'=>1
                 ]);
    }

    /** @test */
    public function test_filterTours_by_price_and_domain_and_sorting()
    {
        Tours::insert([
            ['tourId'=>1, 'name'=>'Tour 1', 'priceAdult'=>100, 'domain'=>'b', 'averageRating'=>4, 'time'=>'3 ngày 2 đêm'],
            ['tourId'=>2, 'name'=>'Tour 2', 'priceAdult'=>200, 'domain'=>'t', 'averageRating'=>5, 'time'=>'4 ngày 3 đêm'],
        ]);

        $response = $this->post('/filter-tours', [
            'minPrice' => 50,
            'maxPrice' => 150,
            'domain' => 'b',
            'sorting' => 'new'
        ]);

        $response->assertStatus(200)
                 ->assertViewIs('clients.partials.filter-tours')
                 ->assertViewHas('tours');
    }

    /** @test */
    public function test_filterTours_by_star_and_time()
    {
        Tours::insert([
            ['tourId'=>1, 'name'=>'Tour 1', 'priceAdult'=>100, 'domain'=>'b', 'averageRating'=>4, 'time'=>'3 ngày 2 đêm'],
            ['tourId'=>2, 'name'=>'Tour 2', 'priceAdult'=>200, 'domain'=>'t', 'averageRating'=>5, 'time'=>'4 ngày 3 đêm'],
        ]);

        $response = $this->post('/filter-tours', [
            'star' => 5,
            'time' => '4n3d'
        ]);

        $response->assertStatus(200)
                 ->assertViewIs('clients.partials.filter-tours')
                 ->assertViewHas('tours');
    }
}
