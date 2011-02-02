<?php
namespace Module\Mail;

/**
 * Entity object
 */
class Entity extends \App\Module\Entity
{
    // Setup table and fields
    protected static $_datasource = "ai_inbox";
    
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
            'date_message' => array('type' => 'int', 'length' => 11),
            'date_created' => array('type' => 'int', 'length' => 11)
        );
    }


    /**
     * HTML-Formatted message body
     */
    public function getMessage()
    {
        $msg = $this->_data['message'];

        // Messages come in with entities encoded already, so we can just check for them directly
        if(false === strpos($msg, '&lt;')) {
            return nl2br($this->formatUrlsInText($msg));
        } else {
            return html_entity_decode($msg);
        }
    }


    /**
     * Getter override for subject property
     */
    public function getSubject()
    {
        return html_entity_decode($this->_data['subject']);
    }


    public function getFromName()
    {
        $from = html_entity_decode($this->from);
        list($from_name, $from_email) = split('<',$from);
        return $from_name;
    }

    public function getFromEmail()
    {
        $from = html_entity_decode($this->from);
        list($from_name, $from_email) = split('<',$from);
        $from_email = str_replace('>', '', $from_email);
        return $from_email;
    }


    /**
     * URL formatting helper for text based emails
     */
    protected function formatUrlsInText($text)
    {
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        preg_match_all($reg_exUrl, $text, $matches);
        $usedPatterns = array();
        foreach($matches[0] as $pattern) {
            if(!array_key_exists($pattern, $usedPatterns)) {
                $usedPatterns[$pattern] = true;
                $text = str_replace($pattern, '<a href="' . $pattern . '" rel="nofollow">' . $pattern . '</a> ', $text);
            }
        }
        return $text;
    }
}