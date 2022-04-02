<?php
function t($string)
{
    switch ($string) {
        case 'error 404, page not found':
            echo "Erreur 404, page non trouvée";
            break;
        case 'Website under maintenance':
            echo "Le site web est actuellement en maintenance...";
            break;
        case "How many NFT's would you create ?":
            echo "Comber de NFTs voulez-vous créer ?";
            break;
        case 'Generate':
            echo "Générer";
            break;

        default:
            echo $string;
            break;
    }
}
