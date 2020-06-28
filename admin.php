<?php

class admin extends Users {

    public function showMessage() {
        return 'Здравствуйте админ: ' . $this->getFullName();
    }
}