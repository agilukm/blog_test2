<?php 
use Test\TestCase;
use AlbertCht\Lumen\Testing\Concerns\InteractsWithRedis;
use AlbertCht\Lumen\Testing\Concerns\WithFaker;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\WithoutMiddleware;
class BlogTest extends AlbertCht\Lumen\Testing\TestCase
{
	public function testBrowse()
	{
		$response =	$this->call('get','/posts?filter[author][like]=me');
		$response->assertStatus(200);					
	}

	public function testRead()
	{
		$response = $this->call('get','/posts/'.App\Services\Post\Post::all()->random()->id);
		$response->assertStatus(200);	
	}

	public function testAdd()
	{		
		$response = $this->call('post','/posts/',['data'=>['title'=>'Some Test Title','author'=>'Some Test Author']]);		
		$response->assertStatus(200);			
	}

	public function testEdit()
	{
		$response = $this->call('patch','/posts/'.App\Services\Post\Post::all()->random()->id,['data'=>['title'=>'120','author'=>'you']]);
		$response->assertStatus(200);
	}

	public function testDelete()
	{
		$response = $this->call('delete','/posts/',['data'=>[['id'=>App\Services\Post\Post::all()->random()->id]]]);
		$response->assertStatus(200);
	}

	//its done
}
