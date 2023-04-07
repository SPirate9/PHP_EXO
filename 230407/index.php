<?php

//AVEC TOKEN

session_start();
require __DIR__ . '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

try {
    $db = new PDO('mysql:host=localhost;dbname=twitter_api', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    response(["error" => "Échec de la connexion à la base de données : " . $e->getMessage()], 500);
}

function response($data, $status = 200) {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
function verifyToken() {
    if(!isset($_SESSION['token'])){
        response(["error" => "Non autorisé"], 401);
    }
    $key = 'CLéSECRETE';
    $jwt = $_SESSION['token'];
    header('Authorization: Bearer ' . $jwt);
    try {
        $decoded = JWT::decode($jwt, new key($key, 'HS256'));
    } catch (\Firebase\JWT\ExpiredException $e) {
        response(["error" => "Token expiré"], 401);
    } catch (\Exception $e) {
        response(["error" => "Erreur de décodage du token"], 500);
    }
}

$routes = [
    "/230407/login" => function() use ($db) {
        if(!isset($_POST['username'], $_POST['password'])) {
            response(["error" => "Paramètre manquant"], 400);
        }
            $stmt = $db->prepare("SELECT id, username FROM users WHERE username = :username AND password = :password");
            $stmt->execute(['username' => $_POST['username'], 'password' => $_POST['password']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user) {
                $key = 'CLéSECRETE';
                $payload = [
                    'iat' => time(),
                    'exp' => time() + (3600), 
                    //'exp' => time() + (10), 
                    //'exp' => time() + (20), 
                    //'exp' => time() + (35), 
                    'userid' => $user['id']
                ];
                $jwt = JWT::encode($payload, $key, 'HS256');
                $_SESSION['token'] = $jwt;
                $_SESSION['userid'] = $user['id'];
                response(["token" => $jwt]);
            } else {
                response(["error" => "Mot de passe ou identifiant incorrect"], 401);
            }
        },

    "/230407/createPost"=> function() use ($db) {
        verifyToken();     
        if(!isset($_POST['message'])) {
            response(["error" => "Paramètre manquant"], 400);
        }
            $stmt = $db->prepare("INSERT INTO posts (author_id,created_at,content) VALUES (:id,NOW(),:message)");
            $stmt->execute(['id' => $_SESSION['userid'], 'message' => $_POST['message']]);
            response(["success" => true]);
        },
    
    "/230407/deletePost/([0-9]+)" => function($id) use ($db) {
        verifyToken();     
        $stmt = $db->prepare("DELETE FROM posts WHERE id=:id");
        $stmt->execute(['id' => $id]);
        response(["success" => true]);
    },
    
    "/230407/showLastPosts"=> function() use ($db) {
        $stmt = $db->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 10");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        response($posts);
    },

    "/230407/getPost/([0-9]+)"=> function($id) use ($db) {
        $stmt = $db->prepare("SELECT * FROM posts WHERE id=:id");
        $stmt->execute(['id' => $id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($post) {
            response($post);
        } else {
            response(["error" => "Post introuvable"], 404);
        }
    }
];

foreach ($routes as $route => $endpoint) {
    if(preg_match("#^$route$#", $_SERVER['REQUEST_URI'], $matches)) {
        array_shift($matches);
        $result = call_user_func_array($endpoint, $matches);
        response($result);
    }
}

response(["error" => "Endpoint does not exist"], 404);