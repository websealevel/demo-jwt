<?php

/**
 * Fonction utiles pour implémenter le protocole JWT Token
 */

/**
 * Retourne un JWT Token (RFC7519) signé par un secret
 */
function create_signed_jwt_token(array $header, array $payload, string $secret): string
{

    $encodedHeader = base64_encode(json_encode($header));
    $encodedPayload = base64_encode(json_encode($payload));

    //Signature créee à partir header, payload et d'un secret.
    $signature = create_signature($encodedHeader, $encodedPayload, SECRET);

    return sprintf(
        "%s.%s.%s",
        $encodedHeader,
        $encodedPayload,
        $signature
    );
}


/**
 * Retourne la signature d'un JWT Token
 * @param string $encodedHeader. Header du JWT, encodé en base 64
 * @param string $encodedPayload. Header du JWT, encodé en base 64
 * @param string $secret. Secret privé, conservé sur le serveur
 */
function create_signature(string $encodedHeader, string $encodedPayload, string $secret): string
{
    return sha1(sprintf("%s%s%s", $encodedHeader, $encodedPayload, $secret));
}

function encodeBase64Url(string $data): string
{
}

function decodeBase64Url(string $data): string
{
}
