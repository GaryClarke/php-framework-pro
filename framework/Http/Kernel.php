<?php

namespace GaryClarke\Framework\Http;

use GaryClarke\Framework\Routing\Router;

class Kernel
{
    public function __construct(private Router $router)
    {
    }

    public function handle(Request $request): Response
    {
        try {

            [$routeHandler, $vars] = $this->router->dispatch($request);

            $response = call_user_func_array($routeHandler, $vars);

        } catch (HttpRequestMethodException $exception) {
            $response = new Response($exception->getMessage(), 405);
        } catch (HttpException $exception) {
            $response = new Response($exception->getMessage(), 404);
        } catch (\Exception $exception) {
            $response = new Response($exception->getMessage(), 500);
        }

        return $response;
    }
}