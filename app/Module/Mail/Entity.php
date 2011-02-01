<?php
namespace Module\Mail;

/**
 * Entity object
 */
class Entity extends \App\Module\Entity
{
    // Setup table and fields
    protected static $_datasource = "mail_inbox";
    
    // Fields
    public static function fields()
    {
        return parent::fields() + array(
            'id' => array('type' => 'int', 'primary' => true, 'serial' => true),
            'username' => array('type' => 'string', 'required' => true, 'index' => true),
            'to' => array('type' => 'string'),
            'from' => array('type' => 'string'),
            'subject' => array('type' => 'string', 'required' => true),
            'message' => array('type' => 'text', 'required' => true),
            'is_read' => array('type' => 'boolean'),
            'date_message' => array('type' => 'datetime'),
            'date_created' => array('type' => 'datetime')
        );
    }
}