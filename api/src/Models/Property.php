<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Property extends Model
{
    private string $propertyTableName = 'properties';
    private string $contactRequestTableName = 'contact_requests';

    /**
     * @throws Exception
     */
    public function createProperty($data)
    {
        $criteria = [
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'location' => $data['location']
        ];

        $this->insert($this->propertyTableName, $criteria);
        return $this->db->lastInsertId();
    }

    public function getProperties()
    {
        return $this->selectAll($this->propertyTableName);
    }

    public function getProperty($propertyId)
    {
        return $this->selectOne($this->propertyTableName, ['id' => $propertyId]);
    }

    public function updateProperty($propertyId, $data)
    {
        $criteria = [
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'location' => $data['location']
        ];

        $this->update($this->propertyTableName, $criteria, ['id' => $propertyId]);
        return $this->db->lastInsertId();
    }

    public function deleteProperty($propertyId)
    {
        $this->delete($this->propertyTableName, ['id' => $propertyId]);
        return $this->db->lastInsertId();
    }

    /**
     * @throws Exception
     */
    public function createContactRequest($propertyId, $data)
    {
        $criteria = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message'],
            'property_id' => $propertyId
        ];

        $this->insert($this->contactRequestTableName, $criteria);
        return $this->db->lastInsertId();
    }

    public function readProperty($propertyId)
    {
        return $this->selectOne($this->propertyTableName, ['id' => $propertyId]);
    }
}