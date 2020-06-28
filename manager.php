<?php

class manager extends Users {
    public function showMessage() {
        return 'Здравствуйте менеджер: ' . $this->getFullName();
    }
}