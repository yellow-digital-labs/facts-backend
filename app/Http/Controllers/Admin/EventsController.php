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

    /**
     * Active Event List.
     * 
     * Get all active events list.
     */
    public function activeList(Request $request){
        try{
            $filterData = $request->validate([
                'filter_event_categories_id'=>'numeric',
                'filter_event_name'=>'string',
                'filter_event_start_datetime'=>'date|after:yesterday',
                'filter_event_end_datetime'=>'date',
                'filter_event_location'=>'string|max:255',
                'filter_event_ticket_amount_min'=>'numeric',
                'filter_event_ticket_amount_max'=>'numeric',
            ]);

            $sanitized = $request->all();

            if(!isset($sanitized['filter_event_start_datetime']) || is_null($sanitized['filter_event_start_datetime'])){
                $sanitized['filter_event_start_datetime'] = date('Y-m-d');
            }

            $query = Event::where(['active' => true]);
            if(isset($sanitized['filter_event_categories_id']) && $sanitized['filter_event_categories_id'] != 0){
                $query->where(['event_categories_id' => $sanitized['filter_event_categories_id']]);
            }
            if(isset($sanitized['filter_event_name']) && $sanitized['filter_event_name'] != ''){
                $query->where('event_name', 'like', '%' . $sanitized['filter_event_name'] . '%');
            }
            if(isset($sanitized['filter_event_start_datetime']) && $sanitized['filter_event_start_datetime'] != ''){
                $query->whereDate('event_start_datetime', '>=', $sanitized['filter_event_start_datetime']);
            }
            if(isset($sanitized['filter_event_end_datetime']) && $sanitized['filter_event_end_datetime'] != ''){
                $query->whereDate('event_end_datetime', '<=', $sanitized['filter_event_end_datetime']);
            }
            if(isset($sanitized['filter_event_location']) && $sanitized['filter_event_location'] != ''){
                $query->where(['event_location' => $sanitized['filter_event_location']]);
            }
            if(isset($sanitized['filter_event_ticket_amount_min']) && $sanitized['filter_event_ticket_amount_min'] != 0){
                $query->where('event_ticket_amount', '>=',  $sanitized['filter_event_ticket_amount_min']);
            }
            if(isset($sanitized['filter_event_ticket_amount_max']) && $sanitized['filter_event_ticket_amount_max'] != 0){
                $query->where('event_ticket_amount', '<=',  $sanitized['filter_event_ticket_amount_max']);
            }
            $lists = $query->orderBy('event_start_datetime', 'asc')
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
                "data" => [
                    $e->getMessage()
                ],
            ]);
        }
    }

    /**
     * Active Event Locations List.
     * 
     * Get all active events locations list for filter popup dropdown.
     */
    public function activeLocationList(Request $request){
        try{
            $locationData = Event::select('event_location')
                ->where(['active' => true])
                ->orderBy('event_location', 'asc')
                ->groupBy('event_location')
                ->get();

            $data = [];
            if (!empty($locationData)) {
                foreach ($locationData as $list) {
                    $nestedData["event_location"] = $list->event_location;
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
                "data" => [
                    $e->getMessage()
                ],
            ]);
        }
    }

    public function activePriceMinMaxList(Request $request){

    }

    /**
     * Admin Event List.
     * 
     * Get all events created by logged in user. To fetch thing user login is required. So, you will need to pass `Barer token` in header.
     */
    public function adminList(Request $request){
        try{
            $lists = Event::where(['active' => true])
                ->where(['user_id' => $request->user()->id])
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
                        ->orWhere("active", "LIKE", "%{$search}%");
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
            'event_primary_image'=>'required|string',
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
        $sanitized['user_id'] = $request->user()->id;
        // $sanitized['event_primary_image'] = 'https://placehold.co/400';

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

    public function show($id, Request $request)
    {
        $data = Event::where(["id" => $id])->first();
        if($request->route()->getPrefix() === 'api'){
            if($data){
                return response()->json([
                    "code" => 200,
                    "data" => $data,
                ]);
            } else {
                return response()->json([
                    "code" => 501,
                    "data" => "No data found",
                ]);
            }
        }
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

        $data = Event::where(["id" => $id])
            ->where(['user_id' => $request->user()->id])
            ->delete();

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