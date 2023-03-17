<?php
session_start();

try {
    $db = new PDO('mysql:host=localhost;dbname=twitter_api', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    response(["error" => "Échec de la connexion à la base de données"], 500);
}

function response($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

$routes=[
    "/230317/login" => function() use ($db) {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $stmt = $db->prepare("SELECT id, username FROM users WHERE username = :username AND password = :password");
            $stmt->bindParam(':username', $_POST['username']);
            $stmt->bindParam(':password', $_POST['password']);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user) {
                $_SESSION['userid'] = $user['id'];
                response(["success" => true]);
            } else {
                response(["error" => "Mot de passe ou identifiant incorrect"], 401);
            }
        } else {
            response(["error" => "Paramètre manquant"], 400);
        }
    },

    "/230317/createPost"=> function() use ($db) {
        if(isset($_POST['message'])){
            $stmt= $db->prepare("INSERT INTO posts (author_id,created_at,content) VALUES (:id,NOW(),:message)");
            $stmt->bindParam(':id', $_SESSION['userid']);
            $stmt->bindParam(':message', $_POST['message']);
            $stmt->execute();
            response(["success" => true]);
        }
        else{
            response(["error" => "Paramètre manquant"], 400);
        }
    },
    "/230317/deletePost/([0-9]+)"=> function($id) use ($db) {
        $stmt= $db->prepare("DELETE FROM posts WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        response(["success" => true]);
    },
    "/230317/showLastPosts"=> function() use ($db) {
        $stmt= $db->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT 10");
        $stmt->execute();
        $posts=$stmt->fetchAll(PDO::FETCH_ASSOC);
        response($posts);
    },
    "/230317/getPost/([0-9]+)"=> function($id) use ($db) {
        $stmt= $db->prepare("SELECT * FROM posts WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $post=$stmt->fetch(PDO::FETCH_ASSOC);
        if ($post) {
            response($post);
        } else {
            response(["error" => "Post introuvable"], 404);
        }
    }
];

foreach ($routes as $route => $endpoint){
    if(preg_match("#^$route$#",$_SERVER['REQUEST_URI'],$matches)){
        array_shift($matches);
        $result = call_user_func_array($endpoint, $matches);
        response($result);
    }
}

response(["error" => "Endpoint does not exist"], 404);

