<?php

namespace App\Controller;

use App\Service\GeometryCalculator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShapeController
{
    /**
    * @Route("/triangle/{a}/{b}/{c}")
    */
    public function triangle(Request $request, GeometryCalculator $geometryCalculator): Response
    {
        $routeParams = $request->attributes->get('_route_params');
        $surface_area = $geometryCalculator->sum_area('triangle', ['a' => $routeParams['a'], 'b' => $routeParams['b'], 'c' => $routeParams['c']]);
        $circumference = $geometryCalculator->sum_diameter('triangle', ['a' => $routeParams['a'], 'b' => $routeParams['b'], 'c' => $routeParams['c']]);

        return $this->response_func(array(
            'type' => 'triangle',
            'a' => $routeParams['a'],
            'b' => $routeParams['b'],
            'c' => $routeParams['c'],
            'surface' => $surface_area,
            'circumference' => $circumference,
        ));
    }

    /**
    * @Route("/circle/{radius}")
    */
    public function circle(Request $request, GeometryCalculator $geometryCalculator): Response
    {

        $routeParams = $request->attributes->get('_route_params');

        $surface_area = $geometryCalculator->sum_area('circle', [$routeParams['radius']]);
        $circumference = $geometryCalculator->sum_diameter('circle', [$routeParams['radius']]);


        return $this->response_func(array(
            'type' => 'circle',
            'radius' => $routeParams['radius'],
            'surface' => $surface_area,
            'circumference' => $circumference,
        ));
        
    }

    public function response_func($data): Response {
        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}


// http://127.0.0.1:8000/triangle/3.0/4.0/5.0
// http://127.0.0.1:8000/circle/2