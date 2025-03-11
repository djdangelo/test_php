<?php
    namespace App\Application\DTO;

    class UserResponseDTO
    {
        private string $id;
        private string $name;
        private string $email;
        private string $createdAt;
    
        public function __construct(string $id, string $name, string $email, string $createdAt)
        {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->createdAt = $createdAt;
        }
    
        // Getters
        public function getId(): string
        {
            return $this->id;
        }
    
        public function getName(): string
        {
            return $this->name;
        }
    
        public function getEmail(): string
        {
            return $this->email;
        }
    
        public function getCreatedAt(): string
        {
            return $this->createdAt;
        }
    
        // Método para convertir el DTO a un array (útil para JSON)
        public function toArray(): array
        {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'createdAt' => $this->createdAt,
            ];
        }
    }
?>