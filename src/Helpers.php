<?php
namespace Chat;


class Helpers
{

    /**
     * @param array  $tableMessage Le Tableau qui contient les différents type d'alerte qui devront être affichés
     * @param string $type La clé qui détermine le type d'alerte qui doit être affichée
     *
     * @return string Retourne l'alerte formatée en HTML ou une chaîne de caractère vide si la clé $type n'est pas définie
     */
    public static function alert(array $tableMessage, string $type = 'success') {
        if (!isset($tableMessage[$type])) return '';
        return <<<HTML
            <div class="alert alert-$type text-center fs-6 fw-bold">$tableMessage[$type]</div>
        HTML;
    }

    /**
     * @param array  $tableError Le tableau contenant toutes les erreurs possible
     * @param string $field Le champ pour lequel l'erreur devra être affichée
     *
     * @return string Retourne la chaîne formatée en HTML représentant un message d'erreur ou alors une chaîne de caractère vide si la clé $field n'existe pas
     */
    public static function errors(array $tableError, string $field) {
        if (!isset($tableError[$field])) return '';
        return <<<HTML
            <div class="fw-bold"><small class="text-danger">$tableError[$field]</small></div>
        HTML;
    }
}