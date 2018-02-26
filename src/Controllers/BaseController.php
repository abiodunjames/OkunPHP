<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Http\Auth\AuthenticationTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class BaseController implements ContainerAwareInterface
{
    use ContainerAwareTrait,AuthenticationTrait;


}
