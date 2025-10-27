<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;
use Illuminate\Http\Request;

class ToursController extends Controller
{

    private $tours;

    public function __construct()
    {
        $this->tours = new Tours();
    }
    
    public function index()
    {
        $title = 'Tours';
        $tours = $this->tours->getAllTours();
        $domain = $this->tours->getDomain();
        $domainsCount =[
            'mien_bac' => optional($domain->firstWhere('domain','b'))->count,
            'mien_trung' => optional($domain->firstWhere('domain','t'))->count,
            'mien_nam' => optional($domain->firstWhere('domain','n'))->count,
         ]; 
             $toursPopular = $this->tours->toursPopular(2);

       return view('clients.tours',compact('title','tours','domainsCount','toursPopular'));
    }
    //Xu ly FilterTour
    public function filterTours(Request $req){
        $conditions = [];
        $sorting = [];

        //Handle price filter
        if($req->filled('minprice') && $req->filled('maxPrice')){
        }
            $minPrice = $req->minPrice;
            $maxPrice = $req->maxPrice;
            $conditions[] = ['priceAdult', '>=',$minPrice];
            $conditions[] = ['priceAdult', '<=',$maxPrice];
           

        
        //Handle domain filter
        if($req->filled('domain')){
            $domain = $req->domain;
            $conditions[] = ['domain', '=' , $domain];
        }
            
        //Handle star rating filter
        if($req->filled('star')){
            $star = (int) $req->star;
            $conditions[] = ['averageRating','>=',$star];
        }

        //Handle duration filter
         if($req->filled('time')){
            $duration = $req->time;
            $time=[
                '3n2d'=>'3 ngày 2 đêm',
                '4n3d'=>'4 ngày 3 đêm',
                '5n4d'=>'5 ngày 4 đêm'
            ];
            $conditions[] = ['time', '=' , $time[$duration]];
        }

        //Handle orderBy filter
         if($req->filled('sorting')){
            $sortingOption = trim($req->sorting);

          if($sortingOption == 'new') {
            $sorting[] = ['tourId', 'DESC']; // mới nhất
        } elseif($sortingOption == 'old') {
            $sorting[] = ['tourId', 'ASC'];  // cũ nhất
        } elseif($sortingOption == "hight-to-low") {
          $sorting[] = ['priceAdult', 'DESC']; // giá cao xuống thấp
        } elseif($sortingOption == "low-to-high") {
            $sorting[] = ['priceAdult', 'ASC'];  // giá thấp lên cao
}

        }
      $tours = $this->tours->filterTours($conditions, $sorting);

if (!$tours instanceof \Illuminate\Pagination\LengthAwarePaginator) {
    $currentPage = request()->get('page', 1);
    $perPage = 9;

    $tours = new \Illuminate\Pagination\LengthAwarePaginator(
        $tours->forPage($currentPage, $perPage),
        $tours->count(),
        $perPage,
        $currentPage,
        ['path' => url()->current()]
    );
}

return view('clients.partials.filter-tours', compact('tours'));
    }
}

    
