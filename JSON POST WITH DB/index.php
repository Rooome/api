<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../src/vendor/autoload.php';
$app = new \Slim\App;

// ...

// Endpoint to insert data into the database (postName)
$app->post('/postName', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody());
    $fname = $data->fname;
    $lname = $data->lname;

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO names (fname, lname) VALUES ('$fname', '$lname')";
        $conn->exec($sql);

        $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
    $conn = null;
    return $response;
});

// Endpoint to extract data from the database (getName)
$app->get('/getName', function (Request $request, Response $response, array $args) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM names";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            array_push($data, array("lname" => $row["lname"], "fname" => $row["fname"]));
        }
        $data_body = array("status" => "success", "data" => $data);
        $response->getBody()->write(json_encode($data_body));
    } else {
        $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
    }
    $conn->close();
    
    return $response;
});

// Endpoint to update data in the database (updateName)
$app->post('/updateName', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody());
    $id = $data->id;
    $fname = $data->fname;
    $lname = $data->lname;

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "UPDATE names SET fname='$fname', lname='$lname' WHERE id=$id";
        $conn->exec($sql);

        $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
    $conn = null;
    return $response;
});

// Endpoint to delete data from the database (deleteName)
$app->post('/deleteName', function (Request $request, Response $response, array $args) {
    $data = json_decode($request->getBody());
    $id = $data->id;

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DELETE FROM names WHERE id=$id";
        $conn->exec($sql);

        $response->getBody()->write(json_encode(array("status" => "success", "data" => null)));
    } catch (PDOException $e) {
        $response->getBody()->write(json_encode(array("status" => "error", "message" => $e->getMessage())));
    }
    $conn = null;
    return $response;
});

$app->run();
?>