<?php

/**
 * @author [Hala NEMRI]
 * @email [nemri.helaa@gmail.com]
 * @desc [PHP DEVELOPER]
 */

namespace App\Services;

use App\Api\Models\Magasin;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class HelperService
{
    public static $key = 'MIIEowIBAAKCAQEAuzWHNM5f+amCjQztc5QTfJfzCC5J4nuW';

    /**
     * Responds with JSON data.
     *
     * @param datatype $data description
     * @param datatype $success description
     */
    public static function respondJson($data, $success = true)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    /**
     * Verify the token and decode it using JWT library.
     *
     * @param string $token The token to be verified and decoded
     * @throws \Exception Description of exception
     * @return array|null
     */
    public static function verifyToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key(self::$key, 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            // Token invalide
            return null;
        }
    }

    /**
     * Maps the data to a Magasin object.
     *
     * @param array $data The array containing the data to be mapped
     * @throws Some_Exception_Class Description of exception
     * @return Magasin The mapped Magasin object
     */
    public static function mapShop(array $data): Magasin
    {
        $magasin = new Magasin();
        $magasin->id = $data['id'];
        $magasin->nom = $data['nom'];
        $magasin->ville = $data['ville'];
        $magasin->categorie = $data['categorie'];
        $magasin->adresse = $data['adresse'];
        $magasin->codePostal = $data['code_postal'];
        $magasin->telephone = $data['telephone'];
        $magasin->email = $data['email'];
        $magasin->siteWeb = $data['site_web'];
        $magasin->dateOuverture = $data['date_ouverture'];
        $magasin->description = $data['description'];
        $magasin->trDateUpdated = $data['tr_date_updated'];
        return $magasin;
    }
}
