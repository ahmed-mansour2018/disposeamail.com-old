<?php
namespace App\Module;


/**
 * Base abstract 'App' entity
 */
abstract class Entity extends \Spot\Entity
{
    public static function fields()
    {
        return array();
    }
}