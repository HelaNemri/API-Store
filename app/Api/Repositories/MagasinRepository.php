<?php

namespace App\Api\Repositories;

use Database\Database;

class MagasinRepository
{
    private $db;

    /**
     * Constructor for the class.
     *
     * Initializes the database connection.
     *
     * @throws DatabaseException If the database connection fails
     */
    public function __construct()
    {
        // Initialize the database connection
        $this->db = new Database();
    }

    /**
     * Retrieve all magasins from the database.
     *
     * @return array The list of all magasins
     */
    public function getAllMagasins()
    {
        $sql = "SELECT * FROM magasin";
        return $this->db->fetchAll($sql);
    }

    /**
     * Retrieves a magasin by its ID.
     *
     * @param int $id The ID of the magasin to retrieve
     * @throws DatabaseException If the query fails
     * @return array|null The magasin data or null if not found
     */
    public function getMagasinById($id)
    {
        $sql = "SELECT * FROM magasin WHERE id = $id";
        $result = $this->db->fetchOne($sql);

        return $result;
    }

    /**
     * Add a new magasin to the database.
     *
     * @param array $data Data for the new magasin
     * @throws DatabaseException If the query fails
     * @return bool True if the magasin is added successfully, false otherwise
     */
    public function addMagasin($data)
    {
        $sql = "INSERT INTO magasin (nom, ville, categorie, adresse, code_postal, telephone, email, site_web, date_ouverture, description, tr_date_updated) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        return $this->db->query($sql, [
            $data['nom'],
            $data['ville'],
            $data['categorie'],
            $data['adresse'],
            $data['code_postal'],
            $data['telephone'],
            $data['email'],
            $data['site_web'],
            $data['date_ouverture'],
            $data['description']
        ]);
    }

    /**
     * Update a magasin in the database.
     *
     * @param int $id The ID of the magasin to update
     * @param array $data The data to update the magasin with
     * @throws DatabaseException If the database query fails
     * @return bool True if the update was successful, false otherwise
     */
    public function updateMagasin($id, $data)
    {
        $sql = "UPDATE magasin SET nom = ?, ville = ?, categorie = ?, adresse = ?, 
                code_postal = ?, telephone = ?, email = ?, site_web = ?, date_ouverture = ?, 
                description = ?, tr_date_updated = NOW() WHERE id = ?";

        return $this->db->query($sql, [
            $data['nom'],
            $data['ville'],
            $data['categorie'],
            $data['adresse'],
            $data['code_postal'],
            $data['telephone'],
            $data['email'],
            $data['site_web'],
            $data['date_ouverture'],
            $data['description'],
            $id
        ]);
    }

    /**
     * Delete a magasin by its ID.
     *
     * @param int $id The ID of the magasin to delete
     * @throws DatabaseException If the query fails
     * @return bool True if the magasin is deleted successfully, false otherwise
     */
    public function deleteMagasin($id)
    {
        $sql = "DELETE FROM magasin WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }

    /**
     * Retrieve filtered magasins based on provided filters, sorting, and order.
     *
     * @param array $filters The filters to apply
     * @param string|null $tri The column to sort by
     * @param string $ordre The sorting order
     * @return array The filtered magasins
     */
    public function getFilteredMagasins($filters, $tri, $ordre)
    {
        $sql = "SELECT * FROM magasin WHERE 1";
        // Add filtering conditions
        foreach ($filters as $column => $value) {
            if ($value !== null) {
                $sql .= " AND $column = ?";
            }
        }

        // Add sorting
        if ($tri !== null) {
            $sql .= " ORDER BY $tri $ordre";
        }

        // Call the fetchAll method with parameters
        return $this->db->fetchAll($sql, array_values(array_filter($filters, function ($value) {
            return $value !== null;
        })));
    }
}
