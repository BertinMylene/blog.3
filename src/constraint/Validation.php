<?php

namespace App\src\constraint;

/*Appelée par notre contrôleur et qui prendra deux paramètres: 
*(les données à valider, et le nom de la classe que l'on veut valider)
*/

class Validation
{
    // Renvoi vers la classe PostValidation si c'est un article que l'on veut valider
    public function validate($data, $name)
    {
        if ($name === 'Post') {
            $postValidation = new PostValidation();
            $errors = $postValidation->check($data);
            return $errors;
        } elseif ($name === 'Comment') {
            $commentValidation = new CommentValidation();
            $errors = $commentValidation->check($data);
            return $errors;
        } elseif ($name === 'User') {
            $userValidation = new UserValidation();
            $errors = $userValidation->check($data);
            return $errors;
        }
    }
}
