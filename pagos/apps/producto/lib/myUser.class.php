<?php

class myUser extends sfBasicSecurityUser {

    public function addProductoToEditableList(Productos $producto) {
        $ids = $this->getAttribute('can_edit', array());

        if (!in_array($producto->getId(), $ids)) {
            array_unshift($ids, $producto->getId());

            $this->setAttribute('can_edit', $ids);
        }
    }

    public function canEdit($producto) {
        $ids = $this->getAttribute('can_edit', array());

        return in_array($producto, $ids);
    }

}
