<?php
namespace App\Models;

class Task
{
    private $task_id;
    private $title;
    private $description;
    private $dueto;
    private $completed;
    private $priority_id;
    private $user_id;


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
     * Get the value of task_id
     */ 
    public function getTask_id()
    {
        return $this->task_id;
    }

    /**
     * Set the value of task_id
     *
     * @return  self
     */ 
    public function setTask_id($task_id)
    {
        $this->task_id = $task_id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of dueto
     */ 
    public function getDueto()
    {
        return $this->dueto;
    }

    /**
     * Set the value of dueto
     *
     * @return  self
     */ 
    public function setDueto($dueto)
    {
        $this->dueto = $dueto;

        return $this;
    }

    /**
     * Get the value of completed
     */ 
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set the value of completed
     *
     * @return  self
     */ 
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
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
     *
     * @return  self
     */ 
    public function setPriority_id($priority_id)
    {
        $this->priority_id = $priority_id;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
}