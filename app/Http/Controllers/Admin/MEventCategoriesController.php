<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MEventCategory;
use Exception;
use Illuminate\Http\Request;
use Auth;
use DB;
use Redirect;

class MEventCategoriesController extends Controller
{
    public function index()
    {
        // $user_id = Auth::user()->id;
        // create and AdminListing instance for a specific model and
        return view('admin.m-event-category.index', [
          'mEventCategory' => null
        ]);
    }

    public function activeList(Request $request){
        $lists = MEventCategory::where(['active' => true])
            ->orderBy('event_category_name', 'asc')
            ->get();
        $data = [];
        if (!empty($lists)) {
            foreach ($lists as $list) {
                $nestedData["id"] = $list->id;
                $nestedData["name"] = $list->event_category_name;
                $data[] = $nestedData;
            }
        }

        if ($data) {
            return response()->json([
                "code" => 200,
                "data" => $data,
            ]);
        } else {
            return response()->json([
                "message" => "Internal Server Error",
                "code" => 500,
                "data" => [],
            ]);
        }
    }

    public function list(Request $request){
        $columns = [
            1 => "event_category_name",
            2 => "active",
        ];

        $f = MEventCategory::where([]);
        $totalData = $f->count();

        $totalFiltered = $totalData;

        $limit = $request->input("length");
        $start = $request->input("start");
        $order = $columns[$request->input("order.0.column")];
        $dir = $request->input("order.0.dir");

        $applied_filters = [];
        foreach ($request->input("columns") as $col) {
            if (!empty($col["search"]["value"])) {
                $applied_filters[$col["data"]] = $col["search"]["value"];
            }
        }

        if (empty($request->input("search.value"))) {
            if (count($applied_filters) > 0) {
                $q = MEventCategory::where([]);

                foreach ($applied_filters as $field => $search) {
                    $q->where($field, "LIKE", "%{$search}%");
                }
            } else {
                $q = MEventCategory::where([]);
            }
        } else {
            $search = $request->input("search.value");

            $q = MEventCategory::where(function ($query) use ($search) {
                return $query
                      ->orWhere("event_category_name", "LIKE", "%{$search}%")
                        ->orWhere("active", "LIKE", "%{$search}%")
  ;
;
                });

            $totalFiltered = $q->count();
        }

        $lists = $q
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();

        $data = [];
        if (!empty($lists)) {
            $ids = $start;

            foreach ($lists as $list) {
                $nestedData["id"] = $list->id;
                $nestedData["fake_id"] = ++$ids;
                $nestedData["event_category_name"] = $list->event_category_name;
                $nestedData["active"] = $list->active;
                $data[] = $nestedData;
            }
        }

        if ($data) {
            return response()->json([
                "draw" => intval($request->input("draw")),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "code" => 200,
                "data" => $data,
            ]);
        } else {
            return response()->json([
                "message" => "Internal Server Error",
                "code" => 500,
                "data" => [],
            ]);
        }
    }

    public function create()
    {
        // $this->authorize('admin.m-event-category.create');

        return view('admin.m-event-category.create', [
          'mEventCategory' => null
      ]);
    }


    public function store(Request $request)
    {
        // Sanitize input
        $sanitized = $request->all();
        // $user_id = Auth::user()->id;
        $sanitized['active'] = isset($sanitized['active']) ? $sanitized['active'] : 0;

        // Store the MEventCategory
        $mEventCategory = MEventCategory::updateOrCreate([
            "id" => isset($sanitized['id']) ? $sanitized['id'] : null,
        ],$sanitized);


        return redirect()->route("m-event-categories.index");
    }

    public function show($id)
    {
        //
    }

    public function edit(MEventCategory $mEventCategory)
    {
        //$this->authorize('admin.m-event-category.edit', $mEventCategory);


        return view('admin.m-event-category.edit', [
            'mEventCategory' => $mEventCategory,
            'data' => $mEventCategory,
            'id' => $mEventCategory->id
        ]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request, $id)
    {

        $data = MEventCategory::where(["id" => $id])->delete();

        if ($request->ajax()) {
            return response()->json([
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                "code" => 200,
                "data" => [],
            ]);
        }
        return redirect()->route("m-event-categories");
    }
}