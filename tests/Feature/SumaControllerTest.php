<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\SumaController;
use Illuminate\Http\Request;

class SumaControllerTest extends TestCase
{
    public function testSumar()
    {
        $controller = new SumaController();

        $request = Request::create('/sumar/3/5', 'GET');
        $response = $controller->sumar(3, 5);
        $data = $response->getData();
        $this->assertEquals(8, $data->suma);

        $request = Request::create('/sumar/-3/5', 'GET');
        $response = $controller->sumar(-3, 5);
        $data = $response->getData();
        $this->assertEquals(2, $data->suma);

        $request = Request::create('/sumar/-3/-5', 'GET');
        $response = $controller->sumar(-3, -5);
        $data = $response->getData();
        $this->assertEquals(-8, $data->suma);
    }
}
