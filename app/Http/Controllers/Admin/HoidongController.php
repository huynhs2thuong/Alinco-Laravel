<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\SaveHoidong;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Resource;
use App\Module;
use App\Contacts;
use Session;
use Carbon\Carbon;

class HoidongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $total = Post::where('desc_vn','hoidong')->count('id');
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
            # Pagination
            
            # Search title
            if ('' !== $search = $request->search['value']) {
                $query = $query->whereRaw("UPPER(title) LIKE UPPER('%{$search}%')");
                $filtered = $query->count();
            }
            $posts = $query->where('desc_vn','hoidong')->orderBy('ordering','asc')->orderBy('created_at','asc')->skip($request->start)->take($request->length)->get();
            # Output
            $rows = [];
            foreach ($posts as $post) {
                if($post->desc_en == '1' || $post->desc_en == '')
                $rows[] = [
                    NULL,
                    link_to(action('Admin\HoidongController@edit', $post->id), $post->title)->toHtml(),
                    '<div class="order-input"><input style="width:auto;max-width:45px;text-align:center;border: 1px solid #ddd;margin:0" class="inputvalue" type="text" value="'.$post->ordering.'"><input type="hidden" class="postid" data-value="'.$post->id.'"></div>',
                    $post->excerpt,
                    empty($post->user) ? '' : $post->user->name,
                    $post->updated_at,
                     link_to(action('Admin\HoidongController@edit', $post->id), trans('admin.button.edit'), ['class' => 'waves-effect waves-light btn btn-sm'])->toHtml()
                ];
            }
            // var_dump($rows);die;
            return response()->json([
                'data'            => $rows,
                "recordsTotal"    => $total,
                'recordsFiltered' => isset($filtered) ? $filtered : $total,
                'categories'      => $categories
            ]);
        }

        // $categories = Category::orderBy('id', 'asc')->get()->pluck('title', 'id');
        // $modules = Module::where('cid','>',0)->orderBy('id', 'asc')->get()->pluck('title', 'cid');
        return view('admin.hoidong.index');
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
        return view('admin.hoidong.create', compact('post', 'categories','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveHoidong $request)
    {
        $data = $request->all();
        if(!empty($value["created_at"])){
            $value["created_at"] = explode('/',$value["created_at"]);
            $temp = $value["created_at"][0];
            $value["created_at"][0] = $value["created_at"][1];
            $value["created_at"][1] = $temp;
            $value["created_at"] = implode('/',$value["created_at"]);
            $value["created_at"] = Carbon::parse($value["created_at"])->format('Y-m-d H:i:s');
        }
        if($data['ordering'] == NULL){
            $data['ordering'] = 0;
        }
        $data['cid'] = 0;
        $data['alias_vn'] = $request->slug['vi'];
        $data['alias_en'] = $request->slug['en'];
        $description = preg_replace("/\r\n|\r|\n/", '<br>',$data['excerpt']);
        $data['excerpt'] =  $description;
        var_dump($data['excerpt']);
        $new = Post::create($data);

        Session::flash('response', ['status' => 'success', 'message' => trans('admin.message.create')]);
        return redirect()->action('Admin\HoidongController@edit', $new->id);
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
        $value = $request->all();
        if(!empty($value["created_at"])){
            $value["created_at"] = explode('/',$value["created_at"]);
            $temp = $value["created_at"][0];
            $value["created_at"][0] = $value["created_at"][1];
            $value["created_at"][1] = $temp;
            $value["created_at"] = implode('/',$value["created_at"]);
            $value["created_at"] = Carbon::parse($value["created_at"])->format('Y-m-d H:i:s');
        }
        $post = new Post($value);
        
        if (empty($post->resource_id)) $post->resource_id = NULL;
        $others = Post::with('resource')->whereHas('categories', function($query) use($post, $category_id) {
            $query->where('categories.id', $category_id);
        })->orderBy('id', 'desc')->take(6)->get();
        return view('site.hoidong', compact('post', 'others'));
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
        // if($post->cat_id != '')
        //     $post->category = $post->category->pluck('id')->all();
        $categories = Category::orderBy('id', 'desc')->get(['id', 'title','cid']);
        $ids = $post->gallery;
        if($ids){
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $gallery = empty($ids) ? [] : Resource::whereIn('id', $ids)->orderByRaw("field(id,{$placeholders})", $ids)->get(); 
        }else{
            $gallery=[];
        }
        
        return view('admin.hoidong.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveHoidong $request, $id)
    {
        $post = Post::findOrFail($id);
        
        //Định dạng ngày đăng tin trước khi lưu
        $value = $request->all();
        if(!empty($value["created_at"])){
            $value["created_at"] = explode('/',$value["created_at"]);
            $temp = $value["created_at"][0];
            $value["created_at"][0] = $value["created_at"][1];
            $value["created_at"][1] = $temp;
            $value["created_at"] = implode('/',$value["created_at"]);
            $value["created_at"] = Carbon::parse($value["created_at"])->format('Y-m-d H:i:s');
        }
        $description = preg_replace("/\r\n|\r|\n/", '<br>',$value['excerpt']);
        $value['excerpt'] =  $description;
        $value['cid'] = 0;
        $post->update($value);
        //$post->categories()->sync($request->categories);
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
        return redirect()->action('Admin\HoidongController@index');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->categories = $post->categories->pluck('id')->all();
        $datas = $post->toArray();
        return view('view', compact('datas'));
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


    public function export_download_file($action='export_user',$file_id=''){
        if(!empty($file_id)){
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment; filename={$file_id}.xlsx");
            $export_file = '';
                $export_file = BASEFOLDER.'statics/uploads/export_user/'.$file_id.'.xlsx';
            
            echo file_get_contents($export_file);
        }
    }
    
    public function ajaxExport(){

        // $this->is_testing = (int)$this->input->post('is_testing');
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        
        set_time_limit(0);
        ini_set('memory_limit','2048M');
        $json_data = array(
            'result' => '',
            'file_name' => ''
        );
        $this->get_export_data_excel();
        $json_data = $this->write_export_excel_data();//cpm
        echo json_encode($json_data);
    }
    
    private function get_export_data_excel(){
       
        $list_contants = Contacts::orderBy('id','desc');

        // $this->load->model('Admincp_users/Admincp_users_model');
        // $data_list='';
        
            
        // //1. danh sách plan đến cửa hàng (upload_time)
       
        // $query_user='name, email, phone, location,level, ask,graduation, created, utm_source, created,utm_medium,utm_campaign,utm_term,utm_content';
        // $query = $this->db->select("$query_user")
        //     ->from('admin_nqt_user_info')->order_by('created', 'asc');
        // $data_list = $query->get()->result_array();
        // //pr($data_list,1);
        
        // $this->data_list = $data_list;
        
       
    }
    
    private function write_export_excel_data(){

        $json_data = array();
        $flag = false;
        $user = $this->session->userdata('userInfo');

        if(!empty($this->data_list)){
            $file_name = 'VNW_Export_user';
            $file_name_customer = 'VNW_Export_user_customer';
            if($user == 'admin'||$user =='root'){
                $template_file = BASEFOLDER.'statics/uploads/export/'.$file_name.'.xlsx';
            }
            else{
                $template_file = BASEFOLDER.'statics/uploads/export/'.$file_name_customer.'.xlsx';
            }
            
            if(!file_exists($template_file))
                return;
            
            //Clone Template
            $now = date('Y_m_d_H_i_s');
            if($user == 'admin'||$user =='root'){
                $export_file_name = "VNW_thong_tin_user".str_replace("export_user", "", $file_name)."_{$now}.xlsx";
            }
            else{
                $export_file_name = "VNW_thong_tin_user".str_replace("export_user", "", $file_name_customer)."_{$now}.xlsx";
            }
            
            $export_file = BASEFOLDER.'statics/uploads/export_user/'.$export_file_name;
           
            if(!file_exists($export_file)){

                @unlink($export_file);
            }
            
            if(copy($template_file, $export_file)){

                $objReader = phpexcel_get_obj_reader(false);
                $objPHPExcel = $objReader->load($export_file);
                $this->objSheet = $objPHPExcel->getActiveSheet();
                
                $this->start_row = 2; // View above, start row based on template type
                $this->row = $this->start_row;
              
                $stt = 0;
                foreach($this->data_list as  $data) {
                    $stt++;
                    $this->row_data = array();
                    $this->column = 0;
                    $this->row_data[] = $stt; $this->column++; // STT,                   
                    $this->row_data[] = $data['name']; $this->column++;
                    $this->row_data[] = $data['email']; $this->column++; // 
                    $this->row_data[] = ' '.$data['phone']; $this->column++; 
                    $this->row_data[] = $data['graduation']; $this->column++; 
                    $this->row_data[] = $data['location']; $this->column++; 
                     $this->row_data[] = $data['level']; $this->column++;
                    $this->row_data[] = $data['ask']; $this->column++; 
                    $this->row_data[] = $data['created']; $this->column++;
                    //pr($this->row_data,1);
                    $this->objSheet->fromArray($this->row_data, NULL, excel_get_cell_address(0,$this->row));
                    $this->row++;                  
                }
              
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save($export_file);
                
                $json_data['file_name'] = str_replace(".xlsx",'', $export_file_name);
                $flag = true;
            }
        }
        
        //kiểm tra trạng thái
        if ($flag == true) {
            $json_data['status'] = 'success';
            $json_data['message'] = 'Xuất dữ liệu thành công';
        }elseif ($flag == false) {
            $json_data['status'] = 'fail';
            $json_data['message'] = 'Không có dữ liệu';
           
        }
       
        return $json_data;
    }   

}
