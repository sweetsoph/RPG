<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/styles/styles.css">
        <title>Site do RPG</title>
        <style type="text/css">
            *{
                margin: 0;
                padding: 0;
                font-family: 'Josefin Sans', sans-serif;
            }
            body{
                background-color: #f7f7f7;
            }
            header{
                background-color: #3C5473;
                height: 80px;
            }
            nav ul{
                display: flex;
                height: 80px;
                justify-content: space-evenly;
                align-items: center;
            }
            li, li a{
                display: flex;
                height: 80px;
                justify-content: space-evenly;
                align-items: center;
                text-decoration: none;
                list-style: none;
                color: white;
                font-size: 20px;
                height: 80px;
                width: 100%;
            }
            li a:hover{
                background-color: #2A476B;
            }
            .mesa{
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                min-height: 450px;
                max-height: 100%;
                width: 100%;
                font-size: 20px;
            }
            .dados{
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                width: 300px;
                height: 450px;;
            }
            .dados form{
                display: flex;
                width: 100%;
                justify-content: center;
                align-items: center;
                flex-wrap: wrap;
            }
            #girar-dado{
                width: 261px;
                height: 40px;
                margin: 20px 0px 0px 0px;
                background-color: #62719C;
                justify-content: center;
                align-items: center;
                font-size: 17px;
                cursor: pointer;
                border-radius: 15px;
                border: none;
                font-weight: bold;
            }
            #girar-dado:hover{
                background-color: #3C5473;
            }
            #dado{
                display: flex;
                justify-content: center;
                align-items: center;
                width: 255px; height: 255px;
                background-color: white;
                border: 3px #D95436 solid;
                border-radius: 20px;
            }
            #select-dado{
                font-size: 17px;
                width: 200px;
            }
            .add-players{
                display: flex;
                flex-wrap: wrap;
                width: 500px;
                height: 100%;
                justify-content: center;
                padding: 30px 0px;
                padding: 20px;
            }
            .form-group{
                display: flex;
                justify-content: center;
            }
            .nome:hover, .iniciativa:hover, .adicionar:hover, .remover:hover{
                background-color: #f3f3f3;
            }
            .nome, .iniciativa, .adicionar, .remover{
                height: 30px;
                font-size: 18px;
                margin: 4px;padding: 5px;
                border: 1px #D95436 solid;
            }
            .nome{
                width: 200px;
            }
            .iniciativa{
                width: 60px;
            }
            .adicionar, .remover{
                color: #D95436;
                font-weight: bold;
                background-color: white;
                width: 30px;
            }
            .button-enviar{
                width: 100px;
                height: 40px;
                font-size: 17px;
                background-color: #62719C;
                border-radius: 10px;
                font-weight: bold;
                border: none;
                cursor: pointer;
            }
            .button-enviar:hover{
                background-color: #3C5473;
            }
        </style>
    </head>
    <body>
    <?php
        echo "<header>
            <nav>
                <ul>
                    <li><a href='#mesa'>Mesa</a></li>
                    <li><a href='#sistema'>Sistema</a></li>
                    <li><a href='#players'>Players</a></li>
                    <li><a href='#npcs'>NPC's</a></li>
                    <li><a href='#mobs'>Mobs</a></li>
                    <li><a href='#geografia'>Geografia</a></li>
                    <li><a href='#anexos'>Anexos</a></li>
                </ul>
            </nav>
        </header>
        <section id='mesa' class='container mesa'>
            <article class='dados'>
                <form action='' method='post'>
                    <div><select name='select-dado' id='select-dado'>
                        <option value='dado6'>Dado de 6 lados</option>
                        <option value='dado20'>Dado de 20 lados</option>
                        <option value='dado100'>Dado de 100 lados</option>
                    </select></div>
                    <div><input type='submit' id='girar-dado' value='Girar Dado'></div></form>";
        $tpDado = $_POST['select-dado'];

        if ($tpDado == 'dado6'){
            $vl_dado = rand(1, 6);
        }
        else if($tpDado == 'dado20'){
            $vl_dado = rand(1, 20);
        }
        else{
            $vl_dado = rand(1, 100);
        }
        echo "<div id='dado'><div class='vl-dado'>".$vl_dado."</div></div></article>";
        echo "<article class='add-players'>
                <div><h2>Definindo os Turnos</h2></div>
                <div>Insira abaixo o nome do player/mob/npc e seu dado de iniciativa.</div>
                <form action='' method='post'>
                    <div id='formulario-players'>
                        <div class='form-group'>
                            <div><input type='text' placeholder='Nome' name='nome[]' class='nome' /></div>
                            <div><input type='number' placeholder='Inic.' name='inic[]' class='iniciativa' /></div>
                            <div><input type='button' value='+' name='add' class='adicionar' onclick='adicionarCampo()'/></div>
                        </div>
                    </div>
                    <div class='form-group'>
                        <div><input type='submit' value='Enviar' class='button-enviar' name='enviar'/>
                    </div>
                </form>";

                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                //$cdPlayer = array();
                //$nome = array();
                //$inic = array();

                if(!empty($dados['enviar'])){
                    foreach($dados['nome'] as $codPlayer => $nomePlayer){
                        $players[] = array('nome' => $nomePlayer, 'iniciativa' => $dados['inic'][$codPlayer]);
                    }
                }

                foreach ($players as $cdPlayer => $row) {
                    $nome[$cdPlayer]  = $row['nome'];
                    $inic[$cdPlayer] = $row['inic'];
                }

                $nome  = array_column($players, 'nome');
                $inic = array_column($players, 'inic');
                var_dump($players); echo"<br><br>";

                array_multisort($nome, SORT_ASC, $inic, SORT_DESC, $players);
                var_dump($players); echo"<br><br>";

                $data[] = array('volume' => 67, 'edicao' => 2);
                $data[] = array('volume' => 86, 'edicao' => 1);
                $data[] = array('volume' => 85, 'edicao' => 6);
                $data[] = array('volume' => 98, 'edicao' => 2);
                $data[] = array('volume' => 86, 'edicao' => 6);
                $data[] = array('volume' => 67, 'edicao' => 7);

                var_dump($data);echo"<br><br>";
                // Obtain a list of columns
                foreach ($data as $key => $row) {
                    $volume[$key]  = $row['volume'];
                    $edicao[$key] = $row['edicao'];
                }

                // Você pode usar array_column() em vez do código acima
                $volume  = array_column($data, 'volume');
                $edicao = array_column($data, 'edicao');

                // Ordena os dados por volume decrescente, edição crescente.
                // Adiciona $data como último parâmetro, para ordenar por uma chave comum.
                array_multisort($volume, SORT_DESC, $edicao, SORT_ASC, $data);
                var_dump($data);
            echo "</article>
        </section>
    </body>";
    ?>
    <script src='assets/scripts/script.js'></script>
</html>