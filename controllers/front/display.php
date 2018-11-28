<?php
// global $smarty;
// include('../../config/config.inc.php');
// include('../../header.php');
 
// $smarty->display(dirname(__FILE__).'/display.tpl');
 
// include('../../footer.php');

class faqModuledisplayModuleFrontController extends ModuleFrontController
{
  public function initContent()
  {
    parent::initContent();

    // Verifie si le champ question_input du form n est pas vide
  if (Tools::getValue('question_input')) {
    // recupere la valeur dans le champ du form
    $faq_question = Tools::getValue('question_input');
    // instancie la class faq du model faq.php etendu de ObjetModel
    $faq = new Faq;
    // assigne la valeur du from dans la DB
    $faq->question = $faq_question;
    // le add remplace le INSERT du sql
    $faq->add();
    
  }




    $this->setTemplate('module:faqModule/views/templates/front/display.tpl');
  }

}


?>
