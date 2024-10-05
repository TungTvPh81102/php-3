<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\UserController;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/tin-tuc', [TinTucController::class, 'index']);
Route::get('/lien-he', [TinTucController::class, 'lienHe']);
Route::get('/chi-tiet/{id}', [TinTucController::class, 'show']);

Route::get('/thong-tin-sinh-vien/{id}', [StudentController::class, 'show']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('insert', function () { // chuyển vào mảng 1 chiều
    $data = [
        'name' => 'Kinh tế',
        'created_at' => now(),
        'updated_at' => now(),
    ];

    DB::table('categories')->insert($data);

    echo 'Insert thành công!';
});

Route::get('insert-many', function () { // phải truyền vào mảng 2 chiều

    $data = [
        [
            'name' => 'Xã Hội',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Giáo dục',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'Thị trường',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];

    DB::table('categories')->insert($data);

    echo 'Insert thành công!';
});

Route::get('insert-get-id', function () { // chỉ nhận mảng 1 chiều -> insert trả về id của bản ghi

    $data = [
        'name' => 'test',
        'created_at' => now(),
        'updated_at' => now(),
    ];

    $id = DB::table('categories')->insertGetId($data); // áp dụng ID increment

    echo 'Insert thành công có bản ghi có ID = ' . $id;
});


Route::get('select', function () {
    // Select all
    $query = DB::table('categories')
        ->select(['name', 'id'])
        ->whereBetween('id', [1, 3])
        ->orWhere('id', 1);

    // dd($query->toRawSql());
    $all = $query->get();

    dd($all);

    // dd($all);

    // Select where
    $where1 = DB::table('categories')->where('id', 3)->get();
    $where2 = DB::table('categories')->where('id', '>', 3)->get();
    $where3 = DB::table('categories')->where('id', '<', 3)->get();

    // dd($where1, $where2, $where3);

    // Select first
    $first = DB::table('categories')->where('id', 3)->first();
    $find = DB::table('categories')->find(3);

    // dd($first, $find);
    echo 1;
});

Route::get('update', function () {

    $id = 5;

    $data = [
        'name' => 'OKOK',
        'updated_at' => now(),
    ];

    DB::table('categories')
        ->where('id', $id)
        ->update($data);

    echo 'Update thành công!';
});

Route::get('delete', function () {

    $id = 7;

    DB::table('categories')
        ->where('id', $id)
        ->delete();

    echo 'Xóa thành công!';
});

// POST

Route::get('post-create', function () {
    $data = [
        'category_id' => rand(1, 4),
        'title' => 'Tin tức ' . rand(1, 100),
        'img_cover' => 'https://picsum.photos/300/200',
        'description' => 'Mô tả tin tức ' . rand(1, 100),
        'is_published' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];

    DB::table('posts')->insert($data);

    echo 'Thêm mới post thành công ';
});

Route::get('post-create-many', function () {
    $data = [
        [
            'category_id' => rand(1, 4),
            'title' => 'Tin tức ' . rand(1, 100),
            'img_cover' => 'https://picsum.photos/300/200',
            'description' => 'Mô tả tin tức ' . rand(1, 100),
            'is_published' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'category_id' => rand(1, 4),
            'title' => 'Tin tức ' . rand(1, 100),
            'img_cover' => 'https://picsum.photos/200',
            'description' => 'Mô tả tin tức ' . rand(1, 100),
            'is_published' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'category_id' => rand(1, 4),
            'title' => 'Tin tức ' . rand(1, 100),
            'img_cover' => 'https://picsum.photos/200',
            'description' => 'Mô tả tin tức ' . rand(1, 100),
            'is_published' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];

    DB::table('posts')->insert($data);

    echo 'Thêm mới many post thành công';
});

Route::get('post-create-id', function () {
    $data = [
        'category_id' => 2,
        'title' => 'Tin tức ' . rand(1, 100),
        'img_cover' => 'https://images.pexels.com/photos/3844788/pexels-photo-3844788.jpeg?auto=compress&cs=tinysrgb&w=600',
        'description' => 'Mô tả tin tức ' . rand(1, 100),
        'is_published' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];

    $id = DB::table('posts')->insertGetId($data);

    echo 'Thêm mới post thành công có ID = ' . $id;
});

Route::get('select-post', function () {
    // Select all
    $all = DB::table('posts')->select(['title', 'view', 'id'])->get();

    foreach ($all as $key => $value) {
        echo $value->title . ' - ' . $value->id . '<br>';
    }

    // Select where
    $where1 = DB::table('posts')->where('id', 3)->get();
    $where2 = DB::table('posts')->where('id', '>', 3)->get();
    $where3 = DB::table('posts')->where('id', '<', 3)->get();

    // dd($where1, $where2, $where3);

    // Select first
    $first = DB::table('posts')->where('id', 3)->first();
    $find = DB::table('posts')->find(3);

    dd($first, $find);
});

Route::get('update-post', function () {

    $id = 2;

    $data = [
        'category_id' => rand(1, 4),
        'title' => 'Update post',
        'img_cover' => 'https://picsum.photos/300/200',
        'description' => 'Mô tả tin tức ' . rand(1, 100),
        'is_published' => 1,
        'views' => 10000,
        'updated_at' => now(),
    ];

    DB::table('posts')
        ->where('id', $id)
        ->update($data);

    echo 'Update post thành công!';
});

Route::get('delete-post', function () {

    $id = 6;

    DB::table('posts')
        ->where('id', $id)
        ->delete();

    echo 'Xóa post thành công!';
});


Route::get('query', function () {

    $pluck = DB::table('categories')->pluck('name', 'id');

    /**
     *  Chuyển pluck thành dạng mảng luôn thì sử dụng cái này
     *  $pluck = DB::table('categories')->pluck('name', 'id')->all();
     */

    $max = DB::table('categories')->max('id');

    $min = DB::table('categories')->min('created_at');

    $sum = DB::table('categories')->sum('id');

    $avg = DB::table('categories')->avg('id');

    $count = DB::table('categories')
        ->where('id', '12222')
        ->count();

    $exists = DB::table('posts')
        ->where('id', '10000')
        ->exists();

    if (!$exists) {
        echo 'Không tồn tại table post';
    }

    $join = DB::table('posts', 'p')
        ->join('categories as c', 'p.category_id', '=', 'c.id')
        ->where('c.id', '>=', '2')
        ->select([
            'p.id as p_id',
            'p.title as p_name',
            'c.name as c_category_name'
        ])
        ->toRawSql();

    dd($join);

    dd($pluck, $max, $min, $sum, $avg, $count, $exists);
});

Route::get('exists', function () {

    $query = DB::table('user')
        ->whereExists(function (Builder $query) {
            $query->select(DB::raw(1))
                ->from('orders')
                ->whereColumn('orders.user_id', '=', 'users.id');
        });

    dd($query->toRawSql());
});

Route::get('sql', function () {
    $sql1 = DB::table('users', 'u')
        ->join('orders as o', 'u.id,', '=', 'o.user_id')
        ->join('order_items as od', 'o.id', '=', 'od.order_id')
        ->join('products p', 'od.product_id', '=', 'p.id')
        ->where('o.order_date', '>=', DB::raw('now() - interval 30 day'))
        ->select([
            'u.name as u_name',
            'p.name as p_product_name',
            'o.order_date as o_order_date'
        ]);

    // dd($sql1->toRawSql());

    $sql2 = DB::table('orders', 'o')
        ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
        ->where('o.status', 'completed')
        ->select([
            DB::raw('date_format(o.order_date, "%Y-%m") as order_month'),
            DB::raw('SUM(oi.quantity * oi.price) as total_revenue'),
        ])
        ->groupBy('order_month')
        ->orderBy('order_month', 'desc');

    // dd($sql2->toRawSql());

    $sql3 = DB::table('users', 'u')
        ->join('orders as o', 'u.id', '=', 'o.user_id')
        ->select([
            'u.name as u_name',
            DB::raw('COUNT(o.id) as order_count'),
        ])
        ->groupBy('u.name')
        ->having('order_count', '>', 3);;

    // dd($sql3->toRawSql());

    $sql4 = DB::table('products', 'p')
        ->leftJoin('order_items as oi', 'p.id', '=', 'oi.product_id')
        ->whereNull('oi.product_id')
        ->select('p.name as p_name');

    // dd($sql4->toRawSql());

    $sql5 = DB::table('products', 'p')
        ->join(
            DB::raw(
                "(SELECT product_id, SUM(quantity * price) as total
                 FROM order_items
                 GROUP BY product_id) as oi"
            ),
            'p.id',
            '=',
            'oi.product_id'
        )
        ->select([
            'p.category_id as p_category_id',
            'p.name as p_product_name',
            DB::raw('MAX(oi.total) as max_revenue')
        ])
        ->groupBy('p.category_id', 'p.name')
        ->orderBy('max_revenue', 'desc');

    // dd($sql5->toRawSql());

    // Tạo để tính tổng giá trị mỗi đơn hàng
    $avg = DB::table('order_items')
        ->select(DB::raw('SUM(quantity * price) as total'))
        ->groupBy('order_id');

    // Tính giá trị trung bình tổng các đơn hàng
    $avgTotalValue = DB::table(DB::raw("({$avg->toSql()}) as avg_order_value"))
        ->select(DB::raw('AVG(total) as avg_total_value'))
        ->toRawSql();


    $sql6 = DB::table('orders as o')
        ->join('users as u', 'u.id', '=', 'o.user_id')
        ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
        ->select([
            'o.id as o_id',
            'u.name as u_name',
            'o.order_date as o_order_date',
            DB::raw('SUM(oi.quantity * oi.price) as total_value')
        ])
        ->groupBy('o.id', 'u.name', 'o.order_date')
        ->having('total_value', '>', $avgTotalValue);


    // dd($sql6->toRawSql());

    $sql7 = DB::table('employees', 'e')
        ->join('order_assignees as oa', 'e.id', '=', 'oa.employee_id')
        ->join('orders as o', 'oa.order_id', '=', 'o.id')
        ->join('users as u', ' o.user_id', '=', 'u.id')
        ->where('o.status', 'completed')
        ->select([
            'e.name as employee_name',
            'u.name as cumtomer_name',
            'o.order_date as o_order_date',
            'o.status as o_status',
        ]);

    // dd($sql7->toRawSql());

    $sql8 = DB::table('orders as o')
        ->join('users as u', 'o.id', '=', 'u.user_id')
        ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
        ->join('products as p', 'oi.product_id', '=', 'p.id')
        ->join('returns as r', 'oi.id', '=', 'r.order_item_id')
        ->select([
            'o.id',
            'u.name',
            'p.product_name',
            DB::raw('COUNT(r.id) AS return_count')
        ])
        ->groupBy('o.id', 'u.name', 'p.product_name')
        ->having(DB::raw('COUNT(r.id)'), '>', 2);

    // dd($sql8->toRawSql());

    // Số lượng sản phẩm đã bán trong từng danh mục
    // $productByCategory = DB::table('products as p')
    //     ->join('order_items as oi', 'p.id', '=', 'oi.product_id')
    //     ->select('p.category_id', 'p.name', DB::raw('SUM(oi.quantity) AS total_sold'))
    //     ->groupBy('p.category_id', 'p.name');

    // Total sold tối đa của từng danh mục
    // $maxTotalSold = DB::table(DB::raw("({$productByCategory->toSql()}) as sub"))
    //     ->select(DB::raw('category_id, MAX(total_sold) as max_total_sold'))
    //     ->groupBy('category_id')
    //     ->pluck('max_total_sold', 'category_id');

    // $sql9 = DB::table('products as p')
    //     ->join('order_items as oi', 'p.id', '=', 'oi.product_id')
    //     ->select([
    //         'p.category_id as product_category_id',
    //         'p.name as p_name',
    //         DB::raw('SUM(oi.quantity) as total_sold')
    //     ])
    //     ->groupBy('p.category_id', 'p.name')
    //     ->having(DB::raw('SUM(oi.quantity)'), 'in', $maxTotalSold);

    // dd($sql9->toRawSql());

    $sql10 = DB::table('users as u')
        ->join('orders as o', 'u.id', '=', 'o.user_id')
        ->join('order_items as oi', 'o.id', '=', 'oi.order_id')
        ->select([
            'u.name as u_name',
            DB::raw('SUM(oi.quantity * oi.price) as total_spent')
        ])
        ->groupBy('u.name')
        ->orderBy('total_spent', 'desc')
        ->limit(10);

    dd($sql10->toRawSql());
});


Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/shops', [HomeController::class, 'shops'])->name('shops');
Route::get('/product-detail/{slug}', [HomeController::class, 'detail'])->name('detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::resource('customers', \App\Http\Controllers\CustomerController::class);
Route::delete('customers/{customer}/forceDestroy', [\App\Http\Controllers\CustomerController::class, 'forceDestroy'])
    ->name('customers.forceDestroy');

