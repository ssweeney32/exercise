<?php

/**
 * Model that represents a player.
 */
Class Player {
    
    private $name;
    private $age;
    private $job;
    private $salary;

    public function __construct( $name, $age, $job, $salary ) {
        $this->name = $name;
        $this->age = $age;
        $this->job = $job;
        $this->salary = $salary;
    }
    
    /**
     * 
     * @return type
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @return type
     */
    public function getAge() {
        return $this->age;
    }

    /**
     * 
     * @return type
     */
    public function getJob() {
        return $this->job;
    }

    /**
     * 
     * @return type
     */
    public function getSalary() {
        return $this->salary;
    }
}