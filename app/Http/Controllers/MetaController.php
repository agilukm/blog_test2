<?php 

namespace App\Http\Controllers;
 
use App\Model\Post;
use App\Model\Meta;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class MetaController extends Controller  {
 
    public function index(Request $post_id)
    {
        $data = Meta::where('id',$post_id);
        return response()->json($data);
    }
    
    public function browse($per_page)
    {
        $data = Meta::paginate($per_page);
        return response()->json($data);
    }

    public function delete(Request $value)
    {
        if ($value!='') {
            Meta::destroy($value);
            return response()->json([
                'message' => 'Successfull delete meta'
            ]);
        }
    }

    public function update(Request $request, $meta_id)
    {
        $meta = Meta::find($meta_id);
        $meta->update($request->all());
 
        return response()->json([
            'message' => 'Successfull update meta'
        ]);
    }
    public function add(Request $request)
    {
        Meta::create($request->all());
        return response()->json(['message'=>'Successfull create meta']);
    }

 
}

// function browse read edit add delete

// browse pake pagination

// json object data
?>