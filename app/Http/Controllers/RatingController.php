<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function reviewAdd(Request $request, $user, $product)
    {
        $validator = Validator::make($request->all(), [
            'review_text' => 'required|string',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'Заполните все данные');
            return redirect()->back();
        }

        switch ($request->rating) {
            case 1:
                $request->rating = 5;
                break;
            case 2:
                $request->rating = 4;
                break;
            case 3:
                $request->rating = 3;
                break;
            case 4:
                $request->rating = 2;
                break;
            case 5:
                $request->rating = 1;
                break;
        }

        $rating = new Rating;
        $rating->user_id = $user;
        $rating->product_id = $product;
        $rating->comment = $request->review_text;
        $rating->rating = $request->rating;
        if ($rating->save()) {
            if ($request->image) {
                foreach ($request->file('image') as $image) {
                    $file = $image;
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path("images"), $filename);
                    DB::table('rating_images')->insert([
                        'rating_id' => $rating->id, 'name' => $filename
                    ]);
                }
            }

            session()->flash('success', 'Ваш отзыв добавлен');
        } else {
            session()->flash('error', 'Произошла ошибка');
        }

        return redirect()->back();
    }
}
