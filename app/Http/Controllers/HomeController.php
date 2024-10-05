<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
//        dd(\request()->all());
        $title = 'Trang chủ';

        $flights = Flight::query()->get();
        dd($flights);

        $first = Flight::query()->first();
//        dd($first);

        $findById = Flight::query()->find(1);
//        dd($findById);

        $findOrFail = Flight::query()->findOrFail(1);
//        dd($findOrFail);

        $findOrCreate = Flight::query()->firstOrCreate([
            'name' => 'Trương Văn Tùng'
        ]);

//        dd($findOrCreate);

        /**
         *  Khi dùng firstOrNew nếu muốn lưu vào database phải sử dụng hàm save()
         */

        $firstOrNew = Flight::query()->firstOrNew([
            'name' => 'FPT Polytechnic'
        ]);

//        $firstOrNew->save();

//        dd($firstOrNew);

//        Flight::create([
//            'name' => 'Traveling to Europe',
//        ]);
//


        return view('home', compact([
            'title'
        ]));
    }

    public function shops()
    {
        $title = 'Cửa hàng';

        return view('shop.index', compact([
            'title'
        ]));
    }

    public function detail(string $slug)
    {
        $title = 'Chi tiết';

        return view('shop.detail', compact([
            'title'
        ]));
    }

    public function contact()
    {
        $title = 'Liên hệ';

        return view('contact.index', compact([
            'title'
        ]));
    }

    public function about()
    {
        $title = 'Giới thiệu';

        return view('about.index', compact([
            'title'
        ]));
    }
}
