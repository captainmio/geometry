<?php
namespace App\Service;

class GeometryCalculator {

    public function sum_area(String $shape, Array $data) {
        $result = 0;
        switch($shape) {
            case 'triangle':
                $result = ($data['a'] + $data['b'] + $data['c']) * ((-1 * abs($data['a'])) + $data['b'] + $data['c']) * (($data['a']) - $data['b'] + $data['c']) * (($data['a']) + $data['b'] - $data['c']);
                $result = sqrt($result);
                $result = 0.25 * $result;
                $result = number_format($result, 1);
                break;
            case 'circle':
                $diameter = 2 * $data[0];
                $result = pow(($diameter/2), 2);
                $result = 3.14 * $result;
                break;

        }

        return $result; ;
    }

    public function sum_diameter(String $shape, Array $data) {
        $result = 0;
        switch($shape) {
            case 'triangle':
                $result = $data['a'] + $data['b'] + $data['c'];
                $result = number_format($result, 1);
                break;
            case 'circle':
                $result = (2 * 3.14) * $data[0];
                break;

        }

        return $result;
    }
}