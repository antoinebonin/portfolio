<?php

use App\Enum\PageStatutEnum;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $page = Page::find(1);
    return view('page', ['page' => $page]);
});

Route::get('/{page:url}', function (Page $page) {
    if ($page->statut !== PageStatutEnum::PUBLISH) {
        abort(404);
    }
    return view('page', ['page' => $page]);
});
