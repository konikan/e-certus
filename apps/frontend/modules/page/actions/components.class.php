<?php
class pageComponents extends sfComponents
{
    public function  executeBox1($request)
    {
        $pages = ConfigPeer::getConfig('page_box1_def');
        //print_r($pages);
        if( isset($pages['page_box1_def']))
        {
            $this->text = $pages['page_box1_def'];
        }
    }
}

?>
