<?php

namespace JsonSchemaMapper\Structure;

class TypeInfo
{
    private $name;
    private $type;
    private $comment;
    private $isRequired;

    /**
     * @param string      $name
     * @param string|null $type
     * @param string      $comment
     * @param bool        $isRequired
     */
    public function __construct(
        string $name,
        ?string $type,
        string $comment,
        bool $isRequired
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->comment = $comment;
        $this->isRequired = $isRequired;
    }

    public function name()
    {
        return $this->name;
    }

    public function type()
    {
        return $this->type;
    }

    public function hint()
    {
        $hint = '';
        if ('mixed' === $this->type()) {
            return $hint;
        }
        if (!$this->isRequired()) {
            $hint .= '?';
        }
        $hint .= $this->type;
        return $hint;
    }

    public function comment()
    {
        return $this->comment;
    }

    public function isRequired()
    {
        return $this->isRequired;
    }
}
