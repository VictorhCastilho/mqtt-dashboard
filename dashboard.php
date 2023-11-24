<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de monitoramento de gases</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <h1>Dashboard de monitoramento de gases</h1>
    <p>
        Esta dashboard mostra os níveis de álcool e metano em um ambiente.
    </p>
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
                    var alcool = parseFloat(dados.alcool);

                    // Cria os dados para as gauges
                    var gaugeData = [
                        {
                        domain: { x: [0, 0.4], y: [0, 0.4] },  // Posição e tamanho da primeira gauge
                        value: alcool,
                        title: { text: 'Álcool' },
                        type: 'indicator',
                        mode: 'gauge+number'
                        }
                    ];

                    // Atualiza o layout da dashboard
                    var layout = { width: 600, height: 400 };
                    Plotly.newPlot('gauge-chart', gaugeData, layout);
                }
            };
            xhr.send();
        }

        // Chama a função inicialmente
        atualizarMedidor();

        // Atualiza os dados a cada 5 segundos
        setInterval(atualizarMedidor, 5000);
    </script>
</body>
</html>