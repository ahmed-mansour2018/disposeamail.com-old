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
            ->order(array('date_created' => 'DESC'))
            ->execute();
        
        //$kernel->dump(\Spot\Log::queries());

        return $this->template(__FUNCTION__)
            ->set(compact('username', 'mail'));
    }


    /**
     * View single message
     * @method GET
     */
    public function viewAction(Alloy\Request $request)
    {
        $kernel = $this->kernel;
        $username = $request->username;
        $itemId = $request->get('item', 0);

        $mapper = $kernel->mapper();
        $msg = $mapper->first('Module\Mail\Entity', array('id' => $itemId, 'username' => $username));

        // 404 for messages that do not exist
        if(!$msg) {
            return false;
        }

        // Update 'is_read' marker if not already read
        if(!$msg->is_read) {
            $msg->is_read = true;
            $mapper->save($msg);
        }

        return $this->template(__FUNCTION__)
            ->set(compact('username', 'msg'));
    }


    /**
     * Purge messages (delete messages over 30 days old)
     * @method GET
     */
    public function purgeAction(Alloy\Request $request)
    {
        $kernel = $this->kernel;
        $username = $request->username;

        $mapper = $kernel->mapper();
        $msg = $mapper->delete('Module\Mail\Entity', array('date_created <=' => strtotime('-30 days')));

        return "Deleted messages older than 30 days";
    }
}