<?php

/**
 * @author [Hala NEMRI]
 * @email [nemri.helaa@gmail.com]
 * @desc [PHP DEVELOPER]
 */

namespace App\Api\Models;

use DateTime;

class Magasin
{
    public int $id;
    public string $nom;
    public ?string $ville;
    public ?string $categorie;
    public ?string $adresse;
    public ?string $codePostal;
    public ?string $telephone;
    public ?string $email;
    public ?string $siteWeb;
    public ?string $dateOuverture;
    public ?string $description;
    public ?string $trDateUpdated;
}
