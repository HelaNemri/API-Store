<?php

namespace App\Api\Controllers;

use App\Api\Repositories\MagasinRepository;
use App\Api\Middleware\Middleware;
use App\Services\HelperService;
use OpenApi\Annotations as OA;

class MagasinController
{
    private $magasin;

    /**
     * Constructor for the class.
     */
    public function __construct()
    {
        // Initialize the MagasinModel
        $this->magasin = new MagasinRepository();
        // Use middleware for authentication
        Middleware::authenticate();
    }

    /**
     * Get all Magasins with optional filters for sorting and ordering.
     *
     * @return void
     */
    public function getAllMagasins()
    {
        // Retrieve all query parameters
        $filters = $_GET;

        // Retrieve specific additional parameters
        $tri = $filters['tri'] ?? 'nom';
        $ordre = $filters['ordre'] ?? 'asc';

        // Remove sorting and ordering from $filters
        unset($filters['tri'], $filters['ordre']);

        // Call the model method with the parameters
        $data = $this->magasin->getFilteredMagasins($filters, $tri, $ordre);

        // Mapping data from the database to a Magasin model
        $magasins = [];
        foreach ($data as $magasin) {
            $magasins[] = HelperService::mapShop($magasin);
        }

        // Respond in JSON
        HelperService::respondJson($magasins, $magasins !== null);
    }

    /**
     * Retrieve a magasin by its ID.
     *
     * @param datatype $id description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function getMagasinById($id)
    {
        $data = $this->magasin->getMagasinById($id);

        // Mapping data from the database to a Magasin model
        $magasin = HelperService::mapShop($data);

        HelperService::respondJson($magasin ?? 'Magasin not found', $magasin !== null);
    }

    /**
     * Add a new magasin.
     *
     * @param mixed $data
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function addMagasin($data)
    {
        $result = $this->magasin->addMagasin($data);
        HelperService::respondJson($result ? 'Magasin added successfully' : 'Error adding the magasin', $result);
    }

    /**
     * Delete a Magasin.
     *
     * @param datatype $id description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function deleteMagasin($id)
    {
        $result = $this->magasin->deleteMagasin($id);
        HelperService::respondJson($result ? 'Magasin deleted successfully' : 'Error deleting the magasin', $result);
    }
}
