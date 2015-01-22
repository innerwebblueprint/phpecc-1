<?php

namespace Mdanter\Ecc\Tests;

use Mdanter\Ecc\Math\Gmp;
use Mdanter\Ecc\Math\BcMath;
use Mdanter\Ecc\Random\RandomGeneratorFactory;
use Mdanter\Ecc\Math\MathAdapterFactory;

abstract class AbstractTestCase extends \PHPUnit_Framework_TestCase
{
    protected function _getAdapters(array $extra = null)
    {
        if (! defined('PHPUNIT_DEBUG')) {
            define('PHPUNIT_DEBUG', false);
        }

        if ($extra == null) {
            return array(
                array(MathAdapterFactory::getGmpAdapter(PHPUNIT_DEBUG)),
                array(MathAdapterFactory::getBcMathAdapter(PHPUNIT_DEBUG))
            );
        }

        $adapters = $this->_getAdapters(null);
        $result = [];

        foreach ($adapters as $adapter) {
            foreach ($extra as $value) {
                $result[] = array_merge($adapter, $value);
            }
        }

        return $result;
    }

    public function getAdapters()
    {
        return $this->_getAdapters();
    }
}
