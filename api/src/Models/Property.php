<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Property extends Model
{
    private string $propertyTableName = 'properties';

    /**
     * @throws Exception
     */
    public function createProperty($data): bool|string
    {
        $criteria = [
            'image_path' => $data['image_path'] ?? "null",
            'name' => $data['name'],
            'landlord_id' => $data['landlord_id'],
            'location' => $data['location'],
            'price' => $data['price'],
            'address' => $data['address'],
            'points_of_interest' => $data['points_of_interest'],
            'description' => $data['description'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'type_id' => $data['type_id'],
            'property_type_id' => $data['property_type_id'],
            'bedrooms' => $data['bedrooms'],
            'bathrooms' => $data['bathrooms']
        ];

        $this->insert($this->propertyTableName, $criteria);
        return $this->db->lastInsertId();
    }

    public function getProperties(): bool|array
    {
        $sql = "SELECT 
                        $this->propertyTableName.*,
                        users.first_name as landlord_first_name,
                        users.last_name as landlord_last_name,
                        users.email as landlord_email,
                        users.phone_number as landlord_phone_number,
                        users.id as landlord_id,
                        types.type_name,
                        property_type.property_type

                FROM $this->propertyTableName JOIN users ON $this->propertyTableName.landlord_id = users.id
                JOIN types ON $this->propertyTableName.type_id = types.type_id
                JOIN property_type ON $this->propertyTableName.property_type_id = property_type.id
                WHERE $this->propertyTableName.deleted_at IS NULL  
                ORDER BY $this->propertyTableName.created_at DESC";
        return $this->query($sql)->fetchAll();
    }

    public function getProperty($propertyId)
    {
        $sql = "SELECT 
                        $this->propertyTableName.*,
                        users.first_name as landlord_first_name,
                        users.last_name as landlord_last_name,
                        users.email as landlord_email,
                        users.phone_number as landlord_phone_number,
                        users.id as landlord_id,
                        types.type_name,
                        property_type.property_type

                FROM $this->propertyTableName JOIN users ON $this->propertyTableName.landlord_id = users.id
                JOIN types ON $this->propertyTableName.type_id = types.type_id
                JOIN property_type ON $this->propertyTableName.property_type_id = property_type.id
                WHERE $this->propertyTableName.id = :id";
        return $this->query($sql, ['id' => $propertyId])->fetch();
    }

    public function updateProperty($propertyId, $data): bool|string
    {
        $criteria = [
            'id' => $propertyId,
            'image_path' => $data['image_path'],
            'name' => $data['name'],
            'landlord_id' => $data['landlord_id'],
            'location' => $data['location'],
            'price' => $data['price'],
            'address' => $data['address'],
            'points_of_interest' => $data['points_of_interest'],
            'description' => $data['description'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude']
        ];

        $this->update($this->propertyTableName, $criteria, ['id' => $propertyId]);
        return $this->db->lastInsertId();
    }

    public function deleteProperty($propertyId): bool|string
    {
        $this->softDelete($this->propertyTableName, $propertyId);
        return $this->db->lastInsertId();
    }

    /**
     * @throws Exception
     */
    public function readProperty($propertyId)
    {
        return $this->selectOne($this->propertyTableName, ['id' => $propertyId]);
    }

    /**
     * @throws Exception
     */
    public function favoriteProperty($propertyId, $userId): bool|string
    {
        $criteria = [
            'property_id' => $propertyId,
            'user_id' => $userId
        ];

        // fetch the favorite before inserting
        $favorite = $this->selectOne('favorites', $criteria);

        if ($favorite) {
            $this->delete('favorites', ['id' => $favorite['id']]);
        }

        $this->insert('favorites', $criteria);
        return $this->db->lastInsertId();
    }

    public function getFavorites($id): bool|array
    {
        $sql = "SELECT 
                    $this->propertyTableName.*,
                    users.first_name as landlord_first_name,
                    users.last_name as landlord_last_name,
                    users.email as landlord_email,
                    users.phone_number as landlord_phone_number,
                    users.id as landlord_id,
                    types.type_name,
                    property_type.property_type
                FROM $this->propertyTableName JOIN users ON $this->propertyTableName.landlord_id = users.id
                JOIN types ON $this->propertyTableName.type_id = types.type_id
                JOIN property_type ON $this->propertyTableName.property_type_id = property_type.id
                JOIN favorites ON $this->propertyTableName.id = favorites.property_id
                WHERE favorites.user_id = :id";
        return $this->query($sql, ['id' => $id])->fetchAll();
    }

    public function getPropertiesByLandlord($id): bool|array
    {
        $sql = "SELECT 
                    $this->propertyTableName.*,
                    users.first_name as landlord_first_name,
                    users.last_name as landlord_last_name,
                    users.email as landlord_email,
                    users.phone_number as landlord_phone_number,
                    users.id as landlord_id,
                    types.type_name,
                    property_type.property_type
                FROM $this->propertyTableName JOIN users ON $this->propertyTableName.landlord_id = users.id
                JOIN types ON $this->propertyTableName.type_id = types.type_id
                JOIN property_type ON $this->propertyTableName.property_type_id = property_type.id
                WHERE $this->propertyTableName.deleted_at IS NULL AND users.id = :id";
        return $this->query($sql, ['id' => $id])->fetchAll();
    }
}