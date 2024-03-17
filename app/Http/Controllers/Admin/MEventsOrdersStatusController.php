<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MEventsOrdersStatus;
use Exception;
use Illuminate\Http\Request;
use Auth;
use DB;
use Redirect;

class MEventsOrdersStatusController extends Controller
{
    public function index()
    {
        // $user_id = Auth::user()->id;
        // create and AdminListing instance for a specific model and
        return view('admin.m-events-orders-status.index', [
          'mEventsOrdersStatus' => null
        ]);
    }

    public function list(Request $request){
        $columns = [
            1 => "events_orders_status_name",
            2 => "active",
        ];

        $f = MEventsOrdersStatus::where([]);
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
                $q = MEventsOrdersStatus::where([]);

                foreach ($applied_filters as $field => $search) {
                    $q->where($field, "LIKE", "%{$search}%");
                }
            } else {
                $q = MEventsOrdersStatus::where([]);
            }
        } else {
            $search = $request->input("search.value");

            $q = MEventsOrdersStatus::where(function ($query) use ($search) {
                return $query
                      ->orWhere("events_orders_status_name", "LIKE", "%{$search}%")
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
                $nestedData["events_orders_status_name"] = $list->events_orders_status_name;
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
        // $this->authorize('admin.m-events-orders-status.create');

        return view('admin.m-events-orders-status.create', [
          'mEventsOrdersStatus' => null
      ]);
    }


    public function store(Request $request)
    {
        // Sanitize input
        $sanitized = $request->all();
        // $user_id = Auth::user()->id;
        $sanitized['active'] = isset($sanitized['active']) ? $sanitized['active'] : 0;

        // Store the MEventsOrdersStatus
        $mEventsOrdersStatus = MEventsOrdersStatus::updateOrCreate([
            "id" => isset($sanitized['id']) ? $sanitized['id'] : null,
        ],$sanitized);


        return redirect()->route("m-events-orders-statuses.index");
    }

    public function show($id)
    {
        //
    }

    public function edit(MEventsOrdersStatus $mEventsOrdersStatus)
    {
        //$this->authorize('admin.m-events-orders-status.edit', $mEventsOrdersStatus);


        return view('admin.m-events-orders-status.edit', [
            'mEventsOrdersStatus' => $mEventsOrdersStatus,
            'data' => $mEventsOrdersStatus,
            'id' => $mEventsOrdersStatus->id
        ]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request, $id)
    {

        $data = MEventsOrdersStatus::where(["id" => $id])->delete();

        if ($request->ajax()) {
            return response()->json([
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                "code" => 200,
                "data" => [],
            ]);
        }
        return redirect()->route("m-events-orders-statuses");
    }
}