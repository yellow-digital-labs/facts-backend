@php echo "
<?php";
@endphp


namespace {{ $controllerNamespace }};

use App\Http\Controllers\Controller;
use {{ $modelFullName }};
use Exception;
use Illuminate\Http\Request;
@if (count($relations))
@if (count($relations['belongsToMany']))
@foreach($relations['belongsToMany'] as $belongsToMany)
use {{ $belongsToMany['related_model'] }};
@endforeach
@endif
@endif
use Auth;
use DB;
use Redirect;

class {{ $controllerBaseName }} extends Controller
{
    public function index()
    {
        // $user_id = Auth::user()->id;
        // create and AdminListing instance for a specific model and
        return view('admin.{{ $modelDotNotation }}.index', [
          '{{ $modelVariableName }}' => null
        ]);
    }

    public function list(Request $request){
        $columns = [
@php
        $count = 1;
@endphp
@foreach($columns as $column)
            {{$count}} => "{{$column['name']}}",
@php
            $count++;
@endphp
@endforeach
        ];

        $f = {{$modelBaseName}}::where([]);
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
                $q = {{$modelBaseName}}::where([]);

                foreach ($applied_filters as $field => $search) {
                    $q->where($field, "LIKE", "%{$search}%");
                }
            } else {
                $q = {{$modelBaseName}}::where([]);
            }
        } else {
            $search = $request->input("search.value");

            $q = {{$modelBaseName}}::where(function ($query) use ($search) {
                return $query
@foreach($columns as $avail => $column)
  @if($avail == 0)
                    ->where("{{$column['name']}}", "LIKE", "%{$search}%")
  @else
                    ->orWhere("{{$column['name']}}", "LIKE", "%{$search}%")
  @endif
@endforeach;
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
@foreach($columns as $column)
                $nestedData["{{$column['name']}}"] = $list->{{$column['name']}};
@endforeach
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
        // $this->authorize('admin.{{ $modelDotNotation }}.create');

@if (count($relations) && count($relations['belongsToMany']))
        return view('admin.{{ $modelDotNotation }}.create',[
@foreach($relations['belongsToMany'] as $belongsToMany)
            '{{ $belongsToMany['related_table'] }}' => {{ $belongsToMany['related_model_name'] }}::all(),
@endforeach
        ]);
@else
        return view('admin.{{ $modelDotNotation }}.create', [
          '{{ $modelVariableName }}' => null
      ]);
@endif
    }


    public function store(Request $request)
    {
        // Sanitize input
        $sanitized = $request->all();
        // $user_id = Auth::user()->id;
@foreach($columns as $column)
@if($column['type'] == 'boolean')
        $sanitized['{{$column['name']}}'] = isset($sanitized['{{$column['name']}}']) ? $sanitized['{{$column['name']}}'] : 0;
@endif
@endforeach

        // Store the {{ $modelBaseName }}
        ${{ $modelVariableName }} = {{ $modelBaseName }}::updateOrCreate([
            "id" => isset($sanitized['id']) ? $sanitized['id'] : null,
        ],$sanitized);

@if (count($relations))
@if (count($relations['belongsToMany']))
@foreach($relations['belongsToMany'] as $belongsToMany)
        // But we do have a {{ $belongsToMany['related_table'] }}, so we need to attach the {{ $belongsToMany['related_table'] }} to the {{ $modelVariableName }}
        ${{ $modelVariableName }}->{{ $belongsToMany['related_table'] }}()->sync(collect($request->input('{{ $belongsToMany['related_table'] }}', []))->map->id->toArray());
@endforeach

@endif
@endif

        return redirect()->route("{{ $resource }}.index");
    }

    public function show($id)
    {
        //
    }

    public function edit({{ $modelBaseName }} ${{ $modelVariableName }})
    {
        //$this->authorize('admin.{{ $modelDotNotation }}.edit', ${{ $modelVariableName }});

@if(in_array('created_by_admin_user_id', $columnsToQuery) || in_array('updated_by_admin_user_id', $columnsToQuery))
    @if(in_array('created_by_admin_user_id', $columnsToQuery) && in_array('updated_by_admin_user_id', $columnsToQuery))
        ${{ $modelVariableName }}->load(['createdByAdminUser', 'updatedByAdminUser']);
    @elseif(in_array('created_by_admin_user_id', $columnsToQuery))
        ${{ $modelVariableName }}->load('createdByAdminUser');
    @elseif(in_array('updated_by_admin_user_id', $columnsToQuery))
        ${{ $modelVariableName }}->load('updatedByAdminUser');
    @endif
@endif()

@if (count($relations))
@if (count($relations['belongsToMany']))
@foreach($relations['belongsToMany'] as $belongsToMany)
        ${{ $modelVariableName }}->load('{{ $belongsToMany['related_table'] }}');
@endforeach

@endif
@endif
        return view('admin.{{ $modelDotNotation }}.edit', [
            '{{ $modelVariableName }}' => ${{ $modelVariableName }},
@if (count($relations))
@if (count($relations['belongsToMany']))
@foreach($relations['belongsToMany'] as $belongsToMany)
            '{{ $belongsToMany['related_table'] }}' => {{ $belongsToMany['related_model_name'] }}::all(),
@endforeach
@endif
@endif
            'data' => ${{ $modelVariableName }},
            'id' => ${{ $modelVariableName }}->id
        ]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request, $id)
    {

        $data = {{ $modelBaseName }}::where(["id" => $id])->delete();

        if ($request->ajax()) {
            return response()->json([
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
                "code" => 200,
                "data" => [],
            ]);
        }
        return redirect()->route("{{ $resource }}");
    }
}