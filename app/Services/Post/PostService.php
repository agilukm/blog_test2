<?php 

namespace App\Services\Post;

class PostService
{

	private $repository;

	

	public function __construct(Post $repository)
	{
		$this->post = $repository;

	}



	public function browse($query = [])
	{
		$allowedOperators = [
	        'eq' => '=',
	        'gt' => '>',
	        'gte' => '>=',
	        'lt' => '<',
	        'lte' => '<=',
	        'like' => 'Like',
	        'notlike' => 'Not Like',
	        'notin' => 'NotIn',
	        'in' => 'In',
    	];

		$appends = [];
		$post = $this->post;

		if ($query['filter']) {
			foreach ($query['filter'] as $filter => $value) {								
				foreach ($value as $field => $value_field) {
					foreach ($value_field as $key => $keyword) {
					
						if ($key == 'like' || $key == 'notlike') {
							$post = $post->where($field,$allowedOperators[$key],'%'.$keyword.'%');						
						}
					
						elseif($key == 'is')
						{
							$post = $post->where($field,$keyword);
						}		
					
						else
						{
							$post = $post->where($field,$allowedOperators[$key],$keyword);
						}				
					
						$appends['filter'][$field][$key] = $keyword;
					}
				}
			}
		}
		
		if ($query['page']['limit']) {
			$appends['limit']=$query['page']['limit'];
		}

		return $post->with('meta')->paginate($query['page']['limit']??20)->appends($appends);					
	}

	public function read($id)
	{
		return $this->post->find($id);
	}

	public function edit($attributes,$id)
	{
		$post = $this->read($id);
		$post->fill($attributes['data']);
		$post->save();
		return $post;
	}

	public function add($attributes = [])
	{
		$post = $this->post->fill($attributes['data']);
		$post->save();
		return $post;
	}

	public function delete($ids = [])
	{
		$deleted = $this->post->destroy($ids);
		return $deleted;
	}

}