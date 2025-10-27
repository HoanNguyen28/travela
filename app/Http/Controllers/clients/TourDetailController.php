<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Tours;
use Illuminate\Http\Request;

class TourDetailController extends Controller
{
    private $tours;

    public function __construct()
    {
        parent::__construct(); // Nếu Controller cha có logic khởi tạo $user
        $this->tours = new Tours();
    }

    /**
     * Hiển thị chi tiết tour
     */
    public function index($id = 0)
    {
        $title = 'Chi tiết tours';
        $userId = $this->getUserId();

        // Lấy thông tin tour và reviews
        $tourDetail = $this->tours->getTourDetail($id);
        $getReviews = $this->tours->getReviews($id);
        $reviewStats = $this->tours->reviewStats($id);

        $avgStar = round($reviewStats->averageRating);
        $countReview = $reviewStats->reviewCount;

        // Kiểm tra người dùng đã đánh giá chưa
        $checkReviewExist = $this->tours->checkReviewExist($id, $userId);
        $checkDisplay = $checkReviewExist ? 'hide' : '';

        // Trả về view
        return view('clients.tour-detail', compact(
            'title',
            'tourDetail',
            'getReviews',
            'avgStar',
            'countReview',
            'checkDisplay'
        ));
    }

    /**
     * Xử lý POST review từ người dùng
     */
    public function reviews(Request $req)
    {
        $userId = $this->getUserId();
        $tourId = $req->tourId;
        $message = $req->message;
        $star = $req->rating;

        $dataReview = [
            'tourId'  => $tourId,
            'userId'  => $userId,
            'comment' => $message,
            'rating'  => $star
        ];

        $rating = $this->tours->createReviews($dataReview);

        if (!$rating) {
            return response()->json([
                'error' => true
            ], 500);
        }

        // Lấy lại thông tin reviews để cập nhật view
        $tourDetail = $this->tours->getTourDetail($tourId);
        $getReviews = $this->tours->getReviews($tourId);
        $reviewStats = $this->tours->reviewStats($tourId);

        $avgStar = round($reviewStats->averageRating);
        $countReview = $reviewStats->reviewCount;

        return response()->json([
            'success' => true,
            'message' => 'Đánh giá của bạn đã được gửi thành công!',
            'data'    => view('clients.partials.reviews', compact(
                'tourDetail',
                'getReviews',
                'avgStar',
                'countReview'
            ))->render()
        ], 200);
    }
}
