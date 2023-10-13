<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../src/vendor/autoload.php';

$app = new \Slim\App;

//endpoint get orgstructure
$app->get('/orgstructure', function (Request $request, Response
$response, array $args) {

    $args['DMMMSU Org Chart 2019'] = array(
        array("President" => "Dr. Jaime I. Manuel Jr"),
        array("University Secretary" => "Dr. Antonio O. Ogbinar"),
        array(
            "Vice President Academic Affairs" => "Dr. Elsie M. Pacho",
            "OIC-Director, Instruction" => "Prof. Laiza T. Astodillo",
            "Student Affairs and Services" => "Dr. Shalimar L. Navalta, Director",
            "Director, Sports" => "Dr. Paulo Jan F. Samson",
            "Director, Cultural Affairs" => "Prof. Irene N. Gomez",
            "Director, National Service Training Program" => "Dr. Loida M. Faller",
            "Library Services & Development" => "Dr. Sonia B. Siago, Director",
            "Director Student Admissions & Records" => "Dr. Valoree M. Salamanca",
            "Director, Alumni Affairs" => "Dr. Lher Verell S. Palabay",
            "Director, Internalization, Linkages, and ETEEAP" => "Dr. Jesus Rafael B. Jaratam"
        ),
        array(
            "Vice President Research and Extension" => "Dr. Angeline T. Gonzales",
            "Director, Research" => "Prof. Kenneth G. Bayani",
            "Director, Extension" => "Prof. Emerlita D. Galiste",
        ),
        array(
            "Vice President Administration" => "Dr. Antonio O. Ogbinar",
            "Director, Administrative Services" => "Atty. Kristine Gay B. Balanag",
            "Director, Auxiliary Services" => "Florendo Q. Damasco Jr",
            "Director, Finance Services" => "Dr. Placida E. De Guzman",
            "Director, Medical Services" => "Dr. Ma. Consuelo w. Alcantara",
            "Director, Internal Quality Assurance System" => "Dr. Angelita J. Parado"
        ),
        array(
            "Vice President, Planning & Resource Development" => "Dr. Priscilo P. Fontanilla",
            "Director, Management Information Systems" => "Dr. Stephan Kupsch, Director",
            "Director, Business Affairs" => "Prof. Melchor D. Salom",
            "Director, Planning and Development" => "Prof. Lilito D. Gavina",
            "Director, Resource Development & GAD Focal Person" => "Dr. Sherlyn Marie D. Nitura"
        ),
        array(
            "Chancellor, North La Union Campus" => "Dr. Junifer Rey E. Tabafunda",
            "Chancellor, Mid La Union Campus" => "Dr. Eduardo C. Copruz",
            "Chancellor, South La Union Campus" => "Dr. Joanne C. Rivera",
            "Executive Director Open University System" => "Dr. Cristita G. Guerra",
            "Executive Director Sericulture Research & Development Institute" => "Dr. Cristeta F. Gapuz",
            "Executive Director National Apiculture Research Training & Development Institute" => "Dr. Gregory B. Viste"
        )
    );
    //echo json_encode($args);


    echo json_encode($args, JSON_PRETTY_PRINT); //encode values to json format

    /*
   $data = json_encode($args);
    $response = $response
        ->withHeader('Content-Type', 'application/json');    // Set customize headers

    $response->getBody()->write($data); // write response with a custom header 

    return $response; //print in json apphend format  */


});

$app->run();
?>