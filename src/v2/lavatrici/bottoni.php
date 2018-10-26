<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div id="container"></div>
    <script src="../js/layoutUtils.js"></script>
    <script>
        camera = <?php session_start(); echo($_SESSION['u_room']); ?>
        
        nome = '<?php echo($_SESSION['u_name']); ?>'
        cognome = '<?php echo($_SESSION['u_cog']); ?>'
        
        lavatrici = 2
        table = new tableManager(lavatrici)
        today = new timeStamp(Date.now())
        rest = new requestFactory('../api/')
        prenotazioniPromises = []

        table.addHeader('Ora/Giorno')
        table.addHeader('Lavatrice')

        for (let i = 0; i < 6; i++) {
            table.addHeaderElement(0, today.hours.reset().days.add(i).toString('wd dd'), lavatrici)
            table.addHeaderElement(1, 'V')
            table.addHeaderElement(1, 'A')

            let giornata = []
            giornata.push(rest.fetch('GET', `prenotazioni.php/lavatrice/${today.days.add(i).toString('yy/mn/dd')}`).then(e => fill(Object.assign({ days: i }, e))))
            giornata.push(rest.fetch('GET', `prenotazioni.php/asciugatrice/${today.days.add(i).toString('yy/mn/dd')}`).then(e => fill(Object.assign({ days: i }, e))))
            prenotazioniPromises.push(giornata)
        }

        for (let i = 6; i < 24; i++)
            table.addRow(i, '')

        let fill = async function (giornata) {
            lav = giornata.Table == 'prenotazioni' ? 0 : 1
            giorno = giornata.days
            giornata.Items.forEach(prenotazione => {
                let casella = makeLabel(prenotazione.users_room,prenotazione.users_name,prenotazione.users_cog)
                table.toggle(prenotazione[`${giornata.Prefix}ora`], giorno, lav, casella, prenotazione.users_room != camera)
            })
        }

        let makeLabel = function(stanza,nome,cognome){
            let p = document.createElement('p')
            p.setAttribute('style','display:inline;font-weight:bold')
            p.setAttribute('data-toggle','tooltip')
            p.setAttribute('data-placement','auto right')
            if(nome && cognome)
                p.setAttribute('title',`${nome} ${cognome}`)
    
            p.textContent = stanza
            $(p).tooltip()
            return p
        }

        table.delegateEvent(async function (hour, days, lav, target) {
            let lavString = lav ? 'asciugatrice' : 'lavatrice'
            let aggiungere = `Vuoi prenotare il ${today.hours.reset().days.add(days).toString('wd dd/mm')} alle ${hour}:00 - ${lavString} ?`
            let rimuovere = 'Vuoi rimuovere la prenotazione?'
            let domanda = target.selected ? rimuovere : aggiungere

            if (!window.confirm(domanda))
                return

            let data = today.days.add(days)
            let response

            if (target.selected)
                response = await rest.fetch('DELETE', `prenotazioni.php/${lavString}/${data.toString('yy/mn/dd')}/${hour}`)
            else
                response = await rest.fetch('PUT', `prenotazioni.php/${lavString}/${data.toString('yy/mn/dd')}/${hour}`)

            if (response.success)
                table.toggle(hour, days, lav, makeLabel(camera,nome,cognome),false)
            else
                window.alert(response.message)

        })

        table.attach('#container')

    </script>
</body>

</html>