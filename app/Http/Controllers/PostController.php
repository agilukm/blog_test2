<?php 

namespace App\Http\Controllers;
 
use App\Model\Post;
use App\Model\Meta;
use App\Services\Post\PostService;
use Illuminate\Http\Request;

class PostController extends Controller  {
 
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    
    public function browse(Request $request)
    {        
        $filters = $request->only('filter','orfilter');

        $params = [
            'page' => [
                'limit' => $request->input('limit')
            ],
            'filter' => $filters
        ];
        $data = $this->service->browse($params);
        return response()->json($data);
    }

    public function read($id)
    {
        $data = $this->service->read($id);
        return response()->json($data);
    }
    
    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'data.title' => 'required',
            'data.author' => 'required',
        ]);

        if ($this->service->edit($request->toArray(),$id)) {         
            return response()->json([
                'meta'      => [
                    'title' => $request->input('data.title'),
                    'author' => $request->input('data.author')
                ],
                'message' => 'Successfull update post'
            ]);
        }
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'data.title' => 'required',
            'data.author' => 'required',
        ]);
        if ($this->service->add($request->toArray())) {
            return response()->json([
                'meta'      => [
                    'title' => $request->input('data.title'),
                    'author' => $request->input('data.author')
                ],
                'message'   => 'Successfull save post'
            ]);            
        }        
    }    

    public function delete(Request $request)
    {        
        $deletedCount = 0;
        $ids = collect($request->input("data"))->pluck("id")->toArray();

        if (count($ids)) {
            $deletedCount = $this->service->delete($ids);    
        }

        return response()->json([
                'meta' => [
                    'deleted_count' => $deletedCount
                ],
            ]);        
    } 
}

?>