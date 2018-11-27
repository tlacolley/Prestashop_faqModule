<?php
if (!defined('_PS_VERSION_'))
{
  exit;
}

class faqModule extends Module
{
  public function __construct()
  {
    $this->name = 'faqModule';
    $this->tab = 'front_office_features';
    $this->version = '1.0.0';
    $this->author = 'Firstname Lastname';
    $this->need_instance = 0;
    $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    $this->bootstrap = true;

    parent::__construct();

    $this->displayName = $this->l('FAQ module');
    $this->description = $this->l('Description: Module faq gestion.');

    $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

    if (!Configuration::get('FAQMODULE_NAME'))
      $this->warning = $this->l('No name provided');
  }

  public function install()
  {
    if (Shop::isFeatureActive())
      Shop::setContext(Shop::CONTEXT_ALL);
   
    return parent::install() &&
      $this->registerHook('leftColumn') &&
      $this->registerHook('header') &&
      Configuration::updateValue('FAQMODULE_NAME', 'my friend');
  }


  public function uninstall()
  {
    if (!parent::uninstall() ||
      !Configuration::deleteByName('FAQMODULE_NAME')
    )
      return false;

    return true;
  }
// -----------------------Hooks --------------
  public function hookDisplayLeftColumn($params)
  {
    $this->context->smarty->assign(
        array(
            'faqModule_name' => Configuration::get('FAQMODULE_NAME'),
            'faqModule_link' => $this->context->link->getModuleLink('faqModule', 'display'),
            'faqModule_message' => $this->l('This is a simple text message') // Do not forget to enclose your strings in the l() translation method
        )
    );
    return $this->display(__FILE__, 'faqModule.tpl');
  }


public function hookDisplayFooter(array $params)
{
   $this->context->smarty->assign(
        array(
            'faqModule_name' => Configuration::get('FAQMODULE_NAME'),
            'faqModule_link' => $this->context->link->getModuleLink('faqModule', 'display'),
            'faqModule_message' => $this->l('This is a simple text message') // Do not forget to enclose your strings in the l() translation method
        )
    );
    return $this->display(__FILE__, 'faqModule.tpl');
}

  public function hookDisplayHeader()
  {
    $this->context->controller->addCSS($this->_path.'css/faqModule.css', 'all');
  }



public function getContent()
{
    $output = null;
 
    if (Tools::isSubmit('submit'.$this->name))
    {
        $faqModule_name = strval(Tools::getValue('FAQMODULE_NAME'));
        if (!$faqModule_name
          || empty($faqModule_name)
          || !Validate::isGenericName($faqModule_name))
            $output .= $this->displayError($this->l('Invalid Configuration value'));
        else
        {
            Configuration::updateValue('FAQMODULE_NAME', $faqModule_name);
            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }
    }
    return $output.$this->displayForm();
}

public function displayForm()
{
    // Get default language
    $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
 
    // Init Fields form array
    $fields_form[0]['form'] = array(
        'legend' => array(
            'title' => $this->l('Settings'),
        ),
        'input' => array(
            array(
                'type' => 'text',
                'label' => $this->l('Configuration value'),
                'name' => 'FAQMODULE_NAME',
                'size' => 20,
                'required' => true
            )
        ),
        'submit' => array(
            'title' => $this->l('Save'),
            'class' => 'btn btn-default pull-right'
        )
    );
 
    $helper = new HelperForm();
 
    // Module, token and currentIndex
    $helper->module = $this;
    $helper->name_controller = $this->name;
    $helper->token = Tools::getAdminTokenLite('AdminModules');
    $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
 
    // Language
    $helper->default_form_language = $default_lang;
    $helper->allow_employee_form_lang = $default_lang;
 
    // Title and toolbar
    $helper->title = $this->displayName;
    $helper->show_toolbar = true;        // false -> remove toolbar
    $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
    $helper->submit_action = 'submit'.$this->name;
    $helper->toolbar_btn = array(
        'save' =>
        array(
            'desc' => $this->l('Save'),
            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
            '&token='.Tools::getAdminTokenLite('AdminModules'),
        ),
        'back' => array(
            'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->l('Back to list')
        )
    );
 
    // Load current value
    $helper->fields_value['FAQMODULE_NAME'] = Configuration::get('FAQMODULE_NAME');
 
    return $helper->generateForm($fields_form);
}


}
?>