<?php

class client extends Users {

    public function showMessage() {
        return 'Здравствуйте клиент: ' . $this->getFullName();
    }
}