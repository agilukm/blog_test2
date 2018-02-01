<?php
//Route Posts

$router->get('posts', 'PostController@browse');
$router->get('posts/{id:\d+}', 'PostController@read');
$router->patch('posts/{id:\d+}','PostController@edit');
$router->post('posts','PostController@add');
$router->delete('posts', 'PostController@delete');

//Tests


//Route Metas
//$router->get('metas/{per_page}', 'MetaController@browse');
?>