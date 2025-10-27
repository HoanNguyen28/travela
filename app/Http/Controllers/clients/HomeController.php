<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Home;
use App\Models\clients\Tours;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $homeTours;
    private $tours;

    public function __construct()
    {
        $this->homeTours = new Home();
        $this->tours = new Tours();
    }

    public function index()
    {
        $title = 'Trang chủ';

        // Lấy tour cho trang chủ
        $tours = $this->homeTours->getHomeTours(8);

        // Lấy danh sách tour phổ biến (ví dụ 6 tour)
        $toursPopular = $this->tours->toursPopular(6);

        // Truyền xuống view
        return view('clients.home', compact('title', 'tours', 'toursPopular'));
    }
}
