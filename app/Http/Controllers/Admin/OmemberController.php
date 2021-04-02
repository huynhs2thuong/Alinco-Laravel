<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Page;
use App\Resource;
use Illuminate\Http\Request;
use App\Http\Requests\SaveProject;
use App\Http\Controllers\Controller;
use App\Project;
use App\Category;
use Carbon\Carbon;

use Session;

class OmemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //print_r(Project::all());die();
        try {

        $categories = Category::where('type','project')->orderBy('id', 'desc')->get()->pluck('title', 'id');
        if ($request->ajax()) {
            $total = Project::where('render','1')->count('id');
            $query = Project::query();

            # Category filter
            if ($request->has('category')) {
                $query->where('cat_id', $request->category);
                $filtered = $query->count();
            }
            // # Search title
            if ('' !== $search = $request->search['value']) {
                $query = $query->whereRaw("UPPER(title) LIKE UPPER('%{$search}%')");
                $filtered = $query->count();
            }
            // # Order
            if ($request->has('order')) {
                $order_map = [
                    1 => 'title',
                    4 => 'id',
                ];
                $order = $request->order[0];
                $query = $query->orderBy($order_map[$order['column']], $order['dir']);
            } else $query = $query->orderBy('sticky', 'desc')->orderBy('ordering','asc')->orderBy('created_at','desc')->orderBy('id', 'desc');
            // # Pagination
            $posts = $query->where('render','1')->skip($request->start)->take($request->length)->get();
            # Output
            $rows = [];
            foreach ($posts as $post) {
                
                $rows[] = [
                    NULL,
                    link_to(action('Admin\OmemberController@edit', $post->id), $post->title)->toHtml(),
                    '<div class="order-input"><input style="width:auto;max-width:45px;text-align:center;border: 1px solid #ddd;margin:0" class="inputvalue" type="text" value="'.$post->ordering.'"><input type="hidden" class="postid" data-value="'.$post->id.'"></div>',
                 //  empty($post->hot_news == 0) ? '<input type="checkbox" disabled class=" select-checkbox">' : '',
                    empty($post->user) ? '' : $post->user->name,
                    $post->created_at,
                    link_to(action('Admin\OmemberController@edit', $post->id), trans('admin.button.edit'), ['class' => 'waves-effect waves-light btn btn-sm'])->toHtml(),
                ];
            }
            return response()->json([
                'data'            => $rows,
                "recordsTotal"    => $total,
                'recordsFiltered' => isset($filtered) ? $filtered : $total
            ]);
        }
        return view('admin.other.index', compact('categories'));

        } catch (\Exception $e) {
            return 'Error: '.$e->getMessage().' Line: '.$e->getLine();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Project();
        $post->active = true;
        $post->categories = [];
        $mcat_id = [];
        $investImg = NULL;
        $overviewImg = NULL;
        $gallery = '';
        $data['render'] = 1;
        $create = true; // biến thông báo với form hiện đang ở trang create
        $categories = Category::orderBy('id', 'desc')->where('type','project')->whereNotIn('id',['6'])->get();
        $list_page = Page::orderBy('id', 'desc')->where('id_pro','1')->get()->pluck('title', 'id')->all();// get list chương trình
        return view('admin.other.create', compact('post', 'categories','investImg','create','overviewImg','list_page','mcat_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveProject $request)
    {
        $data = $request->all();
        // if($data['cat_id']){
        //     $category = Category::find($data['cat_id']);
        //     $data['cid'] = $category->cid;
        // }
        if(!empty($data["created_at"])){
            $data["created_at"] = explode('/',$data["created_at"]);
            $temp = $data["created_at"][0];
            $data["created_at"][0] = $data["created_at"][1];
            $data["created_at"][1] = $temp;
            $data["created_at"] = implode('/',$data["created_at"]);
            $data["created_at"] = Carbon::parse($data["created_at"])->format('Y-m-d H:i:s');
        }
        $data['cid'] = 1;
        if($request->ordering){
            $data['ordering'] = $request->ordering;
        }
        else{
            $data['ordering'] = 0;
        }
        $data['slug_vn'] = $data['slug']['vi'];
        $data['slug_en'] = $data['slug']['en'];
        $data['render'] = 1;
        // var_dump($data);die;
        $data['overview_id'] = NULL;
        $data['mcat_id'] = $data['mcat_id'] ? $data['mcat_id'] : NULL;
        $data['invest_id'] = $data['invest_id'] ? $data['invest_id'] : NULL;
        $new = Project::create($data);
        Session::flash('response', ['status' => 'success', 'message' => trans('admin.message.create')]);
        return redirect()->action('Admin\OmemberController@edit', $new->id);
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
        $post = new Project($request->all());
        if (empty($post->resource_id)) $post->resource_id = NULL;
        $others = Project::with('resource')->whereHas('categories', function($query) use($post, $category_id) {
            $query->where('categories.id', $category_id);
        })->orderBy('id', 'desc')->take(6)->get();
        return view('site.post', compact('post', 'others'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Project::findOrFail($id);
        
        $categories = Category::orderBy('id', 'desc')->whereNotIn('id',['6'])->where('type','project')->get(['id', 'title']);
        $gallery = (array) $post->img_slide;
        $gallery = array_map('intval', $gallery);
        $gallery = Resource::whereIn('id', $gallery)->get();
        $mcat_id = (array) $post->mcat_id;
        $mcat_id = array_map('intval', $mcat_id);
        $investImg = $post->invest_id ? Resource::where('id', $post->invest_id)->first() : '';
        $investImg = $investImg ? '/uploads/thumbnail/'.$investImg->type.'/'.$investImg->name :'';
        $overviewImg = $post->overview_id ? Resource::where('id', $post->overview_id)->first() : '';
        $overviewImg = $overviewImg ? '/uploads/thumbnail/'.$overviewImg->type.'/'.$overviewImg->name :'';
        $list_page = Page::orderBy('id', 'desc')->get()->pluck('title', 'id')->all();// get list chương trình
        //var_dump($gallery);die;
        return view('admin.other.edit', compact('post', 'categories', 'gallery','investImg','overviewImg','list_page','mcat_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveProject $request, $id)
    {
        $post = Project::findOrFail($id);
        $data = $request->all();
        //$data['page_id'] = intval($data['page_id']);
        // var_dump(intval($data['page_id']));
         // var_dump($data );die;
        // if($data['cat_id']){
        //     $category = Category::find($data['cat_id']);
        //     $data['cid'] = $category->cid;
        // }
        if(!empty($data["created_at"])){
            $data["created_at"] = explode('/',$data["created_at"]);
            $temp = $data["created_at"][0];
            $data["created_at"][0] = $data["created_at"][1];
            $data["created_at"][1] = $temp;
            $data["created_at"] = implode('/',$data["created_at"]);
            $data["created_at"] = Carbon::parse($data["created_at"])->format('Y-m-d H:i:s');
        }
        $data['cid'] = 1;
        $data['slug_vn'] = $data['slug']['vi'];
        $data['slug_en'] = $data['slug']['en'];
        $data['ordering'] = $request->ordering;
       
        
        $data['mcat_id'] = $data['mcat_id'] ? $data['mcat_id'] : NULL;
        $data['invest_id'] = $data['invest_id'] ? $data['invest_id'] : NULL;
        //var_dump($data);die;
        $post->update($data);
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
        Project::destroy($id);
        Session::flash('response', ['status' => 'success', 'message' => trans('admin.message.delete')]);
        return redirect()->action('Admin\OmemberController@index');
    }

    public function show($id)
    {
        $post = Project::findOrFail($id);
        $post->categories = $post->categories->pluck('id')->all();
        $img_slide = (array) $post->img_slide;
        $img_slide = array_map('intval', $img_slide);
        $img_slide = Resource::whereIn('id', $img_slide)->select(['name'])->get();
        //$post->sliders = $img_slide->toArray();
        $datas = $post->toArray();
        return view('view', compact('datas'));
    }

    public function sortProject(Request $request){
        $values = $request->values;
        $ids = $request->ids;
        $i = 0;
        foreach($ids as $id){
            Project::where('id',$id)->update(['ordering'=>$values[$i]]);
            $i++;
        }
        $test = 'success';
        Session::flash('response', ['status' => 'success', 'message' => trans('admin.message.update')]);
        return response()->json($test);
    }
}
