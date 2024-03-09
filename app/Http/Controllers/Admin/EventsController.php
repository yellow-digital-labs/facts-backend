<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Auth;
use DB;
use Redirect;

class EventsController extends Controller
{
    public function index()
    {
        // $user_id = Auth::user()->id;
        // create and AdminListing instance for a specific model and
        return view('admin.event.index', [
          'event' => null
        ]);
    }

    public function activeList(Request $request){
        try{
            $lists = Event::where(['active' => true])
                ->orderBy('event_start_datetime', 'asc')
                ->get();
            $data = [];
            if (!empty($lists)) {
                foreach ($lists as $list) {
                    $nestedData["id"] = $list->id;
                    $nestedData["event_categories_id"] = $list->event_categories_id;
                    $nestedData["event_name"] = $list->event_name;
                    $nestedData["event_start_datetime"] = $list->event_start_datetime;
                    $nestedData["event_end_datetime"] = $list->event_end_datetime;
                    $nestedData["event_description"] = $list->event_description;
                    $nestedData["event_primary_image"] = $list->event_primary_image;
                    $nestedData["event_location"] = $list->event_location;
                    $nestedData["event_contact"] = $list->event_contact;
                    $nestedData["event_available_tickets"] = $list->event_available_tickets;
                    $nestedData["event_ticket_amount"] = $list->event_ticket_amount;
                    $nestedData["event_ticket_discount_amount"] = $list->event_ticket_discount_amount;
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
                    "message" => "No data found",
                    "code" => 501,
                    "data" => [],
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                "message" => "Internal Server Error",
                "code" => 500,
                "data" => [],
            ]);
        }
    }

    public function list(Request $request){
        $columns = [
            1 => "user_id",
            2 => "event_categories_id",
            3 => "event_name",
            4 => "event_start_datetime",
            5 => "event_end_datetime",
            6 => "event_description",
            7 => "event_primary_image",
            8 => "event_location",
            9 => "event_contact",
            10 => "event_available_tickets",
            11 => "event_ticket_amount",
            12 => "event_ticket_discount_amount",
            13 => "active",
        ];

        $f = Event::where([]);
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
                $q = Event::where([]);

                foreach ($applied_filters as $field => $search) {
                    $q->where($field, "LIKE", "%{$search}%");
                }
            } else {
                $q = Event::where([]);
            }
        } else {
            $search = $request->input("search.value");

            $q = Event::where(function ($query) use ($search) {
                return $query
                      ->orWhere("user_id", "LIKE", "%{$search}%")
                        ->orWhere("event_categories_id", "LIKE", "%{$search}%")
                        ->orWhere("event_name", "LIKE", "%{$search}%")
                        ->orWhere("event_start_datetime", "LIKE", "%{$search}%")
                        ->orWhere("event_end_datetime", "LIKE", "%{$search}%")
                        ->orWhere("event_description", "LIKE", "%{$search}%")
                        ->orWhere("event_primary_image", "LIKE", "%{$search}%")
                        ->orWhere("event_location", "LIKE", "%{$search}%")
                        ->orWhere("event_contact", "LIKE", "%{$search}%")
                        ->orWhere("event_available_tickets", "LIKE", "%{$search}%")
                        ->orWhere("event_ticket_amount", "LIKE", "%{$search}%")
                        ->orWhere("event_ticket_discount_amount", "LIKE", "%{$search}%")
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
                $nestedData["user_id"] = $list->user_id;
                $nestedData["event_categories_id"] = $list->event_categories_id;
                $nestedData["event_name"] = $list->event_name;
                $nestedData["event_start_datetime"] = $list->event_start_datetime;
                $nestedData["event_end_datetime"] = $list->event_end_datetime;
                $nestedData["event_description"] = $list->event_description;
                $nestedData["event_primary_image"] = $list->event_primary_image;
                $nestedData["event_location"] = $list->event_location;
                $nestedData["event_contact"] = $list->event_contact;
                $nestedData["event_available_tickets"] = $list->event_available_tickets;
                $nestedData["event_ticket_amount"] = $list->event_ticket_amount;
                $nestedData["event_ticket_discount_amount"] = $list->event_ticket_discount_amount;
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
        // $this->authorize('admin.event.create');

        return view('admin.event.create', [
          'event' => null
      ]);
    }


    public function store(Request $request)
    {
        // Sanitize input
        $eventData = $request->validate([
            'event_categories_id'=>'required|numeric',
            'event_name'=>'required|string',
            'event_start_datetime'=>'required|date',
            'event_end_datetime'=>'required|date',
            'event_end_datetime'=>'required|date',
            'event_description'=>'required|string',
            // 'event_primary_image'=>'required|file',
            'event_location'=>'required|string|max:255',
            'event_contact'=>'required|numeric|max_digits:15',
            'event_available_tickets'=>'required|numeric',
            'event_ticket_amount'=>'required|numeric',
            'event_ticket_discount_amount'=>'required|numeric',
            'active'=>'required|boolean',
        ]);
        
        $sanitized = $request->all();
        // $user_id = Auth::user()->id;
        $sanitized['active'] = isset($sanitized['active']) ? $sanitized['active'] : 0;
        $sanitized['user_id'] = 1;
        $sanitized['event_primary_image'] = 'https://placehold.co/400';

        // Store the Event
        $event = Event::updateOrCreate([
            "id" => isset($sanitized['id']) ? $sanitized['id'] : null,
        ],$sanitized);

        if($request->route()->getPrefix() === 'api'){
            return response()->json([
                "code" => 200,
                "message" => "Successfully added record",
            ]);
        } else {
            return redirect()->route("events.index");
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Event $event)
    {
        //$this->authorize('admin.event.edit', $event);


        return view('admin.event.edit', [
            'event' => $event,
            'data' => $event,
            'id' => $event->id
        ]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request, $id)
    {

        $data = Event::where(["id" => $id])->delete();

        if ($request->ajax()) {
            return response()->json([
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                "code" => 200,
                "data" => [],
            ]);
        }
        return redirect()->route("events");
    }
}