<?php
//archivo donde carga las dependencias 
require_once(__DIR__ . '\..\vendor\autoload.php');
 
//trae un shingo de objetos bien bonis jiji :3
$app = new \Slim\App;

 
//DB conn
$db = new mysqli('localhost', 'root', '', 'product_store');
 

//Get Users (este si sirve)
 
$app->get('/users',function() use($db,$app){
    $sql='SELECT * FROM users ORDER BY id DESC;';
    $select=$db->query($sql);    
    $users=array();

    while($user=$select->fetch_assoc()){
        $users[]=$user;
    }
 
    $result= array(
        'status' => 'success',
        'code'=> 200,
        'data'=> $users
    );
  
    echo json_encode($result);  
});

use Psr\Http\Message\ServerRequestInterface;

//Insert(aqui fale ferga la fida )

$app->post('/users', function (ServerRequestInterface $request) use($app,$db) {

    $params = $request->getParsedBody();

    $json = json_decode($params['json'], true);

   // die(var_dump($json)); 
/*

    //validacion pitera
    if(!isset($json['email'])){
        $json['email']=null;
    }

    if(!isset($json['password'])){
        $json['password']=null;

    }

    if(!isset($json['name'])){
        $json['name']=null;

    }

    if(!isset($json['lastname'])){
        $json['lastname']=null;

    }

    if(!isset($json['username'])){
        $json['username']=null;

    }
*/
    $sql="INSERT INTO users VALUES(NULL,".
    "'{$json["email"]}',".
    "'{$json["password"]}',".
    "'{$json["name"]}',".
    "'{$json["lastname"]}',".
    "'{$json["username"]}'".
    ")";
    
   //die(var_dump($sql)); //json que verifica si trae algo
    $insert = $db->query($sql);

    //die(var_dump( $insert));
    if ($insert) {
        $result = array("status" => "true","code"=>"200", "message" => "User created succesfully");
    } else {
        $result = array("status" => "false","code"=>"404", "message" => "User not created,something went wrong");
    }
    echo json_encode($result);

   
});

 //run it my boy(correla mi chavo)
$app->run();
?>