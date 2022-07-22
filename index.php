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
                <div><h2>Girar Dados</h2></div>
                <form action='' method='post'>
                    <div><select name='select-dado' id='select-dado'>
                        <option value='dado6'>Dado de 6 lados</option>
                        <option value='dado20'>Dado de 20 lados</option>
                        <option value='dado100'>Dado de 100 lados</option>
                    </select></div>
                    <div><input type='submit' id='girar-dado' value='Girar Dado'></div></form>
                    <div id='dado'><div class='vl-dado'> 0 </div></div></article>
                    <script>
                        var num = document.querySelector('.vl-dado');
                        let btn = document.querySelector('#girar-dado')

                        function getRandomArbitrary(min, max) {
                            return parseInt(Math.random() * (max - min) + min);
                        }
                        btn.addEventListener('click', (e) => {
                            e.preventDefault()
                            var select = document.getElementById('select-dado');
                            var selectTexto = select.options[select.selectedIndex].value;
                            let random;
                            if(selectTexto == 'dado6'){
                                random = getRandomArbitrary(1, 7);
                                num.innerText = random;
                            }else if(selectTexto == 'dado20'){
                                random = getRandomArbitrary(1, 21);
                                num.innerText = random;
                            }else{
                                random = getRandomArbitrary(1, 101);
                                num.innerText = random;
                            }
                        });
                   
                    </script>";
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
        echo "<article class='add-players'>
                <div><h2>Definindo os Turnos</h2></div>
                <div>Insira abaixo o nome do player/mob/npc e seu dado de iniciativa.</div>
                <form action='' method='post'>
                    <div id='formulario-players'>
                        <div class='form-group'>
                            <div><input type='text' placeholder='Nome' name='nome[]' class='nome' /></div>
                            <div><input type='number' placeholder='HP' name='vida[]' class='vida' /></div>
                            <div><input type='number' placeholder='Inic.' name='inic[]' class='iniciativa' /></div>
                            <div><input type='button' value='+' name='add' class='adicionar' onclick='adicionarCampo()'/></div>
                        </div>
                    </div>
                    <div class='form-group'>
                        <div><input type='submit' value='Enviar' class='button-enviar' name='enviar'/>
                    </div>
                </form>";

                //recolhendo os dados dos inputs do formulário
                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                //colocando em outra array, organizando por pessoa, cada um com nome e iniciativa respectivos
                if(!empty($dados['enviar'])){
                    foreach($dados['nome'] as $codPlayer => $nomePlayer){
                        $players[] = array('nome' => $nomePlayer, 'inic' => $dados['inic'][$codPlayer], 'vida' => $dados['vida'][$codPlayer]);
                    }
                }

                //pega os nomes e iniciativas
                foreach ($players as $key => $row) {
                    $nome[$key]  = $row['nome'];
                    $inic[$key] = $row['inic'];
                    $vida[$key] = $row['vida'];
                }

                //organiza em colunas
                $nome  = array_column($players, 'nome');
                $inic = array_column($players, 'inic');
                $vida = array_column($players, 'vida');

                //organiza as colunas por quem tem a iniciativa maior para quem tem a menor iniciativa
                array_multisort($inic, SORT_DESC, $players);
            echo "</article>
            <article class='ordem-turnos'>
                <div><h2>Ordem dos Turnos</h2>
                <div class='container players'>";
                    
                    foreach ($players as $row)
                        {
                            echo "<div>".ucwords($row['nome'])."/".$row['vida']."/".$row['inic']."</div>";
                        }
                echo"
                </div>
            </article>
        </section>
    </body>";
    ?>
    <script src='assets/scripts/script.js'></script>
</html>