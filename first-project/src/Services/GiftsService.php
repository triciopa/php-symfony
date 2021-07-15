<?php
namespace App\Services;

use Psr\Log\LoggerInterface;

class GiftsService
{
  public $gifts = ['flowers','car','piano','money','bricks'];
    
  public function __construct(LoggerInterface $logger)
  {
    $logger->info('Gifts were randomized'); // var/cache/log/dev.log

    shuffle($this->gifts);
  }
}