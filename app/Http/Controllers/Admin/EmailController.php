<?php

namespace App\Http\Controllers\Admin;

use App\Service;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests\SaveService;
use App\Http\Controllers\Controller;

use App\Category;
use App\Module;
use Session;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //$categories = Category::where('cid',9)->orderBy('id', 'asc')->get()->pluck('title', 'id');
        $categories = Category::orderBy('id', 'asc')->get()->pluck('title', 'id');
        $modules = Module::where('cid','>',0)->orderBy('id', 'asc')->get()->pluck('title', 'cid');
        if ($request->ajax()) {
            
            $total = Post::count('id');
            $query = Post::query();
            $categories = Category::orderBy('id', 'asc');
            # Category filter
            if ($request->has('module')) {
                $query->where('cid', $request->module);
                $filtered = $query->count();
                $categories = Category::orderBy('id', 'asc')->get()->pluck('id', 'cid');
            }
            if ($request->has('category')) {
                $query->where('cat_id', $request->category);
                $filtered = $query->count();
            }
            # Search title
            if ('' !== $search = $request->search['value']) {
                $query = $query->whereRaw("UPPER(title) LIKE UPPER('%{$search}%')");
                $filtered = $query->count();
            }
            # Order
            if ($request->has('order')) {
                $order_map = [
                    1 => 'title',
                    4 => 'id',
                ];
                $order = $request->order[0];
                $query = $query->orderBy($order_map[$order['column']], $order['dir']);
            } else $query = $query->orderBy('id', 'desc');
            # Pagination
            $posts = $query->where('desc_vn','email')->skip($request->start)->take($request->length)->get();
            # Output
            $rows = [];
            foreach ($posts as $post) {
                $rows[] = [
                    NULL,
                    link_to(action('Admin\EmailController@edit', $post->id), $post->title)->toHtml(),
                    $post->is_draft_html,
                    empty($post->user) ? '' : $post->user->name,
                    $post->created_at,
                    link_to(action('Admin\EmailController@edit', $post->id), trans('admin.button.edit'), ['class' => 'waves-effect waves-light btn btn-sm'])->toHtml()
                ];
            }
            return response()->json([
                'data'            => $rows,
                "recordsTotal"    => $total,
                'recordsFiltered' => isset($filtered) ? $filtered : $total,
                'categories'      => $categories,
            ]);
        }
        return view('admin.email.index', compact('categories','modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $post = new Post();
        $post->active = true;
        $post->categories = [];
        $categories = Category::orderBy('cid', 'asc')->get();
        $modules = Module::where('cid','>',0)->orderBy('id', 'asc')->get()->pluck('title', 'cid');
        return view('admin.email.create', compact('post', 'categories','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveService $request)
    {
       
        $data = $request->all();
        // var_dump($data);die;
        if(!empty($data["created_at"])){
            $data["created_at"] = explode('/',$data["created_at"]);
            $temp = $data["created_at"][0];
            $data["created_at"][0] = $data["created_at"][1];
            $data["created_at"][1] = $temp;
            $data["created_at"] = implode('/',$data["created_at"]);
            $data["created_at"] = Carbon::parse($data["created_at"])->format('Y-m-d H:i:s');
        }
        $data['alias_vn'] = $request->slug['vi'];
        $data['alias_en'] = $request->slug['en'];
        $data['cid'] = 0;
        $data['cat_id'] = 0;
        if($request->ordering){
            $data['ordering'] = $request->ordering;
        }
        else{
            $data['ordering'] = 0;
        }
        $data['desc_vn'] = 'email';
        //ver_old
        // $data['cid'] = 9;
        $new = Post::create($data);
       
        Session::flash('response', ['status' => 'success', 'message' => trans('admin.message.create')]);
        return redirect()->action('Admin\EmailController@edit', $new->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        $category_id = (int) $request->categories[0];
        $post = new Post($request->all());
        if (empty($post->resource_id)) $post->resource_id = NULL;
        $others = Post::with('resource')->whereHas('categories', function($query) use($post, $category_id) {
            $query->where('categories.id', $category_id);
        })->orderBy('id', 'desc')->take(6)->get();
        return view('site.post', compact('post', 'others'));
    }


    public function getCategory(Request $request){
        $mId = $request->mId;
        $query = Category::orderBy('cid','asc');
        if(isset($mId) && $mId > 0){
            $query = $query->where('cid', $mId);
        }
        $query = $query->pluck('id','id')->toArray();
        return response()->json($query);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::orderBy('id', 'desc')->get(['id', 'title','cid']);
        $modules = Module::where('cid','>',0)->orderBy('id', 'asc')->get()->pluck('title', 'cid');
        return view('admin.email.edit', compact('post', 'categories','modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveService $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        Session::flash('response', ['status' => 'success', 'message' => trans('admin.message.update')]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        Session::flash('response', ['status' => 'success', 'message' => trans('admin.message.delete')]);
        return redirect()->action('Admin\EmailController@index');
    }
}
