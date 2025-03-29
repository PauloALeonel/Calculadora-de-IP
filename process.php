<?php
function ipToBinary($ip) {
    return implode('.', array_map(function ($octet) {
        return str_pad(decbin($octet), 8, '0', STR_PAD_LEFT);
    }, explode('.', $ip)));
}

function cidrToMask($cidr) {
    return long2ip(~((1 << (32 - $cidr)) - 1) & 0xFFFFFFFF);
}

function calculateNetworkInfo($ip, $cidr) {
    // Validação do IP
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        return "Erro: IP inválido";
    }

    // Converte CIDR para máscara
    $mask = cidrToMask((int)$cidr);
    $maskLong = ip2long($mask);
    $ipLong = ip2long($ip);

    // Cálculo dos endereços de rede
    $wildcardLong = ~$maskLong & 0xFFFFFFFF;
    $networkIdLong = $ipLong & $maskLong;
    $broadcastLong = $networkIdLong | $wildcardLong;
    $firstIpLong = ($cidr < 31) ? $networkIdLong + 1 : $networkIdLong;
    $lastIpLong = ($cidr < 31) ? $broadcastLong - 1 : $broadcastLong;
    $totalHosts = ($cidr < 31) ? (1 << (32 - $cidr)) - 2 : ($cidr == 31 ? 2 : 1);

    return [
        'IP' => $ip,
        'IP Binário' => ipToBinary($ip),
        'Máscara' => $mask,
        'Máscara Binário' => ipToBinary($mask),
        'Wildcard' => long2ip($wildcardLong),
        'Wildcard Binário' => ipToBinary(long2ip($wildcardLong)),
        'ID da Rede' => long2ip($networkIdLong),
        'ID da Rede Binário' => ipToBinary(long2ip($networkIdLong)),
        'Broadcast' => long2ip($broadcastLong),
        'Broadcast Binário' => ipToBinary(long2ip($broadcastLong)),
        'Primeiro IP' => long2ip($firstIpLong),
        'Último IP' => long2ip($lastIpLong),
        'Quantidade de Hosts' => $totalHosts
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ip = $_POST['ip'];
    $cidr = $_POST['mask'];

    $info = calculateNetworkInfo($ip, $cidr);
    echo" <header class='header'>";
    echo" <div class='logo-container'>";
    echo"   <img src='img\logo.svg' alt='Logo' class='logo'>";
    echo"   <h1>Ipê | Calculadora de IP</h1>";
    echo" </div>";
    echo"</header>";
    echo "<link rel='stylesheet' href='ipebonito.css'>";
    echo "<div class='container'>";
    echo "<h2>Resultado</h2>";

    if (is_string($info)) {
        echo "<p class='error'>$info</p>";
    } else {
        echo "<table>";
        foreach ($info as $chave => $valor) {
            echo "<tr><th>$chave</th><td>$valor</td></tr>";
        }
        echo "</table>";
    }

    echo "<a href='index.php' class='btn'>Testar outro IP</a>";
    echo "</div>";
}
?>
