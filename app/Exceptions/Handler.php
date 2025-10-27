<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Kiểm tra nếu là HttpException
        if ($this->isHttpException($exception)) {
            if ($exception instanceof HttpException && $exception->getStatusCode() == 404) {
                // Nếu URL bắt đầu bằng /admin -> trả về trang 404 của admin
                if ($request->is('admin/*')) {
                    return response()->view('admin.errors.404', ['title' => '404'], 404);
                }
                // Ngược lại -> trả về trang 404 của client
                return response()->view('clients.errors.404', ['title' => '404'], 404);
            }
        }

        return parent::render($request, $exception);
    }
}
