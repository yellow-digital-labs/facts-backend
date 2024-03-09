<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventsOrder;
use Exception;
use Illuminate\Http\Request;
use Auth;
use DB;
use Redirect;

class EventsOrdersController extends Controller
{
    public function index()
    {
        // $user_id = Auth::user()->id;
        // create and AdminListing instance for a specific model and
        return view('admin.events-order.index', [
          'eventsOrder' => null
        ]);
    }

    public function list(Request $request){
        $columns = [
        ];

        $f = EventsOrder::where([]);
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
                $q = EventsOrder::where([]);

                foreach ($applied_filters as $field => $search) {
                    $q->where($field, "LIKE", "%{$search}%");
                }
            } else {
                $q = EventsOrder::where([]);
            }
        } else {
            $search = $request->input("search.value");

            $q = EventsOrder::where(function ($query) use ($search) {
                return $query
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
        // $this->authorize('admin.events-order.create');

        return view('admin.events-order.create', [
          'eventsOrder' => null
      ]);
    }


    public function store(Request $request)
    {
        // Sanitize input
        $sanitized = $request->all();
        // $user_id = Auth::user()->id;

        // Store the EventsOrder
        $eventsOrder = EventsOrder::updateOrCreate([
            "id" => isset($sanitized['id']) ? $sanitized['id'] : null,
        ],$sanitized);


        return redirect()->route("events-orders.index");
    }

    public function show($id)
    {
        //
    }

    public function edit(EventsOrder $eventsOrder)
    {
        //$this->authorize('admin.events-order.edit', $eventsOrder);


        return view('admin.events-order.edit', [
            'eventsOrder' => $eventsOrder,
            'data' => $eventsOrder,
            'id' => $eventsOrder->id
        ]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request, $id)
    {

        $data = EventsOrder::where(["id" => $id])->delete();

        if ($request->ajax()) {
            return response()->json([
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                "code" => 200,
                "data" => [],
            ]);
        }
        return redirect()->route("events-orders");
    }
}