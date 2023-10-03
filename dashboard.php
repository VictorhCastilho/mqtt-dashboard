<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <div id="gauge-chart"></div>

    <script>
        // Função para atualizar o medidor
        function atualizarMedidor() {
            // Faz uma solicitação AJAX para obter os dados mais recentes do banco de dados
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "dados.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var dados = JSON.parse(xhr.responseText);

                    // Atualiza o medidor com os novos dados
                    var h2s = dados.h2s;
                    var metano = dados.metano;
                    var temperatura = dados.temperatura;
                    var vazao = dados.vazao;

                    var gaugeData = [
                        {
                        domain: { x: [0, 0.4], y: [0, 0.4] },  // Posição e tamanho da primeira gauge
                        value: h2s,
                        title: { text: 'H2S' },
                        type: 'indicator',
                        mode: 'gauge+number'
                        },
                        {
                        domain: { x: [0.6, 1], y: [0, 0.4] },  // Posição e tamanho da segunda gauge
                        value: metano,
                        title: { text: 'Metano' },
                        type: 'indicator',
                        mode: 'gauge+number'
                        },
                        {
                        domain: { x: [0, 0.4], y: [0.6, 1] },  // Posição e tamanho da terceira gauge
                        value: temperatura,
                        title: { text: 'Temperatura' },
                        type: 'indicator',
                        mode: 'gauge+number'
                        },
                        {
                        domain: { x: [0.6, 1], y: [0.6, 1] },  // Posição e tamanho da quarta gauge
                        value: vazao,
                        title: { text: 'Vazão' },
                        type: 'indicator',
                        mode: 'gauge+number'
                        }
                    ];

                    var layout = { width: 800, height: 600 };  // Largura e altura total do layout
                    Plotly.newPlot('gauge-chart', gaugeData, layout);
                }
            };
            xhr.send();
        }

        // Chama a função inicialmente
        atualizarMedidor();

        // Chama a função a cada 5 segundos
        setInterval(atualizarMedidor, 5000);
    </script>
</body>
</html>