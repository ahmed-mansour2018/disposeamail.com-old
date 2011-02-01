<?php
namespace Module\Mail;
use Alloy;

/**
 * Mail Module
 */
class Controller extends Alloy\Module\ControllerAbstract
{
    /**
     * Index
     * @method GET
     */
    public function indexAction(Alloy\Request $request)
    {
        return false; // 404 for now until we figure out what to do here
    }


    /**
     * View user inbox
     * @method GET
     */
    public function inboxAction(Alloy\Request $request)
    {
    	$user = $request->user;

        return "INBOX for " . $user;
    }
}