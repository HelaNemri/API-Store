<?php

/**
 * @author [Hala NEMRI]
 * @email [nemri.helaa@gmail.com]
 * @desc [PHP DEVELOPER]
 */

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

        try {
            // Retrieve all query parameters
            $filters = $_GET;

            // Retrieve specific additional parameters
            $tri = $filters['tri'] ?? 'nom';
            $ordre = $filters['ordre'] ?? 'asc';

            // Remove sorting and ordering from $filters
            unset($filters['tri'], $filters['ordre']);

            // Call the model method with the parameters
            $data = $this->magasin->getFilteredMagasins($filters, $tri, $ordre);

            // Throw new Exception if data is falsy
            if (!$data) throw new \Exception('No magasins found');
            // Mapping data from the database to a Magasin model
            $magasins = [];
            foreach ($data as $magasin) {
                $magasins[] = HelperService::mapShop($magasin);
            }

            // Respond in JSON
            HelperService::respondJson($magasins, $magasins !== null);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
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
        try {
            $data = $this->magasin->getMagasinById($id);
            // Throw new Exception if data is falsy
            if (!$data) throw new \Exception('magasin with id ' . $id . ' is not found');
            // Mapping data from the database to a Magasin model
            $magasin = HelperService::mapShop($data);

            HelperService::respondJson($magasin);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
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
        try {
            $result = $this->magasin->addMagasin($data);
            // Throw new Exception if result is falsy
            if (!$result) throw new \Exception('Error adding the magasin');
            HelperService::respondJson('Magasin added successfully', $result);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
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
        try {
            $result = $this->magasin->deleteMagasin($id);
            // Throw new Exception if result is falsy
            if (!$result) throw new \Exception('magasin with id ' . $id . ' is not found');
            HelperService::respondJson('Magasin deleted successfully', $result);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
