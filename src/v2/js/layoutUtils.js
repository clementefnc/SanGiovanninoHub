//Scopo di questa libreria è separare la logica di presentazione e quindi l'aspetto grafico del sito da quello funzionale

//La classe timeStamp astrae la difficoltà di lavorare con le date, costruendo sul tipo Date nativo di javascript
var timeStamp = class {
    constructor(utc) {
        this.utc = new Date(utc)

        this.days = {
            add: n => {
                let mUtc = this.utc.valueOf() + n * 60 * 60 * 24 * 1000
                return new timeStamp(mUtc)
            },

            remove: n => {
                let mUtc = this.utc.valueOf() - n * 60 * 60 * 24 * 1000
                return new timeStamp(mUtc)
            },

            reset: () => {
                let day = this.utc.getDate()
                return this.days.remove(day)
            }
        }

        this.hours = {
            add: n => {
                let mUtc = this.utc.valueOf() + n * 60 * 60 * 1000
                return new timeStamp(mUtc)
            },

            remove: n => {
                let mUtc = this.utc.valueOf() - n * 60 * 60 * 1000
                return new timeStamp(mUtc)
            },

            reset: () => {
                let hour = this.utc.getHours()
                return this.hours.remove(hour).hours.add(12)
            }
        }

    }

    toString(format) {
        let months = ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic']
        let weekdays = ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'];
        let year = this.utc.getFullYear()
        let month = months[this.utc.getMonth()]
        let date = this.utc.getDate()
        let weekday = weekdays[this.utc.getDay()]
        let hour = this.utc.getHours()

        return format.replace('hh', hour).replace('wd', weekday).replace('dd', date).replace('mm', month).replace('mn', this.utc.getMonth() + 1).replace('yy', year)
    }
}

//La classe tableManager gestisce lo stato delle tabelle. Permette di crearle e modificarle in maniera rapida senza riscrivere codice più volte
// delegateEvent permette di affidare alla tabella la gestione dei click. All' handler fornito vengono passati il giorno, l'ora e la lavatrice selezionati
var tableManager = class {
    constructor(num) {
        this.Node = document.createElement('table')
        this.Node.setAttribute('class', 'table table-striped table-condensed table-responsive table-hover')
        let dynamicCss = document.createElement("style");
        dynamicCss.type = "text/css";
        for (let i = 0; i < num; i++) {
            dynamicCss.innerHTML += `
                td:nth-child(${num * 2}n-${i + (num - 1)}){
                    background-color: rgba(0,0,0,0.02)
                }
            `;
        }
        document.querySelector('head').prepend(dynamicCss);

        this.head = document.createElement('thead')
        this.body = document.createElement('tbody')
        this.Node.appendChild(this.head)
        this.Node.appendChild(this.body)
        this.columns = 0
        this.rows = 0
        this.headers = 0
        this.numLavatrici = num
        this.selected = []
    }

    attach(query) {
        if (this.Node.parentNode)
            this.Node.parentNode.removeChild(this.Node)

        document.querySelector(query).appendChild(this.Node)
    }

    addHeader(label) {
        let newHeader = document.createElement('tr')
        this.head.appendChild(newHeader)
        this.headers += 1
        this.addHeaderElement(this.headers - 1, label)
    }

    addHeaderElement(n, name, span) {
        if (n > this.headers - 1)
            throw (`Header ${n} does not exist - Out of range`)
        let newHeader = document.createElement('th')
        newHeader.setAttribute('scope', 'col')
        if (span != undefined)
            newHeader.setAttribute('colspan', span)
        newHeader.textContent = name
        this.head.children[n].appendChild(newHeader)
        if (n == 0)
            this.columns += span ? span : 1
        if (this.rows > 0)
            this.redraw(this.rows)
    }

    addRow(label, element) {
        if (this.columns == 0)
            throw 'Unable to add row to empty table'

        let tr = document.createElement('tr')
        let th = document.createElement('th')
        th.textContent = label + ':00'
        tr.appendChild(th)
        for (let col = 1; col < this.columns; col++) {
            let td = document.createElement('td')
            td.row = label
            td.column = col - 1
            if (typeof (element) == 'string')
                td.textContent = element
            else if (typeof (element) == 'object')
                td.appendChild(element.cloneNode())

            tr.appendChild(td)
        }
        this.body.appendChild(tr)
        this.rows += 1
    }

    redraw(prevRows) {
        this.body.innerHTML = ''
        this.rows = 0;
        for (let i = 0; i < prevRows; i++) {
            this.addRow()
        }
    }

    delegateEvent(handler) {
        this.Node.addEventListener('click', evt => {
            var target = evt.target
            if(!evt.target.matches('td')) target = evt.target.closest('td')
            if (target && target.locked!=true) {
                let days = Math.floor(target.column / 2);
                let lav = target.column % this.numLavatrici
                handler(target.row, days, lav, target)
            }
        })
    }

    toggle(hour, days, lav, text, lock) {
        lock = lock || false
        let elms = []
        let col = days * this.numLavatrici + lav
        Object.values(this.body.children).forEach(e => elms.push(...e.children))
        let chosen = elms.filter(e => e.row == hour).find(e => e.column == col)
        chosen.textContent = ''
        if (!chosen.selected) {
            if (typeof (text) == 'string')
                chosen.textContent = text
            else if (typeof (text) == 'object')
                chosen.appendChild(text)
        }
        chosen.selected = !chosen.selected
        chosen.locked = lock
        chosen.classList.toggle('selected')

    }

}