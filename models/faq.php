<?php



//  Creation de la model Faq qui etend le model ObjectModel
//  les public variable autorise l utilisation de ces variables

class Faq extends ObjectModel{
  public $id;
  public $date_add;
  public $date_upd;
  public $question;
  public $answer;
// entre les bonnes donnees pour table est id, pour la table ne pas mettre le prefix
  public static $definition = [
    'table' => 'faq',
    'primary' => 'id',
    // pour les fields bien mettre tout les champs dans la table et leurs types.
    'fields' => array(
        'id'  => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
        'date_add' => array('type' => self::TYPE_DATE),
        'date_upd' => array('type' => self::TYPE_DATE),
        'question'         => ['type' => self::TYPE_STRING],
        'answer'           => ['type' => self::TYPE_STRING],

    ),
];


// class AllQuestion extends DbQuery{

// }
public function getAllQuestion(){

  $sql = new DbQuery();
  $sql->select('*');
  $sql->from('faq');
  $sql->orderBy('id');
  return Db::getInstance()->executeS($sql);

}



}