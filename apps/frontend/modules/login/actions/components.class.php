<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class loginComponents extends sfComponents
{
    public function executeLoginForm(sfWebRequest $request)
    {
        $this->user = $this->getUser()->getAttribute('user',null);
        if(!isset ($this->form))

            $this->form = new UserLoginForm();

    }
}
?>
