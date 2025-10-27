<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;

class MyTourController extends Controller
{
    private $tours;

    public function __construct()
    {
        parent::__construct(); // Nếu bạn có logic khởi tạo $user trong Controller cha
        $this->tours = new Tours();
    }

    public function index()
    {
        $title = 'Tours đã đặt';
        $userId = $this->getUserId();

        // Lấy danh sách tour của user
        $myTours = $this->user->getMyTours($userId);

        // Lấy danh sách tour phổ biến (ví dụ 6 tour)
        $toursPopular = $this->tours->toursPopular(6);

        // Truyền biến xuống view
        return view('clients.my-tours', compact('title', 'myTours', 'toursPopular'));
    }
}
