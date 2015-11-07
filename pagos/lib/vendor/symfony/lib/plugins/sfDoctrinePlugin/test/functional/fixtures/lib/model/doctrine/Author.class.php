<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Author extends BaseAuthor
{
  public function setName($name)
  {
    if ( ! $this->exists())
    {
      $author = Doctrine_Core::getTable('Author')->findOneByName(trim($name));
      if ($author)
      {
        $this->assignIdentifier($author->identifier());
      } else {
        return $this->_set('name', $name);
      }
    } else {
      return $this->_set('name', $name);
    }
  }
}