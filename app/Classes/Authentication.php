<?php


namespace App\Classes;

use \Firebase\JWT\JWT;

class Authentication{
    private static $key = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
Proc-Type: 4,ENCRYPTED
DEK-Info: AES-128-CBC,2202468A727F74921E1BC0A1C846B7D6

zFN5BL/7aVinckGMIjImSIsTkKRPYZI4iHLfqb5dQRV9RvguN5fT8/kSVSyQzIWS
TJXKXcuXGMsI/a8TQ8I8W7gQc1O14WB/hs87seTOMcYLbHaK74upP7QyT29QbOux
uGBeN2DbZZBk9aaGUbPbC4Je6G1s1b0xn9xxcrNpZKaShvk91KtborJKleREaXKH
xJrUIjdijv78uLnQjxxxArGvZ965+dzFq0lu1V2ho/HoAKGHxh0a+V81/e9WSfIs
Ha0mju00GYXf79/SpwMya8xnJAt/XqEtex95BRP3sAXrnYTeM4+fWa8GW/dkXYVj
S/uhfeP755V905nX9Lk9OK8TXese0Uwi1THF7BWyufWdPb6P+vl3uMuqoVloMWNw
Y6XS2HfSl0t/PxqdBIxqoTSSxF5sRuc8PvMAgf9Vu9nhplJatIMLxFJDlXvhfsdT
jQJVlNkDWTWqj2r3BmEuKGIH0uEmzADHzgFd+G7SYduPOTk58gsWNKOcn4R/RsZ+
l3pzRrmlrZclsEdgF+5ogZPs1rHLHxS9bBMtZ8Hv8zRZlTVuNybmJyrKWqTO1TNS
TsRhpca7s2rHqrSExD0eNSFhqjrfgWZcxXLO1Sr4vEm+TXqBTp7G/4caMShBWu0L
wxz5qseDjbYeCAKwCCYzSBs/NT/F7Ieu+mLhzXiUzsofgPCFj/eq6NM702WZGlKT
Kw5uqXe6+r7xifuKBdTv2WDDNexNCg/na6CAKLfPWpBOOCAIug9G+jhyyEjYOwJG
ICABu+J4v+iGhiuPO60eK3gP0b6vjeSv8/QtDjcC4N7g8UuK9C3CyDfc4oqA0tTV
yA/DYtVQ7OYBJP2u4Zr/RTyeiid2m/6SaXqybktMxsHFh4GAJPiv8FdItI1DZZvY
JLVeScpiCXbSdc4H9HFMobarSPg0tUUZKPqfICugO3ODc86dzbMcoBcIhV3rHF/Y
thYspo4CLeRAjspXPNXS2e6A3MxyElCBoM+uhsXd3annP7YEKx2iVIjQ/KuDdxlG
OGqkoybvEeJ2A9D3isicTAG/5o9K10uF3d0vY3jo/NuO158loAWzHXc4ILqeoVa2
TRVWrbUyMSGLRdR9JCSxEqmAz6ZqIdriilDy03KTk8wl/dUgarVFQhr7Ti9MjUKT
ObzR7hpGLJ36hSf5q3UqytzsphbnkbDugkpdDfi8T34xDarZSgp8KP3lRpRYfYsf
N1YQfvr2a4y8RC++OFL3yC1tVVtvDsiTlxEuDDcmcg/3Xq2cb8LWP+FUypQp0k+1
9j+FSuAWV2pVBneRYj/3uDrEjAbotyqHqRCCTiwjUJUVZxaQhfUKbHNKMMWF5X5T
G4G5p47lpP3kRJEzgnyPDWRRur5l6ANpTxWalxbcQ4uw9ys8s8YgQU4KsdUm8Vc5
VaQUYDFre/NyBTYxH6XLD+4ggGRs798SOFDnCmkneY+BwRgDgTgwS0KzbmLIvY95
tNkiL8kcpSbWQOJ/4z2UekU8gicisCPMjBYz9/QsxSCxhVItWFgiviU8z6ZvizTf
vsRBDipo48cw8GCsz4i1NGVaeXpgjQvubcB1xpuRxV5fgQQ61g4Ys9tpLfoCarTk
-----END RSA PRIVATE KEY-----

EOD;

    public static function encode($payload){
        $payload['iat'] = now()->timestamp;
        $payload['exp'] = now()->addMinutes(env('TOKEN_EXPIRATION_DURATION'))->timestamp;
        $payload['nbf'] = now()->timestamp;
        $jwtHash = JWT::encode($payload, self::$key, 'HS256');
        return explode(".", $jwtHash);
    }

    public static function decode($token){
        return (array) JWT::decode($token, self::$key, array('HS256'));
    }
}
