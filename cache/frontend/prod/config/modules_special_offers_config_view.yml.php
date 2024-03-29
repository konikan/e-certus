<?php
// auto-generated by sfViewConfigHandler
// date: 2012/07/17 23:23:10
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('main.css', '', array ());
  $response->addStylesheet('smoothness/jquery-ui-1.8.9.custom.css', '', array ());
  $response->addJavascript('jquery-1.4.4.min.js', '', array ());
  $response->addJavascript('jquery-ui/js/jquery-ui-1.8.9.custom.min.js', '', array ());
  $response->addJavascript('jquery.accordion.js', '', array ());
  $response->addJavascript('swfobject.js', '', array ());
  $response->addJavascript('../sfProtoculousPlugin/js/prototype.js', '', array ());
  $response->addJavascript('../sfProtoculousPlugin/js/builder.js', '', array ());
  $response->addJavascript('../sfProtoculousPlugin/js/scriptaculous.js', '', array ());
  $response->addJavascript('../sfProtoculousPlugin/js/effects.js', '', array ());


