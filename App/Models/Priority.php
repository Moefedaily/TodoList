<?php
namespace App\Models;

class Priority
{
    private $priority_id;
    private $name;
    
    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $setter = 'set' . ucfirst($key);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }
    }

    /**
     * Get the value of priority_id
     */
    public function getPriority_id()
    {
        return $this->priority_id;
    }

    /**
     * Set the value of priority_id
     */
    public function setPriority_id($priority_id)
    {
        $this->priority_id = $priority_id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}