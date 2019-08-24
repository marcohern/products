<?php

namespace Marcohern\Products\Exceptions;

class ProductNotFoundException extends ProductException {
  protected $status = 404;
}