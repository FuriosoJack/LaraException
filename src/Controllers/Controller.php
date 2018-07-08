<?php


namespace FuriosoJack\LaraException\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Routing\Controller as BaseController;
/**
 * Class Controller
 * @package FuriosoJack\LaraException\Controllers
 * @author FuriosoJack <iam@furiosojack.com>
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

}