<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
?>



<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\User;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user-area', function () {
        return response()->json([
            'message' => 'User truy cap thanh cong',
        ]);
    });

    Route::get('/admin/users', function () {
        abort_unless(
            request()->user()->role === 'admin',
            403,
            'Ban khong co quyen admin'
        );

        return User::select(
            'id', 'name', 'email', 'role'
        )->get();
    });
});
?>