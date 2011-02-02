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
     * Redirect to user inbox
     * @method POST
     */
    public function userAction(Alloy\Request $request)
    {
        $kernel = $this->kernel;
        return $kernel->redirect($kernel->url(array('username' => $request->username), 'inbox'));
    }


    /**
     * View user inbox
     * @method GET
     */
    public function inboxAction(Alloy\Request $request)
    {
        $kernel = $this->kernel;
    	$username = $request->username;

        $mapper = $kernel->mapper();
        $mail = $mapper->all('Module\Mail\Entity', array('username' => $username))
            ->order(array('date_message' => 'DESC'))
            ->execute();
        
        //$kernel->dump(\Spot\Log::queries());

        return $this->template(__FUNCTION__)
            ->set(compact('username', 'mail'));
    }
}