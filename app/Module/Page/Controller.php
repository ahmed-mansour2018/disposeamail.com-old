<?php
namespace Module\Page;
use Alloy;

/**
 * Page Module
 */
class Controller extends Alloy\Module\ControllerAbstract
{
    /**
     * View Page
     * @method GET
     */
    public function viewAction(Alloy\Request $request)
    {
    	$page = strtolower($request->page);
    	$allowedPages = array('home', 'faq');

    	// Ensure page exists or return 404 if not
    	if(!in_array($page, $allowedPages)) {
    		return false;
    	}

    	return $this->template('page_' . $page);
    }
}