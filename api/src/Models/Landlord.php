<?php

namespace App\Models;

use App\Core\Model;
use Exception;

class Landlord extends Model
{
    private string $landlordTableName = 'landlords';

    /**
     * @throws Exception
     */
    public function createLandlord($data)
    {
        $criteria = [

        ];

        $this->insert($this->landlordTableName, $criteria);
        return $this->db->lastInsertId();
    }

    public function readLandlord($condition)
    {
        return $this->selectOne($this->landlordTableName, $condition);
    }

    public function updateLandlord($landlordId, $data): bool|string
    {
        $criteria = [
            'id' => $landlordId,
            'title' => $data['title'],
            'description' => $data['description'],
            'salary' => $data['salary'],
            'location' => $data['location'],
            'categoryId' => $data['categoryId'],
            'closingDate' => $data['closingDate'],
        ];
        $this->update($this->landlordTableName, $criteria, ['id' => $landlordId]);
        return $this->db->lastInsertId();
    }

    public function deleteLandlord($landlordId): bool|string
    {
        $this->softDelete($this->landlordTableName, ['id' => $landlordId]);
        return $this->db->lastInsertId();
    }

    public function viewLandlords(): bool|array
    {
        return $this->selectAll($this->landlordTableName);
    }
}