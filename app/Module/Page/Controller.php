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
    	$page = $request->page;

        return "PAGE for " . $page;
    }
}