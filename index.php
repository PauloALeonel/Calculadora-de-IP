<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>IPÊ | CÁLCULO DE IP</title>
    <link rel="icon" href="img\favicon.svg" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Rede</title>
    <link rel="stylesheet" href="ipebonito.css">
</head>
<header class="header">
        <div class="logo-container">
            <img src="img\logo.svg" alt="Logo" class="logo">
            <h1>Ipê | Calculadora de IP</h1>
        </div>
    </header>
    
<body>
    <div class="container">
        <h2>Calculadora de Rede</h2>
        <form action="process.php" method="post">
            <label for="ip">IP:</label>
            <input type="text" id="ip" name="ip" required>

            <label for="mask">Máscara:</label>
            <select id="mask" name="mask" required>
                <?php
                    $masks = [
                        ['cidr' => 0,  'decimal' => '0.0.0.0'],
                        ['cidr' => 1,  'decimal' => '128.0.0.0'],
                        ['cidr' => 2,  'decimal' => '192.0.0.0'],
                        ['cidr' => 3,  'decimal' => '224.0.0.0'],
                        ['cidr' => 4,  'decimal' => '240.0.0.0'],
                        ['cidr' => 5,  'decimal' => '248.0.0.0'],
                        ['cidr' => 6,  'decimal' => '252.0.0.0'],
                        ['cidr' => 7,  'decimal' => '254.0.0.0'],
                        ['cidr' => 8,  'decimal' => '255.0.0.0'],
                        ['cidr' => 9,  'decimal' => '255.128.0.0'],
                        ['cidr' => 10, 'decimal' => '255.192.0.0'],
                        ['cidr' => 11, 'decimal' => '255.224.0.0'],
                        ['cidr' => 12, 'decimal' => '255.240.0.0'],
                        ['cidr' => 13, 'decimal' => '255.248.0.0'],
                        ['cidr' => 14, 'decimal' => '255.252.0.0'],
                        ['cidr' => 15, 'decimal' => '255.254.0.0'],
                        ['cidr' => 16, 'decimal' => '255.255.0.0'],
                        ['cidr' => 17, 'decimal' => '255.255.128.0'],
                        ['cidr' => 18, 'decimal' => '255.255.192.0'],
                        ['cidr' => 19, 'decimal' => '255.255.224.0'],
                        ['cidr' => 20, 'decimal' => '255.255.240.0'],
                        ['cidr' => 21, 'decimal' => '255.255.248.0'],
                        ['cidr' => 22, 'decimal' => '255.255.252.0'],
                        ['cidr' => 23, 'decimal' => '255.255.254.0'],
                        ['cidr' => 24, 'decimal' => '255.255.255.0'],
                        ['cidr' => 25, 'decimal' => '255.255.255.128'],
                        ['cidr' => 26, 'decimal' => '255.255.255.192'],
                        ['cidr' => 27, 'decimal' => '255.255.255.224'],
                        ['cidr' => 28, 'decimal' => '255.255.255.240'],
                        ['cidr' => 29, 'decimal' => '255.255.255.248'],
                        ['cidr' => 30, 'decimal' => '255.255.255.252'],
                        ['cidr' => 31, 'decimal' => '255.255.255.254'],
                        ['cidr' => 32, 'decimal' => '255.255.255.255']
                    ];

                    foreach ($masks as $mask) {
                        echo "<option value='{$mask['cidr']}'>{$mask['cidr']} - {$mask['decimal']}</option>";
                    }
                ?>
            </select>

            <button type="submit">Calcular</button>
        </form>
    </div>
</body>
</html>
