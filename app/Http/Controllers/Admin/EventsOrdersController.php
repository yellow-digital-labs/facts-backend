<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventsOrder;
use App\Models\Event;
use App\Models\User;
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
            1 => "booking_user_id",
            2 => "event_user_id",
            3 => "event_id",
            4 => "no_of_booking",
            5 => "booking_unit_amount",
            6 => "applicable_tax_amount",
            7 => "booking_total_amount",
            8 => "points_used",
            9 => "booking_payable_amount",
            10 => "status",
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
                      ->orWhere("booking_user_id", "LIKE", "%{$search}%")
                        ->orWhere("event_user_id", "LIKE", "%{$search}%")
                        ->orWhere("event_id", "LIKE", "%{$search}%")
                        ->orWhere("no_of_booking", "LIKE", "%{$search}%")
                        ->orWhere("booking_unit_amount", "LIKE", "%{$search}%")
                        ->orWhere("applicable_tax_amount", "LIKE", "%{$search}%")
                        ->orWhere("booking_total_amount", "LIKE", "%{$search}%")
                        ->orWhere("points_used", "LIKE", "%{$search}%")
                        ->orWhere("booking_payable_amount", "LIKE", "%{$search}%")
                        ->orWhere("status", "LIKE", "%{$search}%");
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
                $nestedData["booking_user_id"] = $list->booking_user_id;
                $nestedData["event_user_id"] = $list->event_user_id;
                $nestedData["event_id"] = $list->event_id;
                $nestedData["no_of_booking"] = $list->no_of_booking;
                $nestedData["booking_unit_amount"] = $list->booking_unit_amount;
                $nestedData["applicable_tax_amount"] = $list->applicable_tax_amount;
                $nestedData["booking_total_amount"] = $list->booking_total_amount;
                $nestedData["points_used"] = $list->points_used;
                $nestedData["booking_payable_amount"] = $list->booking_payable_amount;
                $nestedData["status"] = $list->status;
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
        $eventOrderData = $request->validate([
            'event_id'=>'required|numeric',
            'no_of_booking'=>'required|numeric',
            'points_used'=>'required|numeric',
        ]);
        // Sanitize input
        $sanitized = $request->all();

        //validate event available
        $event = Event::where(['id' => $sanitized['event_id']])
            ->where(['active' => true])
            ->first();
        
        if($event){
            if($event->event_remaining_tickets > 0 && $event->event_remaining_tickets >= $sanitized['no_of_booking']){
                //check available points
                $user = User::where(['id' => $request->user()->id])->first();
                if($user){
                    if($user->available_points >= $sanitized['points_used']){
                        $sanitized['booking_user_id'] = $request->user()->id;
                        $sanitized['event_user_id'] = $event->user_id;
                        $sanitized['booking_unit_amount'] = $event->event_ticket_amount - $event->event_ticket_discount_amount;
                        $sanitized['applicable_tax_amount'] = env('CUSTOM_SETTING_TAX_TICKETING');
                        $sanitized['booking_total_amount'] = ($sanitized['booking_unit_amount'] * $sanitized['no_of_booking']) + (($sanitized['booking_unit_amount'] * $sanitized['no_of_booking']) * env('CUSTOM_SETTING_TAX_TICKETING') / 100);
                        $sanitized['booking_payable_amount'] = $sanitized['booking_total_amount'] - ($sanitized['points_used'] / env('CUSTOM_SETTING_CONVERT_TO_CAD'));
                        $sanitized['status'] = 'Pending';

                        // Store the EventsOrder
                        $eventsOrder = EventsOrder::updateOrCreate([
                            "booking_user_id" => $sanitized['booking_user_id'],
                            "event_id" => $sanitized['event_id'],
                            "status" => $sanitized['status']
                        ],$sanitized);

                        if($request->route()->getPrefix() === 'api'){
                            $eventData = EventsOrder::where(['id' => $eventsOrder->id])->first();
                            return response()->json([
                                "code" => 200,
                                "data" => $eventData,
                                "message" => "Successfully added record",
                            ]);
                        } else {
                            return redirect()->route("events-orders.index");
                        }
                    } else {
                        if($request->route()->getPrefix() === 'api'){
                            return response()->json([
                                "code" => 501,
                                "message" => "You do not have sufficient points available",
                            ]);
                        } else {
                            return redirect()->route("events-orders.index");
                        }
                    }
                } else {
                    if($request->route()->getPrefix() === 'api'){
                        return response()->json([
                            "code" => 501,
                            "message" => "Invalid user",
                        ]);
                    } else {
                        return redirect()->route("events-orders.index");
                    }
                }
            } else {
                if($request->route()->getPrefix() === 'api'){
                    return response()->json([
                        "code" => 501,
                        "message" => "No tickets available",
                    ]);
                } else {
                    return redirect()->route("events-orders.index");
                }
            }
        } else {
            return response()->json([
                "message" => "Invalid event booking",
                "code" => 501,
                "data" => [],
            ]);
        }
    }

    public function verifyBooking(Request $request)
    {
        $eventOrderData = $request->validate([
            'event_id'=>'required|numeric',
            'booking_id'=>'required|numeric',
            'booking_user_id'=>'required|numeric',
        ]);

        $sanitized = $request->all();

        $eventOrder = EventsOrder::where([
            "booking_user_id" => $sanitized['booking_user_id'],
            "event_id" => $sanitized['event_id'],
            "id" => $sanitized['booking_id'],
            "event_user_id" => $request->user()->id,
            "status" => "Booked",
        ])->first();

        if($eventOrder){
            $eventOrder->update([
                "status" => "Scanned"
            ]);

            return response()->json([
                "code" => 200,
                "message" => "Successfully validated booking",
                "data" => [
                    "no_of_booking" => $eventOrder['no_of_booking']
                ]
            ]);
        } else {
            return response()->json([
                "message" => "Invalid booking",
                "code" => 501,
                "data" => [],
            ]);
        }
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