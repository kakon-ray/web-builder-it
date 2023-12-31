<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddCourse;
use App\Models\AddServices;

class SearchController extends Controller
{
    function search(Request $request)
    {
        $search_item = AddCourse::orderBy('id', 'desc')->where('course_title', 'LIKE', '%' . $request->item . '%');
        $search_item_desc = AddCourse::orderBy('id', 'desc')->where('desc', 'LIKE', '%' . $request->item . '%');

        $search_item = $search_item->get();
        $search_item_desc = $search_item_desc->get();

        if ($request->category == "course") {

            if (isset($search_item[0])) {
                return view('users.all_course', ['allCourse' => $search_item]);
            } else if (isset($search_item_desc[0])) {
                return view('users.all_course', ['allCourse' => $search_item_desc]);
            } else {
                return view('users.all_course', ['notFound' => 'Not Found']);
            }
        } else if ($request->category == "service") {
            $search_item = AddServices::orderBy('id', 'desc')->where('services_title', 'LIKE', '%' . $request->item . '%');
            $search_item_desc = AddServices::orderBy('id', 'desc')->where('desc', 'LIKE', '%' . $request->item . '%');

            $search_item = $search_item->get();
            $search_item_desc = $search_item_desc->get();

            if (isset($search_item[0])) {
                return view('users.all_services', ['allServices' => $search_item]);
            } else if (isset($search_item_desc[0])) {
                return view('users.all_services', ['allServices' => $search_item_desc]);
            } else {
                return view('users.all_services', ['notFound' => 'Not Found']);
            }
        }
    }
}
