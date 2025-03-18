<?php

namespace Jrn\Rbac\Contracts;

interface Role {
    public function permission(): collection; 
    public function hasPermission()
}